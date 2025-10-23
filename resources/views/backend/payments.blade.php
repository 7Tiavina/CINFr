@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>{{ __('Paiements') }}</h1>

        <div class="card mb-4">
            <div class="card-header">{{ __('Liste des Paiements') }}</div>
            <div class="card-body">
                <form action="{{ route('payments.index') }}" method="GET" class="form-inline mb-3">
                    <div class="input-group w-100">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('Rechercher par email ou ID de charge...') }}" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{ __('Rechercher') }}</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('ID de Charge') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Créé le') }}</th>
                                <th>{{ __('Statut') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->charge_id }}</td>
                                    <td>{{ $payment->email }}</td>
                                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ __($payment->status) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm view-payment-btn" data-toggle="modal" data-target="#paymentDetailsModal" data-payment='{{ json_encode($payment) }}'>
                                            <i class="icon ion-md-eye"></i> {{ __('Voir plus') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $payments->appends(request()->query())->links() }} {{-- Pagination Links with search query --}}
            </div>
        </div>
    </div>

    <!-- Payment Details Modal -->
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentDetailsModalLabel">{{ __('Détails du Paiement') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ __('ID') }}:</strong> <span id="modal-payment-id"></span></p>
                    <p><strong>{{ __('ID Session Stripe') }}:</strong> <span id="modal-stripe-session-id"></span></p>
                    <p><strong>{{ __('ID de Charge') }}:</strong> <span id="modal-charge-id"></span></p>
                    <p><strong>{{ __('Email') }}:</strong> <span id="modal-email"></span></p>
                    <p><strong>{{ __('4 Derniers Chiffres Carte') }}:</strong> <span id="modal-card-last4"></span></p>
                    <p><strong>{{ __('Montant') }}:</strong> <span id="modal-amount"></span></p>
                    <p><strong>{{ __('Devise') }}:</strong> <span id="modal-currency"></span></p>
                    <p><strong>{{ __('Statut') }}:</strong> <span id="modal-status"></span></p>
                    <p><strong>{{ __('Créé le') }}:</strong> <span id="modal-created-at"></span></p>
                    <p><strong>{{ __('Mis à jour le') }}:</strong> <span id="modal-updated-at"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Fermer') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.view-payment-btn').on('click', function() {
                const payment = $(this).data('payment');
                
                $('#modal-payment-id').text(payment.id);
                $('#modal-stripe-session-id').text(payment.stripe_session_id);
                $('#modal-charge-id').text(payment.charge_id);
                $('#modal-email').text(payment.email);
                $('#modal-card-last4').text(payment.card_last4);
                $('#modal-amount').text((payment.amount / 100).toFixed(2) + ' ' + payment.currency.toUpperCase());
                $('#modal-currency').text(payment.currency);
                $('#modal-status').text(payment.status);
                $('#modal-created-at').text(new Date(payment.created_at).toLocaleString('fr-FR'));
                $('#modal-updated-at').text(new Date(payment.updated_at).toLocaleString('fr-FR'));
            });
        });
    </script>
@endsection
