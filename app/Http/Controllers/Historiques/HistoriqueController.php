<?php

namespace App\Http\Controllers\Historiques;


use App\Models\HistoriqueAgence;
use App\Models\UsersEntrepot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\TransactionsExport;

class HistoriqueController extends Controller 
{
    public function index(Request $request) 
    {
        // Vérifiez si l'agence est présente dans la session
        $agence = session('agence');
        
        // Récupère l'ID de l'agence à partir de la session
        $agenceId = $agence ? $agence->id : null;
        
        // Vérifiez si l'agence existe avant de récupérer l'historique
        if (!$agenceId) {
            return redirect()->route('login')->withErrors('L\'agence n\'est pas authentifiée');
        }
        
        // Paramètres de filtrage et pagination
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');
        $typeSwap = $request->input('type_swap');
        
        // Construction de la requête de base
        $query = HistoriqueAgence::where('id_agence', $agenceId);
        
        // Appliquer les filtres si présents
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('bat_sortante', 'LIKE', "%$search%")
                  ->orWhere('bat_entrante', 'LIKE', "%$search%");
            });
        }
        
        if ($dateDebut) {
            $query->where('date_time', '>=', Carbon::parse($dateDebut)->startOfDay());
        }
        
        if ($dateFin) {
            $query->where('date_time', '<=', Carbon::parse($dateFin)->endOfDay());
        }
        
        if ($typeSwap) {
            $query->where('type_swap', $typeSwap);
        }
        
        // Récupérer l'historique des transactions, trié par date décroissante
        $historique = $query->orderBy('date_time', 'desc')
                           ->paginate($perPage);
        
        // Traiter chaque transaction pour décoder les données JSON
        foreach ($historique as $transaction) {


 // Si aucun distributeur, récupérer l'utilisateur de l'entrepôt
 $user = $transaction->userEntrepot;
 $transaction->user_name = $user ? $user->nom . ' ' . $user->prenom : 'Utilisateur inconnu';
            
            // Traitement des batteries sortantes
            $transaction->bat_sortante = $this->decodeBatteries($transaction->bat_sortante);
            
            // Traitement des batteries entrantes
            $transaction->bat_entrante = $this->decodeBatteries($transaction->bat_entrante);
            
            // Formatage de la date
            $transaction->formatted_date = Carbon::parse($transaction->date_time)->format('d/m/Y H:i');
        }

          // Add response format handling
        $format = $request->input('format');
        if ($format) {
            return $this->export($request, $format);
        }
        
        // Préparer les données pour la vue
        $data = [
            'historique' => $historique,
            'agence' => $agence,
            'filters' => [
                'search' => $search,
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'type_swap' => $typeSwap
                ]
        ];

      
        
        // Retourner la vue avec les données
        return view('historiques.index', $data);
    }
    
    /**
     * Décode les données des batteries depuis JSON
     *
     * @param mixed $batteries
     * @return array
     */
    private function decodeBatteries($batteries)
    {
        if (empty($batteries)) {
            return [];
        }
        
        // Si c'est déjà un tableau, le retourner tel quel
        if (is_array($batteries)) {
            return $batteries;
        }
        
        // Si c'est une chaîne JSON, la décoder
        if (is_string($batteries)) {
            try {
                $decoded = json_decode($batteries, true);
                return is_array($decoded) ? $decoded : [];
            } catch (\Exception $e) {
                // En cas d'erreur de décodage, retourner un tableau vide
                return [];
            }
        }
        
        // Par défaut, retourner un tableau vide
        return [];
    }
    
    /**
     * Récupère les détails d'une transaction spécifique
     */
    public function show($id)
    {
        $agence = session('agence');
        
        if (!$agence) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }
        
        $transaction = HistoriqueAgence::where('id_agence', $agence->id)
                                     ->where('id', $id)
                                     ->first();
        
        if (!$transaction) {
            return response()->json(['error' => 'Transaction non trouvée'], 404);
        }
        
        // Décoder les batteries
        $transaction->bat_sortante = $this->decodeBatteries($transaction->bat_sortante);
        $transaction->bat_entrante = $this->decodeBatteries($transaction->bat_entrante);
        
        return response()->json($transaction);
    }
    
    /**
     * Exporte l'historique en CSV
     */
    public function export(Request $request)
    {
        $agence = session('agence');
        
        if (!$agence) {
            return redirect()->route('login')->withErrors('L\'agence n\'est pas authentifiée');
        }
        
        // Récupérer toutes les transactions pour l'export
        $transactions = HistoriqueAgence::where('id_agence', $agence->id)
                                      ->orderBy('date_time', 'desc')
                                      ->get();
        
        // Nom du fichier
        $filename = 'historique_transactions_' . date('Y-m-d') . '.csv';
        
        // Headers pour le téléchargement
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        // Créer le CSV
        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'Type de Swap',
                'Batteries Sortantes',
                'Batteries Entrantes',
                'Distributeur',
                'Date et Heure'
            ]);
            
            // Données
            foreach ($transactions as $transaction) {
                $batteriesSortantes = implode(', ', $this->decodeBatteries($transaction->bat_sortante));
                $batteriesEntrantes = implode(', ', $this->decodeBatteries($transaction->bat_entrante));
                
                fputcsv($file, [
                    $transaction->type_swap,
                    $batteriesSortantes,
                    $batteriesEntrantes,
                    $transaction->distributeur ? $transaction->distributeur->nom . ' ' . $transaction->distributeur->prenom : 'Pas de distributeur',
                    Carbon::parse($transaction->date_time)->format('d/m/Y H:i')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

     
}