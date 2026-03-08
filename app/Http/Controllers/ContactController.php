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

        $contacts = $query->paginate(10);
        return view('backend.contacts', compact('contacts'));
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        // 1. Validation des champs
        $validated = $request->validate([
            'email' => 'required|email',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Veuillez valider le captcha reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'La validation reCAPTCHA a échoué. Veuillez vérifier que vous n\'êtes pas un robot.',
        ]);

        // 2. Sauvegarder le message
        Contact::create([
            'email' => $validated['email'],
            'sujet' => $validated['sujet'],
            'message' => $validated['message'],
        ]);

        // 3. Redirection avec succès
        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}