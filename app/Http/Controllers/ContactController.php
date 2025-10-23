<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('email', 'like', '%' . $search . '%');
        }

        $contacts = $query->paginate(10); // Paginate with 10 items per page
        return view('backend.contacts', compact('contacts'));
    }
}