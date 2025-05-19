<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1) Validation de base + honeypot + présence du token reCAPTCHA
        $data = $request->validate([
            'email'               => 'required|email',
            'sujet'               => 'required|string|max:255',
            'message'             => 'required|string',
            'honeypot'            => 'max:0',
            'g-recaptcha-response' => 'required',
        ]);

        // 2) Vérification serveur-side reCAPTCHA
        $resp = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret'),
            'response' => $data['g-recaptcha-response'],
            'remoteip' => $request->ip(),
        ])->json();

        if (! ($resp['success'] ?? false)) {
            return back()
                ->withErrors(['captcha' => 'Échec de la vérification anti-spam.'])
                ->withInput();
        }

        // 3) Enregistrement dans la BDD
        Contact::create([
            'email'   => $data['email'],
            'sujet'   => $data['sujet'],
            'message' => $data['message'],
        ]);

        // 4) Retour avec message de succès
        return back()->with('success', 'Message envoyé avec succès.');
    }
}

