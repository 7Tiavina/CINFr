@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Clients</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Raison</th>
                    <th>Departement</th>
                    <th>Sexe</th>
                    <th>Nom Naissance</th>
                    <th>Prenom1</th>
                    <th>Email</th>
                    <th>Created At</th>
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
