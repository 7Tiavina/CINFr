<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Charge;
use App\Mail\OrderConfirmationMail;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Mail;

class StripeWebhookController extends Controller
{
    /**
     * Handle Stripe webhook requests.
     */
    public function handleWebhook(Request $request)
    {
        $webhookSecret = config('services.stripe.webhook_secret');

        if (empty($webhookSecret)) {
            Log::error('Webhook Error: STRIPE_WEBHOOK_SECRET is not configured');
            return response(['status' => 'success', 'warning' => 'Webhook secret not configured']);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        if (empty($sigHeader)) {
            Log::error('Webhook Error: Missing Stripe-Signature header');
            return response(['status' => 'success', 'warning' => 'Missing signature header']);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            Log::error("Webhook Error: Invalid Stripe signature.", ['exception' => $e->getMessage()]);
            return response(['status' => 'success', 'warning' => 'Invalid signature']);
        } catch (\UnexpectedValueException $e) {
            Log::error("Webhook Error: Invalid payload.", ['exception' => $e->getMessage()]);
            return response(['status' => 'success', 'warning' => 'Invalid payload']);
        } catch (\Exception $e) {
            Log::error("Webhook Error: Unexpected error.", ['exception' => $e->getMessage()]);
            return response(['status' => 'success', 'warning' => 'Unexpected error']);
        }

        try {
            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    Log::info('Webhook: checkout.session.completed reçu pour la session ' . $session->id);
                    $this->handleCheckoutSessionCompleted($session);
                    break;

                case 'payment_intent.succeeded':
                    Log::info('Webhook: payment_intent.succeeded reçu');
                    break;

                case 'payment_intent.payment_failed':
                    Log::warning('Webhook: payment_intent.payment_failed reçu');
                    break;

                default:
                    Log::info("Webhook: Received unhandled event type {$event->type}");
            }
        } catch (\Exception $e) {
            Log::error("Webhook Error: Exception during event handling.", [
                'event_type' => $event->type,
                'exception' => $e->getMessage()
            ]);
        }

        return response(['status' => 'success']);
    }

    protected function handleCheckoutSessionCompleted(object $session): void
    {
        try {
            if (!isset($session->payment_status) || $session->payment_status !== 'paid') {
                Log::warning("Webhook Ignored: payment_status n'est pas 'paid'.", [
                    'session_id' => $session->id,
                    'payment_status' => $session->payment_status ?? 'not_set'
                ]);
                return;
            }

            $paymentId = $session->metadata->payment_id ?? null;

            if (!$paymentId) {
                Log::error("Webhook Error: payment_id manquant", ['session_id' => $session->id]);
                return;
            }

            $payment = Payment::find($paymentId);

            if (!$payment) {
                Log::error("Webhook Error: Paiement non trouvé", ['payment_id' => $paymentId]);
                return;
            }

            if ($payment->status !== 'pending') {
                Log::warning("Webhook Ignored: Paiement déjà traité", [
                    'payment_id' => $paymentId,
                    'status' => $payment->status
                ]);
                return;
            }

            $updateData = [
                'status' => 'completed',
                'payment_status' => $session->payment_status,
                'charge_id' => $session->payment_intent ?? null,
            ];

            try {
                if ($session->payment_intent) {
                    $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
                    if ($paymentIntent->latest_charge) {
                        $charge = Charge::retrieve($paymentIntent->latest_charge);
                        $updateData['receipt_url'] = $charge->receipt_url ?? null;

                        if ($charge->payment_method_details && $charge->payment_method_details->card) {
                            $updateData['card_last4'] = $charge->payment_method_details->card->last4 ?? null;
                            $updateData['payment_method'] = $charge->payment_method_details->card->brand ?? null;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Erreur lors de la récupération des détails de paiement", [
                    'session_id' => $session->id,
                    'exception' => $e->getMessage()
                ]);
            }

            $payment->update($updateData);

            Log::info("Paiement mis à jour", [
                'payment_id' => $paymentId,
                'status' => 'completed'
            ]);

            // Envoyer l'email de confirmation avec facture
            $this->sendOrderConfirmationEmail($payment);

        } catch (\Exception $e) {
            Log::error("Critical error in handleCheckoutSessionCompleted", [
                'exception' => $e->getMessage(),
                'session_id' => $session->id ?? 'unknown'
            ]);
        }
    }

    /**
     * Send order confirmation email with invoice attachment
     */
    protected function sendOrderConfirmationEmail(Payment $payment): void
    {
        try {
            $client = $payment->client;

            if (!$client) {
                Log::error("Email not sent: Client not found for payment", ['payment_id' => $payment->id]);
                return;
            }

            if (empty($client->email)) {
                Log::error("Email not sent: Client email is empty", ['payment_id' => $payment->id, 'client_id' => $client->id]);
                return;
            }

            // Generate invoice PDF
            $invoiceService = new InvoiceService();
            $pdfPath = $invoiceService->generateInvoice($client, $payment);

            Log::info("Invoice PDF generated", ['path' => $pdfPath, 'payment_id' => $payment->id]);

            // Send email
            Mail::to($client->email)->send(new OrderConfirmationMail($client, $payment, $pdfPath));

            Log::info("Order confirmation email sent successfully", [
                'payment_id' => $payment->id,
                'client_email' => $client->email
            ]);

        } catch (\Exception $e) {
            Log::error("Error sending order confirmation email", [
                'payment_id' => $payment->id,
                'exception' => $e->getMessage()
            ]);
            // Don't rethrow - email failure shouldn't affect payment processing
        }
    }
}