<?php

namespace App\Http\Controllers\Historiques;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Swap;
use App\Models\Agence;

class SwapController extends Controller
{
    public function showSwapsForAgence()
    {
        $pageTitle = 'Historique des Swaps';

        // Vérifiez si l'agence est présente dans la session
        $agence = session('agence');  // Récupère l'objet agence stocké dans la session
        
        // Si l'agence n'est pas trouvée dans la session, rediriger vers la page de connexion
        if (!$agence) {
            return redirect()->route('login')->withErrors('L\'agence n\'est pas authentifiée');
        }

        // Récupérer l'ID de l'agence à partir de la session
        $agenceId = $agence->id;

        // Récupérer tous les swaps pour l'agence en fonction de l'utilisateur
        $swaps = Swap::with([
            'batteryOut',  // Charger la batterie sortante
            'batteryIn',   // Charger la batterie entrante
            'swappeur',     // Charger le swappeur
            'batteryMotoUserAssociation.association.validatedUser', // Utilisateur
            'batteryMotoUserAssociation.association.motosValide',   // Moto
        ])
        ->whereHas('swappeur.agence', function ($query) use ($agenceId) {
            $query->where('id_agence', $agenceId);
        })
        ->get();

        // Ajouter les pourcentages SOC des batteries dans les résultats
        foreach ($swaps as $swap) {
            $swap->battery_out_soc = $swap->battery_out_soc ?? '--'; // Valeur par défaut si SOC non disponible
            $swap->battery_in_soc = $swap->battery_in_soc ?? '--';  // Valeur par défaut si SOC non disponible
        }

        // Passer les swaps et l'agence à la vue
        return view('historiques.swap_chauffeur', compact('swaps', 'pageTitle', 'agence'));
    }
}
