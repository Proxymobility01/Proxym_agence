<?php



namespace App\Http\Controllers\Batteries;

use App\Http\Controllers\Controller;
use App\Models\BatteryAgence; // Utilisation du modèle BatteryAgence
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    /**
     * Affiche les batteries d'une agence spécifique.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Vérifiez si l'agence est présente dans la session
        $agence = session('agence');  // Récupère l'objet agence stocké dans la session
        
        // Si l'agence n'est pas trouvée dans la session, rediriger vers la page de connexion
        if (!$agence) {
            return redirect()->route('login')->withErrors('L\'agence n\'est pas authentifiée');
        }
    
        // Récupérer l'ID de l'agence à partir de la session
        $agenceId = $agence->id;
    
        // Récupérer toutes les batteries liées à cette agence
        $batteries = BatteryAgence::where('id_agence', $agenceId)
            ->with('batteryValide') // Charger la relation avec la batterie valide
            ->get();
    
        // Passer les batteries et l'agence à la vue
        return view('batteries.index', compact('batteries', 'agence'));
    }
    
}
