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
            // NOTE: Les noms des champs correspondent au formulaire HTML
            $clientData = $request->only([
                // Informations principales
                'type', 'raison', 'departement', 'sexe', 'situation_familiale',
                
                // Identité du demandeur
                'nom_naissance', 'deuxieme_nom', 'deuxieme_nom_origine', 'mot_devant', 'mot_a_afficher',
                'prenom1', 'prenom2', 'prenom3',
                'taille', 'couleur_yeux',
                'date_naissance', 'pays_naissance', 'dept_naissance', 'commune_naissance',
                
                // Adresse
                'adresse', 'adresse_complement', 'code_postal', 'ville', 'pays',
                
                // Coordonnées
                'telephone', 'email',
                
                // Nationalité
                'nationalite', 'motif_nationalite',
                
                // État civil
                'a_carte_identite', 'numero_cni', 'date_delivrance_cni', 'lieu_delivrance_cni',
                
                // Père - les noms correspondent au formulaire HTML
                'pere_inconnu', 'pere_nom', 'pere_prenom1', 'pere_prenom2', 'pere_prenom3',
                'pere_naissance_date', 'pere_naissance_ville', 'pere_nationalite', 'pere_pays_naissance',
                
                // Mère - les noms correspondent au formulaire HTML
                'mere_inconnue', 'mere_nom', 'mere_prenom1', 'mere_prenom2', 'mere_prenom3',
                'mere_naissance_date', 'mere_naissance_ville', 'mere_nationalite', 'mere_pays_naissance',
            ]);
            
            // 2. Mapper les champs du formulaire vers les noms de la base de données
            $clientDataMapped = [];
            
            // Champs directs (même nom)
            $directFields = [
                'type', 'raison', 'departement', 'sexe', 'situation_familiale',
                'nom_naissance', 'deuxieme_nom', 'deuxieme_nom_origine', 'mot_devant', 'mot_a_afficher',
                'prenom1', 'prenom2', 'prenom3',
                'taille', 'couleur_yeux',
                'date_naissance', 'pays_naissance', 'commune_naissance',
                'adresse', 'adresse_complement', 'code_postal', 'ville', 'pays',
                'telephone', 'email',
                'nationalite', 'motif_nationalite',
                'a_carte_identite', 'numero_cni', 'date_delivrance_cni', 'lieu_delivrance_cni',
                'pere_inconnu', 'mere_inconnue',
            ];
            
            foreach ($directFields as $field) {
                if ($request->has($field)) {
                    $clientDataMapped[$field] = $request->input($field);
                }
            }
            
            // Champs à mapper (nom formulaire → nom BDD)
            // Père
            if ($request->has('pere_nom')) {
                $clientDataMapped['nom_naissance_pere'] = $request->input('pere_nom');
            }
            if ($request->has('pere_prenom1')) {
                $clientDataMapped['prenom_pere'] = $request->input('pere_prenom1');
            }
            if ($request->has('pere_prenom2')) {
                $clientDataMapped['pere_prenom2'] = $request->input('pere_prenom2');
            }
            if ($request->has('pere_prenom3')) {
                $clientDataMapped['pere_prenom3'] = $request->input('pere_prenom3');
            }
            if ($request->has('pere_naissance_date')) {
                $clientDataMapped['pere_naissance_date'] = $request->input('pere_naissance_date');
            }
            if ($request->has('pere_naissance_ville')) {
                $clientDataMapped['pere_naissance_ville'] = $request->input('pere_naissance_ville');
            }
            if ($request->has('pere_nationalite')) {
                $clientDataMapped['pere_nationalite'] = $request->input('pere_nationalite');
            }
            if ($request->has('pere_pays_naissance')) {
                $clientDataMapped['pere_pays_naissance'] = $request->input('pere_pays_naissance');
            }
            
            // Mère
            if ($request->has('mere_nom')) {
                $clientDataMapped['nom_naissance_mere'] = $request->input('mere_nom');
            }
            if ($request->has('mere_prenom1')) {
                $clientDataMapped['prenom_mere'] = $request->input('mere_prenom1');
            }
            if ($request->has('mere_prenom2')) {
                $clientDataMapped['mere_prenom2'] = $request->input('mere_prenom2');
            }
            if ($request->has('mere_prenom3')) {
                $clientDataMapped['mere_prenom3'] = $request->input('mere_prenom3');
            }
            if ($request->has('mere_naissance_date')) {
                $clientDataMapped['mere_naissance_date'] = $request->input('mere_naissance_date');
            }
            if ($request->has('mere_naissance_ville')) {
                $clientDataMapped['mere_naissance_ville'] = $request->input('mere_naissance_ville');
            }
            if ($request->has('mere_nationalite')) {
                $clientDataMapped['mere_nationalite'] = $request->input('mere_nationalite');
            }
            if ($request->has('mere_pays_naissance')) {
                $clientDataMapped['mere_pays_naissance'] = $request->input('mere_pays_naissance');
            }
            
            // Département de naissance (dept_naissance → departement_naissance)
            if ($request->has('dept_naissance')) {
                $clientDataMapped['departement_naissance'] = $request->input('dept_naissance');
            }
            
            // Convertir les champs boolean (oui/non → 1/0)
            if (isset($clientDataMapped['pere_inconnu'])) {
                $clientDataMapped['pere_inconnu'] = filter_var($clientDataMapped['pere_inconnu'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }
            if (isset($clientDataMapped['mere_inconnue'])) {
                $clientDataMapped['mere_inconnue'] = filter_var($clientDataMapped['mere_inconnue'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }
            if (isset($clientDataMapped['a_carte_identite'])) {
                $clientDataMapped['a_carte_identite'] = filter_var($clientDataMapped['a_carte_identite'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }

            // 2. Créer le client avec les données mappées
            $client = Client::create($clientDataMapped);
            Log::debug('StripeController@createCheckoutSession: Client created', [
                'client_id' => $client->id,
                'departement' => $clientDataMapped['departement'] ?? 'NON_DEFINI'
            ]);

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