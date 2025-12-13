<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

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

        // 2. Gestion de l'idempotence : s'assurer qu'on ne traite pas un webhook plusieurs fois.
        if ($payment->status !== 'pending') {
            Log::warning("Webhook Ignored: Le paiement ID {$paymentId} a déjà un statut '{$payment->status}' et ne sera pas traité à nouveau.", ['session_id' => $session->id]);
            return;
        }

        // Mettre à jour le paiement
        $payment->status = 'completed';
        $payment->charge_id = $session->payment_intent; // Stocke l'ID du PaymentIntent
        $payment->save();

        Log::info("Paiement ID {$paymentId} mis à jour au statut 'completed'.", ['session_id' => $session->id]);

        // Ici, vous pouvez déclencher d'autres actions en toute sécurité :
        // - Envoyer un email de confirmation au client
        // - Envoyer une notification à l'administrateur
        // Mail::to($payment->client->email)->send(new OrderConfirmationMail($payment));
    }
}