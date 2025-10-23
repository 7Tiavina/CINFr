<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('email', 'like', '%' . $search . '%')
                  ->orWhere('charge_id', 'like', '%' . $search . '%');
        }

        $payments = $query->paginate(10); // Paginate with 10 items per page
        return view('backend.payments', compact('payments'));
    }
}
