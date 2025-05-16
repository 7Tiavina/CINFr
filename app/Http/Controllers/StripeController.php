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
    public function test(): RedirectResponse
    {
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'product_data' => ['name' => 'Pré-demande de CNI'],
                    'unit_amount'  => 3900,  // 39,00 € en cents
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
        try {
            Stripe::setApiKey(config('stripe.test.sk'));

            $sessionId = $request->input('stripe_session_id');
            $data      = $request->input('data', []);

            
            $session = StripeSession::retrieve([
                'id'     => $sessionId,
                'expand' => ['customer', 'payment_intent']
            ]);

            $pi             = PaymentIntent::retrieve($session->payment_intent->id);
            $latestChargeId = $pi->latest_charge;
            $charge         = Charge::retrieve([
                'id'     => $latestChargeId,
                'expand' => ['payment_method_details.card'],
            ]);

            $payload = [
                'stripe_session_id' => $sessionId,
                'email'             => $session->customer_details->email,
                'receipt_url'       => $charge->receipt_url,
                'charge_id'         => $charge->id,
                'card_last4'        => $charge->payment_method_details->card->last4,
                'session_data'      => $data,
            ];

            $client = Client::updateOrCreate(
                ['stripe_session_id' => $sessionId],
                $payload
            );

            return response()->json([
                'status'    => 'ok',
                'client_id' => $client->id,
                'stored'    => $payload,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }



    // Affiche la page de succès
    
   public function showSuccessPage(Request $request)
    {
        Stripe::setApiKey(config('stripe.test.sk'));
        $sessionId = $request->query('session_id');
        if (!$sessionId) abort(404, 'Session ID manquante');

        // Récupère la session (expand customer pour l'email)
        $session = \Stripe\Checkout\Session::retrieve([
            'id'     => $sessionId,
            'expand' => ['payment_intent', 'customer']
        ]);

        // Récupère le PaymentIntent
        $pi = \Stripe\PaymentIntent::retrieve($session->payment_intent->id);

        // on utilise latest_charge
        $latestChargeId = $pi->latest_charge;
        $charge = \Stripe\Charge::retrieve([
            'id'     => $latestChargeId,
            'expand' => ['payment_method_details.card'],
        ]);

        // Extractions
        $receiptUrl = $charge->receipt_url;
        $chargeId   = $charge->id;
        $cardLast4  = $charge->payment_method_details->card->last4;
        $email      = $session->customer_details->email;

        // Debug temporaire
        // dd(compact('receiptUrl','chargeId','cardLast4','email'));

        // Mise à jour BDD
        $client = Client::where('stripe_session_id', $sessionId)->first();
        if ($client) {
            $client->update([
                'receipt_url' => $receiptUrl,
                'charge_id'   => $chargeId,
                'email'       => $email,
                'card_last4'  => $cardLast4,
            ]);
        }
        return view('success', compact('receiptUrl', 'chargeId', 'email'));
    }



}