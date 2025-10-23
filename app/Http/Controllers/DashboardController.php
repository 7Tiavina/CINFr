<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Clients by Type
        $clientsByType = Client::select('type', DB::raw('count(*) as total'))
                               ->groupBy('type')
                               ->pluck('total', 'type')
                               ->toArray();

        // Payments by Status
        $paymentsByStatus = Payment::select('status', DB::raw('count(*) as total'))
                                   ->groupBy('status')
                                   ->pluck('total', 'status')
                                   ->toArray();

        // Contacts over Time (last 12 months)
        $contactsOverTime = Contact::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('count(*) as total'))
                                   ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
                                   ->groupBy('month')
                                   ->orderBy('month')
                                   ->pluck('total', 'month')
                                   ->toArray();

        // Prepare data for Chart.js
        $chartData = [
            'clientsByType' => [
                'labels' => array_keys($clientsByType),
                'data' => array_values($clientsByType),
            ],
            'paymentsByStatus' => [
                'labels' => array_keys($paymentsByStatus),
                'data' => array_values($paymentsByStatus),
            ],
            'contactsOverTime' => [
                'labels' => array_keys($contactsOverTime),
                'data' => array_values($contactsOverTime),
            ],
        ];

        return view('backend.dashboard', compact('chartData'));
    }
}
