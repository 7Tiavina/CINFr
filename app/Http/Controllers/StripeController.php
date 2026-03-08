<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

use Stripe\PaymentIntent;
use Stripe\Charge;

class StripeController extends Controller
{
    /**
     * @return View|Factory|Application
     */
    public function checkout(): View|Factory|Application
    {
        return view('checkout');
    }

    /**
     * @return RedirectResponse
     * @throws ApiErrorException
     */
    public function createCheckoutSession(Request $request): RedirectResponse
    {
        try {
            Log::debug('StripeController@createCheckoutSession: Incoming request data', $request->all());

            // 1. Filtrer les données du formulaire pour le client
            $clientData = $request->only([
                'type', 'raison', 'departement', 'sexe', 'nom_naissance', 'deuxieme_nom',
                'prenom1', 'prenom2', 'prenom3', 'taille', 'couleur_yeux', 'date_naissance',
                'pays_naissance', 'departement_naissance', 'commune_naissance', 'adresse',
                'code_postal', 'ville', 'pays', 'situation_familiale', 'nom_naissance_mere',
                'prenom_mere', 'nom_naissance_pere', 'prenom_pere', 'nationalite',
                'telephone', 'email', 'a_carte_identite', 'numero_cni', 'date_delivrance_cni',
                'lieu_delivrance_cni', 'pere_inconnu', 'mere_inconnue', 'adresse_complement',
                'pere_naissance_date', 'pere_naissance_ville', 'pere_nationalite',
                'mere_naissance_date', 'mere_naissance_ville', 'mere_nationalite',
                'motif_nationalite', 'deuxieme_nom_origine', 'mot_devant', 'mot_a_afficher',
                'pere_prenom3', 'mere_prenom3', 'pere_pays_naissance', 'mere_pays_naissance'
            ]);

            // 2. Créer le client avec les données du formulaire
            $client = Client::create($clientData);
            Log::debug('StripeController@createCheckoutSession: Client created', ['client_id' => $client->id]);

            // 3. Déterminer le prix et créer le paiement en attente
            $type = $request->input('type');
            $price = $type === 'majeur' ? config('prix.majeur') : config('prix.mineur');
            $priceInCents = $price * 100;

            $paymentData = [
                'amount' => $priceInCents,
                'currency' => 'eur',
                'status' => 'pending',
                'email' => $client->email,
            ];
            Log::debug('StripeController@createCheckoutSession: Payment data before creation', $paymentData);

            $payment = $client->payments()->create($paymentData);
            Log::debug('StripeController@createCheckoutSession: Payment created', ['payment_id' => $payment->id]);

            // 4. Préparer et créer la session Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'customer_email' => $client->email,
                'line_items' => [[
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => ['name' => 'Pré-demande de CNI'],
                        'unit_amount'  => $priceInCents,
                    ],
                    'quantity'   => 1,
                ]],
                'mode'        => 'payment',
                'metadata'    => [
                    'payment_id' => $payment->id,
                    'client_id'  => $client->id,
                ],
                'success_url' => route('success', ['payment_id' => $payment->id]),
                'cancel_url'  => route('predemande'),
            ]);

            // 5. Mettre à jour notre paiement avec l'ID de session Stripe et rediriger
            $payment->update(['stripe_session_id' => $session->id]);
            
            // Optionnel: mettre à jour le client avec le stripe_session_id pour référence
            $client->update(['stripe_session_id' => $session->id]);

            Log::info('Stripe checkout session created', [
                'session_id' => $session->id,
                'payment_id' => $payment->id,
                'client_id' => $client->id
            ]);

            return redirect()->away($session->url);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la session Stripe: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);
            return redirect()->route('predemande')->with('error', 'Une erreur est survenue lors de la préparation du paiement. Veuillez réessayer.');
        }
    }

    /**
     * @param Request $request
     * @return View|Factory|Application|\Illuminate\Http\JsonResponse
     */


    /**
     * Reçoit le POST Ajax et stocke TOUT (Stripe + sessionStorage)
     */

    // Affiche la page de succès après la redirection de Stripe.
    // Ne contient plus aucune logique métier.
    public function showSuccessPage(Request $request)
    {
        $paymentId = $request->query('payment_id');
        $payment = null;
        $client = null;
        
        if ($paymentId) {
            $payment = Payment::with('client')->find($paymentId);
            if ($payment) {
                $client = $payment->client;
            }
        }
        
        return view('success', compact('payment', 'client'));
    }
}