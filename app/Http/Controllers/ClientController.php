<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('email', 'like', '%' . $search . '%')
                  ->orWhere('nom_naissance', 'like', '%' . $search . '%');
        }

        $clients = $query->paginate(10); // Paginate with 10 items per page
        return view('backend.clients', compact('clients'));
    }
}
