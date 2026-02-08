<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Charge;

class StripeWebhookController extends Controller
{
    /**
     * Handle Stripe webhook requests.
     *
     * @param Request $request
     * @return Response
     */
    public function handleWebhook(Request $request): Response
    {
        // La clé secrète du webhook. Assurez-vous de la définir dans votre .env
        $webhookSecret = config('services.stripe.webhook_secret');

        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            // Signature invalide
            Log::error("Webhook Error: Invalid Stripe signature.", ['exception' => $e]);
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\UnexpectedValueException $e) {
            // Payload invalide
            Log::error("Webhook Error: Invalid payload.", ['exception' => $e]);
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Gérer l'événement
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                Log::info('Webhook: checkout.session.completed reçu pour la session ' . $session->id);
                Log::debug('Stripe Webhook: checkout.session.completed session object', $session->toArray());
                $this->handleCheckoutSessionCompleted($session);
                break;

            // ... ajoutez d'autres cas d'événements que vous souhaitez gérer
            // case 'payment_intent.succeeded':
            //     ...
            //     break;

            default:
                Log::info("Webhook: Received unhandled event type {$event->type}");
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle the checkout.session.completed event.
     *
     * @param \Stripe\Checkout\Session $session
     * @return void
     */
    protected function handleCheckoutSessionCompleted(\Stripe\Checkout\Session $session): void
    {
        Log::debug('Stripe Webhook: handleCheckoutSessionCompleted started for session', ['session_id' => $session->id, 'payment_status' => $session->payment_status]);
        // 1. Vérification cruciale : Ne traiter que si le paiement est réellement 'paid'.
        if ($session->payment_status !== 'paid') {
            Log::warning("Webhook Ignored: checkout.session.completed reçu, mais payment_status est '{$session->payment_status}'.", ['session_id' => $session->id]);
            return;
        }

        $paymentId = $session->metadata->payment_id ?? null;

        if (!$paymentId) {
            Log::error("Webhook Error: payment_id manquant dans les métadonnées pour la session " . $session->id);
            return;
        }

        $payment = Payment::find($paymentId);

        if (!$payment) {
            Log::error("Webhook Error: Paiement avec l'ID {$paymentId} non trouvé pour la session " . $session->id);
            return;
        }
        Log::debug('Stripe Webhook: Payment object before update', $payment->toArray());

        Log::debug('Stripe Webhook: Payment object before update', $payment->toArray());

        // 2. Gestion de l'idempotence : s'assurer qu'on ne traite pas un webhook plusieurs fois.
        if ($payment->status !== 'pending') {
            Log::warning("Webhook Ignored: Le paiement ID {$paymentId} a déjà un statut '{$payment->status}' et ne sera pas traité à nouveau.", ['session_id' => $session->id]);
            return;
        }

        $updateData = [
            'status' => 'completed',
            'payment_status' => $session->payment_status, // Directement depuis la session
            'charge_id' => $session->payment_intent, // L'ID du PaymentIntent est le charge_id pour nous
        ];

        try {
            // Récupérer le PaymentIntent pour plus de détails
            if ($session->payment_intent) {
                $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
                Log::debug('Stripe Webhook: Retrieved PaymentIntent', $paymentIntent->toArray());

                // Le PaymentIntent peut avoir un ou plusieurs charges. On prend le plus récent.
                if ($paymentIntent->latest_charge) {
                    $charge = Charge::retrieve($paymentIntent->latest_charge);
                    Log::debug('Stripe Webhook: Retrieved Charge', $charge->toArray());

                    $updateData['receipt_url'] = $charge->receipt_url;

                    if ($charge->payment_method_details && $charge->payment_method_details->card) {
                        $updateData['card_last4'] = $charge->payment_method_details->card->last4;
                        $updateData['payment_method'] = $charge->payment_method_details->card->brand; // e.g., visa, mastercard
                    } else if ($charge->payment_method_details && $charge->payment_method_details->type) {
                        // Pour d'autres types de méthodes de paiement (ex: sepa_debit)
                        $updateData['payment_method'] = $charge->payment_method_details->type;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error("Stripe Webhook: Erreur lors de la récupération des détails de paiement: " . $e->getMessage(), ['session_id' => $session->id]);
            // Continuer sans les détails si une erreur survient
        }

        // Mettre à jour le paiement
        $payment->update($updateData);

        Log::info("Paiement ID {$paymentId} mis à jour au statut 'completed' avec détails supplémentaires.", ['session_id' => $session->id, 'update_data' => $updateData]);
        Log::debug('Stripe Webhook: Payment object after update', $payment->toArray());

        // Ici, vous pouvez déclencher d'autres actions en toute sécurité :
        // - Envoyer un email de confirmation au client
        // - Envoyer une notification à l'administrateur
        // Mail::to($payment->client->email)->send(new OrderConfirmationMail($payment));
    }
}