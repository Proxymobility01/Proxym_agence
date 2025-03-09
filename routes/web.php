<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Users\AgenceUserController;
use App\Http\Controllers\AgenceAuthController;
use App\Http\Controllers\Batteries\BatteryController;
use App\Http\Controllers\Historiques\HistoriqueController;
use App\Http\Controllers\Historiques\SwapController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('auth.login');  // Vue de la page de connexion
})->name('login');

Route::post('login', [AgenceAuthController::class, 'authenticate']);

//Route::middleware(['auth.agence'])->group(function () {
    // Route pour la déconnexion
    Route::post('logout', [AgenceAuthController::class, 'logout'])->name('logout');
    
    // Routes protégées par authentification
    Route::post('/create-agent-swap', [AgentSwapController::class, 'create'])->name('create.agent.swap');
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Afficher les utilisateurs de l'agence
   Route::get('/agence_users', [AgenceUserController::class, 'index'])->name('agence.users');

   //afficher les batteries de l'agence
   Route::get('/batteries', [BatteryController::class, 'index'])->name('batteries.index');

   
    // afficher l'historique des swaps de l'agence
   Route::get('/historique-agence', [HistoriqueController::class, 'index'])->name('historique.agence');

   Route::get('/swap-chauffeurs', [SwapController::class, 'showSwapsForAgence'])->name('swap.chauffeurs');

    
  
//});



// Enregistrer un nouvel agent swap
Route::post('/agence_users', [AgenceUserController::class, 'store'])->name('agence.users.store');

// Supprimer un agent swap
Route::delete('/agence_users/{agenceUser}', [AgenceUserController::class, 'destroy'])->name('agence.users.destroy');
