<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
<!-- Extension de app.blade.php -->

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
                <!-- Utilisateurs -->
                <li class="nav-item {{ request()->is('agence_users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('agence.users') }}">Utilisateurs</a>
                </li>

                <!-- Agent Swap -->
                <li class="nav-item {{ request()->is('agence_users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('agence.users') }}">Agent Swap</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Navbar -->

<!-- ================ Swap Users List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Listes des Agents Swap</h2>
            <a href="#" class="btn">Voir Tout</a>
        </div>

        <table   id="example" class="table">
    <thead>
        <tr>
            <th>Nom et Prenom</th>
            <th>Phone</th>
            <th>Ville</th>
            <th>Quartier</th>
            <th>Photo</th>
            <th>Email</th> <!-- Ajout de la colonne Email -->
            <th>Rôle</th> <!-- Ajout de la colonne Rôle -->
        </tr>
    </thead>

    <tbody>
        @foreach($agents as $agent)
        <tr>
            <td>{{ $agent->nom }} {{ $agent->prenom }}</td>
            <td>{{ $agent->phone }}</td>
            <td>{{ $agent->ville }}</td>
            <td>{{ $agent->quartier }}</td>
            <td>
                <img src="{{ asset('storage/' . $agent->photo) }}" alt="Photo" class="img-fluid" width="50">
            </td>
            <td>{{ $agent->email }}</td> <!-- Affichage de l'email -->
            <td>{{ $agent->role ? $agent->role->title : 'N/A' }}</td> <!-- Affichage du rôle, avec vérification si le rôle existe -->
        </tr>
        @endforeach
    </tbody>
</table>

    </div>

    <!-- ================= Add Swap User Form ================ -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Ajouter un Agent Swap</h2>
        </div>

        <!-- Bootstrap Form to Add a Swap User -->
        <form action="{{ route('agence.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="nom..." required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom..." required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="téléphone..." required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email..." required>
                </div>
                <!-- Champ select pour le rôle -->
            <div class="form-group col-md-6">
                <label for="role_entite">Rôle</label>
                <select class="form-control" id="role_entite" name="id_role_entite" required>
                    <option value="">Sélectionner un rôle...</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                    @endforeach
                </select>
            </div>

                <div class="form-group col-md-6">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" placeholder="ville..." required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="quartier">Quartier</label>
                    <input type="text" class="form-control" id="quartier" name="quartier" placeholder="quartier..."
                        required>
                </div>

                <div class="form-group col-md-6 mb-0">
                    <label for="photo">Photo</label>
                    <label for="photo" class="btn-perso file-label mb-2">Choisir une Photo</label>
                    <input type="file" class="form-control file-input" id="photo" name="photo" required>
                    <div id="file-name" class="mt-2 text-muted">Aucun fichier selectioné</div>
                </div>
            </div>
            

            <div class="form-group col-md-12 ">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..."
                    required>
            </div>

            <div class="form-group col-md-12 ">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirmer le mot de passe..." required>
            </div>

            <button type="submit" class="btn-perso">Ajouter l'Agent Swap</button>
        </form>

    </div>
</div>
</div>

<script>
document.getElementById('photo').addEventListener('change', function() {
    var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
    document.getElementById('file-name').textContent = 'Fichier : ' + fileName;
});
</script>

<script>
// Initialization for ES Users
import {
    Dropdown,
    Collapse,
    initMDB
} from "mdb-ui-kit";

initMDB({
    Dropdown,
    Collapse
});
</script>
<script>
// Ajout de la classe 'active' au lien correspondant à l'URL actuelle
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;

    // Liste des liens de la navbar
    const navLinks = document.querySelectorAll('.navbar-nav .nav-item');

    navLinks.forEach(link => {
        const linkPath = link.querySelector('a').getAttribute('href');

        // Comparer l'URL actuelle avec l'URL du lien
        if (currentPath === linkPath) {
            link.classList.add('active'); // Ajouter la classe active si l'URL correspond
        }
    });
});
</script>


<!-- Inclusion des fichiers JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>

<script>
    // Initialisation de DataTables
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection