<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $agence->nom_agence ?? 'Mon Application' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  


    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
   <!-- =============== Navigation ================ -->
<div class="container-perso">
    <div class="navigation">
        <ul>
            <!-- Brand Name -->
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="logo-apple"></ion-icon>
                    </span>
                    <span class="title">{{ $agence->nom_agence }}</span>
                </a>
            </li>

            <!-- Dashboard -->
            <li class="{{ request()->is('') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <!-- Utilisateurs (Swap Users) -->
            <li class="{{ request()->is('agence_users') ? 'active' : '' }}">
                <a href="{{ route('agence.users') }}">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Utilisateurs</span>
                </a>
            </li>

            <!-- Messages -->
            <li class="{{ request()->is('messages') ? 'active' : '' }}">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Messages</span>
                </a>
            </li>

            <!-- Help -->
            <li class="{{ request()->is('help') ? 'active' : '' }}">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title">Help</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="{{ request()->is('settings') ? 'active' : '' }}">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>

            <!-- Password -->
            <li class="{{ request()->is('password') ? 'active' : '' }}">
                <a href="#">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Password</span>
                </a>
            </li>

            <!-- Sign Out -->
            <li class="{{ request()->is('signout') ? 'active' : '' }}">
                <a href="{{ route('logout') }}">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Deconnexion</span>
                </a>
            </li>
        </ul>
    </div>
</div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <!-- Inclure l'en-tête -->
            @include('layouts.partials.searchbar')

            <!-- Le contenu spécifique de chaque page sera injecté ici -->
            @yield('content')
           
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <!-- Bootstrap CDN -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>