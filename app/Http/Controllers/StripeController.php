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
    public function test(Request $request): RedirectResponse
    {
        $type = $request->input('type');
        $price = $type === 'majeur' ? config('prix.majeur') : config('prix.mineur');
        $priceInCents = $price * 100;

        Stripe::setApiKey(config('stripe.test.sk'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'product_data' => ['name' => 'Pré-demande de CNI'],
                    'unit_amount'  => $priceInCents,
                ],
                'quantity'   => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }


    /**
     * @return RedirectResponse
     * @throws ApiErrorException
     */
    public function live(): RedirectResponse
    {
        Stripe::setApiKey(config('stripe.live.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'gbp',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount'  => 500,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    /**
     * @param Request $request
     * @return View|Factory|Application|\Illuminate\Http\JsonResponse
     */
    

    /**
     * Reçoit le POST Ajax et stocke TOUT (Stripe + sessionStorage)
     */

 public function storeSessionData(Request $request)
    {
        \Log::info('--- New Request to storeSessionData ---');
        try {
            Stripe::setApiKey(config('stripe.test.sk'));

            $sessionId = $request->input('stripe_session_id');
            $data      = $request->input('data', []);
            \Log::info('Received data from AJAX:', $data);

            // 1) Récupération de la session Stripe
            $session = StripeSession::retrieve([
                'id'     => $sessionId,
                'expand' => ['customer', 'payment_intent'],
            ]);
            $pi     = PaymentIntent::retrieve($session->payment_intent->id);
            $charge = Charge::retrieve([
                'id'     => $pi->latest_charge,
                'expand' => ['payment_method_details.card'],
            ]);

            // 2) Conversion oui/non → bool pour Père/Mère inconnu
            $data['pere_inconnu']   = (isset($data['pere_inconnu'])   && $data['pere_inconnu']   === 'oui');
            $data['mere_inconnue']  = (isset($data['mere_inconnue'])  && $data['mere_inconnue']  === 'oui');

            // 3) Regrouper les cases nat_* et le texte libre
            $reasons = [];
            foreach ($data as $key => $val) {
                if (str_starts_with($key, 'nat_') && $val !== '') {
                    $reasons[] = $val;
                }
            }
            // créer la chaîne finale
            $data['motif_nationalite'] = implode(';', $reasons);

            // 4) Mapping de tous les champs du client
            $clientData = [
                'type'                    => $data['type']                    ?? null,
                'raison'                  => $data['raison']                  ?? null,
                'departement'             => $data['departement']             ?? null,
                'sexe'                    => $data['sexe']                    ?? null,
                'nom_naissance'           => $data['nom_naissance']           ?? null,
                'deuxieme_nom'            => $data['deuxieme_nom']            ?? null,
                'prenom1'                 => $data['prenom1']                 ?? null,
                'prenom2'                 => $data['prenom2']                 ?? null,
                'prenom3'                 => $data['prenom3']                 ?? null,
                'taille'                  => $data['taille']                  ?? null,
                'couleur_yeux'            => $data['couleur_yeux']            ?? null,
                'date_naissance'          => $data['date_naissance']          ?? null,
                'pays_naissance'          => $data['pays_naissance']          ?? null,
                'departement_naissance'   => $data['departement_naissance']   ?? ($data['dept_naissance'] ?? null),
                'commune_naissance'       => $data['commune_naissance']       ?? null,
                'adresse'                 => $data['adresse']                 ?? null,
                'code_postal'             => $data['code_postal']             ?? null,
                'adresse_complement'      => $data['adresse_complement']      ?? null,
                'ville'                   => $data['ville']                   ?? null,
                'pays'                    => $data['pays']                    ?? null,
                'situation_familiale'     => $data['situation_familiale']     ?? null,
                'nationalite'             => $data['nationalite']             ?? null,
                'motif_nationalite'       => $data['motif_nationalite']       ?? null,
                'pere_inconnu'            => $data['pere_inconnu'],
                'prenom_pere'             => $data['pere_prenom1']            ?? null,
                'pere_prenom2'            => $data['pere_prenom2']            ?? null,
                'nom_naissance_pere'      => $data['pere_nom']                ?? null,
                'pere_naissance_date'     => $data['pere_naissance_date']     ?? null,
                'pere_naissance_ville'    => $data['pere_naissance_ville']    ?? null,
                'pere_nationalite'        => $data['pere_nationalite']        ?? null,
                'mere_inconnue'           => $data['mere_inconnue'],
                'prenom_mere'             => $data['mere_prenom1']            ?? null,
                'mere_prenom2'            => $data['mere_prenom2']            ?? null,
                'nom_naissance_mere'      => $data['mere_nom']                ?? null,
                'mere_naissance_date'     => $data['mere_naissance_date']     ?? null,
                'mere_naissance_ville'    => $data['mere_naissance_ville']    ?? null,
                'mere_nationalite'        => $data['mere_nationalite']        ?? null,
                'telephone'               => $data['telephone']               ?? null,
                'email'                   => $data['client_email']            ?? $session->customer_details->email,
                'a_carte_identite'        => $data['a_carte_identite']        ?? false,
                'numero_cni'              => $data['numero_cni']              ?? null,
                'date_delivrance_cni'     => $data['date_delivrance_cni']     ?? null,
                'lieu_delivrance_cni'     => $data['lieu_delivrance_cni']     ?? null,
                'photo_identite'          => $data['photo_identite']          ?? null,
                'justificatif_domicile'   => $data['justificatif_domicile']   ?? null,
                'acte_naissance'          => $data['acte_naissance']          ?? null,
                'autre_document'          => $data['autre_document']          ?? null,
                'deuxieme_nom_origine'    => $data['deuxieme_nom_origine']    ?? null,
                'mot_devant'              => $data['mot_devant']              ?? null,
                'mot_a_afficher'          => $data['mot_a_afficher']          ?? null,
                'pere_prenom3'            => $data['pere_prenom3']            ?? null,
                'mere_prenom3'            => $data['mere_prenom3']            ?? null,
                'pere_pays_naissance'     => $data['pere_pays_naissance']     ?? null,
                'mere_pays_naissance'     => $data['mere_pays_naissance']     ?? null,
            ];
            \Log::info('Prepared client data:', $clientData);

            // 5) Création ou mise à jour du client
            $client = Client::updateOrCreate(
                ['stripe_session_id' => $sessionId],
                $clientData
            );
            \Log::info('Client successfully created/updated with ID: ' . $client->id);

            // 6) Enregistrement du paiement
            $payment = $client->payments()->updateOrCreate(
                ['stripe_session_id' => $sessionId],
                [
                    'charge_id'   => $charge->id,
                    'receipt_url' => $charge->receipt_url,
                    'email'       => $session->customer_details->email,
                    'card_last4'  => $charge->payment_method_details->card->last4,
                    'amount'      => $pi->amount_received,
                    'currency'    => $pi->currency,
                    'status'      => $session->payment_status,
                ]
            );

            return response()->json([
                'status'  => 'success',
                'client'  => $client->id,
                'payment' => $payment->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur storeSessionData : ' . $e->getMessage());
            \Log::error($e->getTraceAsString()); // Log the full stack trace
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }






    // Affiche la page de succès
    
   public function showSuccessPage(Request $request)
    {
        Stripe::setApiKey(config('stripe.test.sk'));
        $sessionId = $request->query('session_id');
        if (!$sessionId) abort(404, 'Session ID manquante');

        $session = \Stripe\Checkout\Session::retrieve([
            'id'     => $sessionId,
            'expand' => ['payment_intent', 'customer']
        ]);

        $pi = \Stripe\PaymentIntent::retrieve($session->payment_intent->id);
        $latestChargeId = $pi->latest_charge;
        $charge = \Stripe\Charge::retrieve([
            'id'     => $latestChargeId,
            'expand' => ['payment_method_details.card'],
        ]);

        $receiptUrl = $charge->receipt_url;
        $chargeId   = $charge->id;
        $cardLast4  = $charge->payment_method_details->card->last4;
        $email      = $session->customer_details->email;

        //dd(compact('receiptUrl','chargeId','cardLast4','email'));

        $client = Client::where('stripe_session_id', $sessionId)->first();
        if ($client) {
            $client->update([
                'receipt_url' => $receiptUrl,
                'charge_id'   => $chargeId,
                'email'       => $email,
                'card_last4'  => $cardLast4,
            ]);
        }
        //dd($client->toArray());
        return view('success', compact('receiptUrl', 'chargeId', 'email'));
    }




}