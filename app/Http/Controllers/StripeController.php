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
        // TODO: Ajouter une validation robuste des données du formulaire ici.
        // $validatedData = $request->validate([...]);

        try {
            // 1. Créer le client avec les données du formulaire
            // Note: Assurez-vous que le modèle Client a les champs correspondants dans $fillable
            $client = Client::create($request->all());

            // 2. Déterminer le prix et créer le paiement en attente
            $type = $request->input('type');
            $price = $type === 'majeur' ? config('prix.majeur') : config('prix.mineur');
            $priceInCents = $price * 100;

            $payment = $client->payments()->create([
                'amount' => $priceInCents,
                'currency' => 'eur',
                'status' => 'pending', // Statut initial avant paiement
                'email' => $client->email,
            ]);

            // 3. Préparer et créer la session Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'customer_email' => $client->email, // Pré-remplit l'email du client sur la page de paiement
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
                    'payment_id' => $payment->id, // Lien crucial pour le webhook
                ],
                'success_url' => route('success', ['payment_id' => $payment->id]), // URL de succès simple
                'cancel_url'  => route('predemande'),
            ]);

            // 4. Mettre à jour notre paiement avec l'ID de session Stripe et rediriger
            $payment->update(['stripe_session_id' => $session->id]);

            return redirect()->away($session->url);

        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la création de la session Stripe: ' . $e->getMessage());
            // Rediriger l'utilisateur vers une page d'erreur avec un message amical
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
        // On pourrait récupérer le paiement via $request->query('payment_id') si on voulait afficher
        // un message personnalisé, mais pour l'instant, un message générique suffit.
        return view('success');
    }




}