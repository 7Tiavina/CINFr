<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request; 

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use App\Models\Client;

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

        $session = Session::create([
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
    // Affiche la page de succès
    public function showSuccessPage(Request $request): View|Factory|Application
    {
        // Récupère l'ID de la session Stripe depuis l'URL
        $stripeSessionId = $request->query('session_id');
        return view('success', compact('stripeSessionId'));
    }


    // Reçoit le POST Ajax et stocke sessionStorage
    public function storeSessionData(Request $request)
    {
        $sessionData     = $request->input('data', []);
        $stripeSessionId = $request->input('stripe_session_id');

        $client = Client::create([
            'session_data'      => $sessionData,
            'stripe_session_id'=> $stripeSessionId,
        ]);

        return response()->json(['status' => 'ok', 'client_id' => $client->id]);
    }

}