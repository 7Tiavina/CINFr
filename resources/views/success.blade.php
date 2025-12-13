@extends('layouts.app')

@section('title', 'Paiement réussi')

@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <img src="{{ asset('images/logo3.webp') }}" alt="Logo CINFr" style="width: 150px; height: auto; margin: 0 auto 20px; display: block;">
                    <h1 class="card-title text-success mt-4">✅ Paiement initié avec succès !</h1>
                    <p class="card-text lead">Merci. Votre demande a bien été enregistrée et le paiement a été initié.</p>
                    <p class="card-text">Vous recevrez une confirmation par e-mail dès que le paiement sera définitivement validé par nos systèmes.</p>
                    
                    {{-- Le webhook se chargera de la validation finale. Le reçu sera envoyé par Stripe/email. --}}
                    
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill mt-3">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Plus aucun script n'est nécessaire ici. Le traitement est géré côté serveur via le webhook. --}}
@endsection