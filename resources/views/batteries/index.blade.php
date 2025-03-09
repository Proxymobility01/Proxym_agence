@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item {{ request()->is('agence_users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('agence.users') }}">Utilisateurs</a>
                </li>
                <li class="nav-item {{ request()->is('agence_users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('agence.users') }}">Agent Swap</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ================ Battery List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Listes des Batteries de l'Agence</h2>
        </div>

        <table id="example" class="table">
            <thead>
                <tr>
                    <th>Batterie Unique ID</th>
                    <th>MAC ID</th>
                    <th>Date de Production</th>
                    <th>Fabricant</th>
                    <th>Statut</th>
                </tr>
            </thead>

            <tbody>
                @foreach($batteries as $battery)
                <tr>
                    <td>{{ $battery->batteryValide->batterie_unique_id }}</td>
                    <td>{{ $battery->batteryValide->mac_id }}</td>
                    <td>{{ $battery->batteryValide->date_production }}</td>
                    <td>{{ $battery->batteryValide->fabriquant }}</td>
                    <td>{{ $battery->batteryValide->statut }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Initialisation de DataTables
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

@endsection
