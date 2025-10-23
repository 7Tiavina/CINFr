@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>{{ __('Paiements') }}</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('ID Session Stripe') }}</th>
                    <th>{{ __('ID de Charge') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('4 Derniers Chiffres Carte') }}</th>
                    <th>{{ __('Montant') }}</th>
                    <th>{{ __('Devise') }}</th>
                    <th>{{ __('Statut') }}</th>
                    <th>{{ __('Créé le') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->stripe_session_id }}</td>
                        <td>{{ $payment->charge_id }}</td>
                        <td>{{ $payment->email }}</td>
                        <td>{{ $payment->card_last4 }}</td>
                        <td>{{ $payment->amount / 100 }}</td>
                        <td>{{ $payment->currency }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
