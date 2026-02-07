@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>{{ __('Clients') }}</h1>

        <div class="card mb-4">
            <div class="card-header">{{ __('Liste des Clients') }}</div>
            <div class="card-body">
                <form action="{{ route('clients.index') }}" method="GET" class="form-inline mb-3">
                    <div class="input-group w-100">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('Rechercher par email ou nom de naissance...') }}" value="{{ request('search') }}">
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
                                <th>{{ __('Raison') }}</th>
                                <th>{{ __('Département') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Nom de Naissance') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->raison }}</td>
                                    <td>{{ $client->departement }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->nom_naissance }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm view-client-btn" data-toggle="modal" data-target="#clientDetailsModal" data-client='{{ json_encode($client) }}'>
                                            <i class="icon ion-md-eye"></i> {{ __('Voir plus') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $clients->appends(request()->query())->links() }} {{-- Pagination Links with search query --}}
            </div>
        </div>
    </div>

    <!-- Client Details Modal -->
    <div class="modal fade" id="clientDetailsModal" tabindex="-1" role="dialog" aria-labelledby="clientDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientDetailsModalLabel">{{ __('Détails du Client') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ __('ID') }}:</strong> <span id="modal-client-id"></span></p>
                    <p><strong>{{ __('Type') }}:</strong> <span id="modal-type"></span></p>
                    <p><strong>{{ __('Raison') }}:</strong> <span id="modal-raison"></span></p>
                    <p><strong>{{ __('Département') }}:</strong> <span id="modal-departement"></span></p>
                    <p><strong>{{ __('Sexe') }}:</strong> <span id="modal-sexe"></span></p>
                    <p><strong>{{ __('Nom de Naissance') }}:</strong> <span id="modal-nom-naissance"></span></p>
                    <p><strong>{{ __('Prénom 1') }}:</strong> <span id="modal-prenom1"></span></p>
                    <p><strong>{{ __('Prénom 2') }}:</strong> <span id="modal-prenom2"></span></p>
                    <p><strong>{{ __('Prénom 3') }}:</strong> <span id="modal-prenom3"></span></p>
                    <p><strong>{{ __('Date de Naissance') }}:</strong> <span id="modal-date-naissance"></span></p>
                    <p><strong>{{ __('Ville de Naissance') }}:</strong> <span id="modal-ville-naissance"></span></p>
                    <p><strong>{{ __('Pays de Naissance') }}:</strong> <span id="modal-pays-naissance"></span></p>
                    <p><strong>{{ __('Email') }}:</strong> <span id="modal-email"></span></p>
                    <p><strong>{{ __('Téléphone') }}:</strong> <span id="modal-telephone"></span></p>
                    <p><strong>{{ __('Adresse') }}:</strong> <span id="modal-adresse"></span></p>
                    <p><strong>{{ __('Code Postal') }}:</strong> <span id="modal-code-postal"></span></p>
                    <p><strong>{{ __('Ville') }}:</strong> <span id="modal-ville"></span></p>
                    <p><strong>{{ __('Pays') }}:</strong> <span id="modal-pays"></span></p>
                    <p><strong>{{ __('Taille') }}:</strong> <span id="modal-taille"></span></p>
                    <p><strong>{{ __('Couleur des Yeux') }}:</strong> <span id="modal-couleur-yeux"></span></p>
                    <p><strong>{{ __('Couleur des Cheveux') }}:</strong> <span id="modal-couleur-cheveux"></span></p>
                    <p><strong>{{ __('Signe Particulier') }}:</strong> <span id="modal-signe-particulier"></span></p>
                    <p><strong>{{ __('Motif') }}:</strong> <span id="modal-motif"></span></p>
                    <p><strong>{{ __('Nationalité') }}:</strong> <span id="modal-nationalite"></span></p>
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
            $('.view-client-btn').on('click', function() {
                const client = $(this).data('client');
                
                $('#modal-client-id').text(client.id);
                $('#modal-type').text(client.type);
                $('#modal-raison').text(client.raison);
                $('#modal-departement').text(client.departement);
                $('#modal-sexe').text(client.sexe);
                $('#modal-nom-naissance').text(client.nom_naissance);
                $('#modal-prenom1').text(client.prenom1);
                $('#modal-prenom2').text(client.prenom2);
                $('#modal-prenom3').text(client.prenom3);
                if (client.date_naissance) {
                    $('#modal-date-naissance').text(new Date(client.date_naissance).toLocaleDateString('fr-FR'));
                } else {
                    $('#modal-date-naissance').text('');
                }
                $('#modal-ville-naissance').text(client.ville_naissance);
                $('#modal-pays-naissance').text(client.pays_naissance);
                $('#modal-email').text(client.email);
                $('#modal-telephone').text(client.telephone);
                $('#modal-adresse').text(client.adresse);
                $('#modal-code-postal').text(client.code_postal);
                $('#modal-ville').text(client.ville);
                $('#modal-pays').text(client.pays);
                $('#modal-taille').text(client.taille);
                $('#modal-couleur-yeux').text(client.couleur_yeux);
                $('#modal-couleur-cheveux').text(client.couleur_cheveux);
                $('#modal-signe-particulier').text(client.signe_particulier);
                $('#modal-motif').text(client.motif);
                $('#modal-nationalite').text(client.nationalite);
                $('#modal-created-at').text(new Date(client.created_at).toLocaleString('fr-FR'));
                $('#modal-updated-at').text(new Date(client.updated_at).toLocaleString('fr-FR'));
            });
        });
    </script>
@endsection