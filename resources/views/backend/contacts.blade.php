@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>{{ __('Contacts') }}</h1>

        <div class="card mb-4">
            <div class="card-header">{{ __('Liste des Contacts') }}</div>
            <div class="card-body">
                <form action="{{ route('contacts.index') }}" method="GET" class="form-inline mb-3">
                    <div class="input-group w-100">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('Rechercher par email...') }}" value="{{ request('search') }}">
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
                                <th>{{ __('Sujet') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->sujet ?? __('Aucun sujet') }}</td> {{-- Handle null subject --}}
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm view-contact-btn" data-toggle="modal" data-target="#contactDetailsModal" data-contact='{{ json_encode($contact) }}'>
                                            <i class="icon ion-md-eye"></i> {{ __('Voir plus') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $contacts->appends(request()->query())->links() }} {{-- Pagination Links with search query --}}
            </div>
        </div>
    </div>

    <!-- Contact Details Modal -->
    <div class="modal fade" id="contactDetailsModal" tabindex="-1" role="dialog" aria-labelledby="contactDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactDetailsModalLabel">{{ __('Détails du Contact') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ __('ID') }}:</strong> <span id="modal-contact-id"></span></p>
                    <p><strong>{{ __('Email') }}:</strong> <span id="modal-email"></span></p>
                    <p><strong>{{ __('Sujet') }}:</strong> <span id="modal-subject"></span></p>
                    <div class="form-group">
                        <label for="modal-message"><strong>{{ __('Message') }}:</strong></label>
                        <textarea id="modal-message" class="form-control" rows="7" readonly></textarea>
                    </div>
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
            $('.view-contact-btn').on('click', function() {
                const contact = $(this).data('contact');
                
                $('#modal-contact-id').text(contact.id);
                $('#modal-email').text(contact.email);
                $('#modal-subject').text(contact.sujet ?? '{{ __('Aucun sujet') }}'); // Handle null subject
                $('#modal-message').val(contact.message); // Use .val() for textarea
                $('#modal-created-at').text(new Date(contact.created_at).toLocaleString('fr-FR'));
                $('#modal-updated-at').text(new Date(contact.updated_at).toLocaleString('fr-FR'));
            });
        });
    </script>
@endsection