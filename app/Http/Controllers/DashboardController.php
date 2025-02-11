<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $agence = session('agence');  // Récupère l'objet agence stocké dans la session

        // Vérifiez si l'agence existe dans la session avant de l'utiliser
        if (!$agence) {
            return redirect()->route('login')->withErrors('L\'agence n\'est pas authentifiée');
        }


        // Passer la variable à la vue
        return view('layouts.app', compact('agence'));
    }
}
