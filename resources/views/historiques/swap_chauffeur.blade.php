@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $pageTitle }} - {{ $agence->nom_agence }}</h1>

        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>ID Unique Utilisateur</th>
                    <th>Nom Utilisateur</th>
                    <th>ID Unique Moto</th>
                    <th>Modèle Moto</th>
                    <th>Batterie Entrée dans la station</th>
                    <th>% de la Batterie Entrée</th>
                    <th>Batterie Sortie de la station</th>
                    <th>% de la Batterie Sortie</th>
                    <th>Prix du Swap</th>
                    <th>Station</th>
                    <th>Swappeur</th>
                    <th>Date du Swap</th>
                </tr>
            </thead>
            <tbody>
                @foreach($swaps as $swap)
                    <tr>
                        <td>{{ $swap->user->user_unique_id ?? 'Non défini' }}</td>
                        <td>{{ $swap->user->nom ?? 'Nom non défini' }} {{ $swap->user->prenom ?? 'Prénom non défini' }}</td>
                        <td>{{ $swap->moto->moto_unique_id ?? 'Non défini' }}</td>
                        <td>{{ $swap->moto->model ?? 'Modèle non défini' }}</td>
                        <td>{{ $swap->batteryOut->mac_id ?? 'Non défini' }}</td>
                        <td>{{ $swap->battery_out_soc }}%</td>
                        <td>{{ $swap->batteryIn->mac_id ?? 'Non défini' }}</td>
                        <td>{{ $swap->battery_in_soc }}%</td>
                        <td>{{ $swap->swap_price }} FCFA</td>
                        <td>{{ $swap->swappeur->agence->nom_agence }}</td>
                        <td>{{ $swap->swappeur->nom }} {{ $swap->swappeur->prenom }}</td>
                        <td>{{ $swap->swap_date ?? 'Non défini' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
