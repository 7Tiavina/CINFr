@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>{{ __('Clients') }}</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Raison') }}</th>
                    <th>{{ __('Département') }}</th>
                    <th>{{ __('Sexe') }}</th>
                    <th>{{ __('Nom de Naissance') }}</th>
                    <th>{{ __('Prénom') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Créé le') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->type }}</td>
                        <td>{{ $client->raison }}</td>
                        <td>{{ $client->departement }}</td>
                        <td>{{ $client->sexe }}</td>
                        <td>{{ $client->nom_naissance }}</td>
                        <td>{{ $client->prenom1 }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
