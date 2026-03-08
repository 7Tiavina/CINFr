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

        // Vérifier que le secret est configuré
        if (empty($webhookSecret)) {
            Log::error('Webhook Error: STRIPE_WEBHOOK_SECRET is not configured in .env');
            return response()->json(['status' => 'success', 'warning' => 'Webhook secret not configured']);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        // Vérifier que la signature est présente
        if (empty($sigHeader)) {
            Log::error('Webhook Error: Missing Stripe-Signature header');
            return response()->json(['status' => 'success', 'warning' => 'Missing signature header']);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            // Signature invalide
            Log::error("Webhook Error: Invalid Stripe signature.", ['exception' => $e->getMessage()]);
            // Return 200 to prevent Stripe from retrying - signature issues won't be fixed by retry
            return response()->json(['status' => 'success', 'warning' => 'Invalid signature']);
        } catch (\UnexpectedValueException $e) {
            // Payload invalide
            Log::error("Webhook Error: Invalid payload.", ['exception' => $e->getMessage()]);
            return response()->json(['status' => 'success', 'warning' => 'Invalid payload']);
        } catch (\Exception $e) {
            // Autre erreur inattendue
            Log::error("Webhook Error: Unexpected error during event construction.", ['exception' => $e->getMessage()]);
            return response()->json(['status' => 'success', 'warning' => 'Unexpected error']);
        }

        // Gérer l'événement - TOUJOURS retourner 200 même en cas d'erreur de traitement
        try {
            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    Log::info('Webhook: checkout.session.completed reçu pour la session ' . $session->id);
                    Log::debug('Stripe Webhook: checkout.session.completed session object', ['session' => $session]);
                    $this->handleCheckoutSessionCompleted($session);
                    break;

                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    Log::info('Webhook: payment_intent.succeeded reçu', ['payment_intent' => $paymentIntent->id]);
                    // Traitement optionnel si nécessaire
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    Log::warning('Webhook: payment_intent.payment_failed reçu', ['payment_intent' => $paymentIntent->id]);
                    // Optionnel: mettre à jour le paiement comme échoué
                    break;

                default:
                    Log::info("Webhook: Received unhandled event type {$event->type}");
            }
        } catch (\Exception $e) {
            // CRITICAL: Log the error but still return 200 to prevent Stripe from retrying indefinitely
            Log::error("Webhook Error: Exception during event handling.", [
                'event_type' => $event->type,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Return 200 anyway - Stripe considers this a successful delivery
            // The error is logged for manual review
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle the checkout.session.completed event.
     *
     * @param object $session
     * @return void
     */
    protected function handleCheckoutSessionCompleted(object $session): void
    {
        Log::debug('Stripe Webhook: handleCheckoutSessionCompleted started for session', [
            'session_id' => $session->id, 
            'payment_status' => $session->payment_status ?? 'unknown'
        ]);

        try {
            // 1. Vérification cruciale : Ne traiter que si le paiement est réellement 'paid'.
            if (!isset($session->payment_status) || $session->payment_status !== 'paid') {
                Log::warning("Webhook Ignored: checkout.session.completed reçu, mais payment_status n'est pas 'paid'.", [
                    'session_id' => $session->id,
                    'payment_status' => $session->payment_status ?? 'not_set'
                ]);
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

            // 2. Gestion de l'idempotence : s'assurer qu'on ne traite pas un webhook plusieurs fois.
            if ($payment->status !== 'pending') {
                Log::warning("Webhook Ignored: Le paiement ID {$paymentId} a déjà un statut '{$payment->status}' et ne sera pas traité à nouveau.", [
                    'session_id' => $session->id
                ]);
                return;
            }

            $updateData = [
                'status' => 'completed',
                'payment_status' => $session->payment_status,
                'charge_id' => $session->payment_intent ?? null,
            ];

            try {
                // Récupérer le PaymentIntent pour plus de détails
                if ($session->payment_intent) {
                    $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
                    Log::debug('Stripe Webhook: Retrieved PaymentIntent', ['id' => $paymentIntent->id]);

                    // Le PaymentIntent peut avoir un ou plusieurs charges. On prend le plus récent.
                    if ($paymentIntent->latest_charge) {
                        $charge = Charge::retrieve($paymentIntent->latest_charge);
                        Log::debug('Stripe Webhook: Retrieved Charge', ['id' => $charge->id]);

                        $updateData['receipt_url'] = $charge->receipt_url ?? null;

                        if ($charge->payment_method_details && $charge->payment_method_details->card) {
                            $updateData['card_last4'] = $charge->payment_method_details->card->last4 ?? null;
                            $updateData['payment_method'] = $charge->payment_method_details->card->brand ?? null;
                        } else if ($charge->payment_method_details && $charge->payment_method_details->type) {
                            $updateData['payment_method'] = $charge->payment_method_details->type;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Stripe Webhook: Erreur lors de la récupération des détails de paiement: " . $e->getMessage(), [
                    'session_id' => $session->id
                ]);
                // Continuer sans les détails si une erreur survient
            }

            // Mettre à jour le paiement
            $payment->update($updateData);

            Log::info("Paiement ID {$paymentId} mis à jour au statut 'completed' avec détails supplémentaires.", [
                'session_id' => $session->id, 
                'update_data' => $updateData
            ]);
            Log::debug('Stripe Webhook: Payment object after update', $payment->toArray());

        } catch (\Exception $e) {
            Log::error("Stripe Webhook: Critical error in handleCheckoutSessionCompleted", [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'session_id' => $session->id ?? 'unknown'
            ]);
            // Ne pas relancer l'exception - le webhook doit toujours réussir
        }
    }
}
