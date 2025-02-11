<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Users\AgenceUserController;
use App\Http\Controllers\AgenceAuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('auth.login');  // Vue de la page de connexion
})->name('login');

Route::post('login', [AgenceAuthController::class, 'authenticate']);

//Route::middleware(['auth.agence'])->group(function () {
    // Route pour la déconnexion
    Route::post('logout', [AgenceAuthController::class, 'destroy'])->name('logout');
    
    // Routes protégées par authentification
    Route::get('/create-agent-swap', [AgentSwapController::class, 'create'])->name('create.agent.swap');
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Afficher les utilisateurs de l'agence
   Route::get('/agence_users', [AgenceUserController::class, 'index'])->name('agence.users');
    
  
//});



// Enregistrer un nouvel agent swap
Route::post('/agence_users', [AgenceUserController::class, 'store'])->name('agence.users.store');

// Supprimer un agent swap
Route::delete('/agence_users/{agenceUser}', [AgenceUserController::class, 'destroy'])->name('agence.users.destroy');
