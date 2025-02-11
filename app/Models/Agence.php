<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agence extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'agence_unique_id', // Identifiant unique de l'agence
        'nom_agence',
        'nom_proprietaire',
        'ville',
        'quartier',
        'telephone',
        'email',
        'description',
        'logo',
        'password',  // Mot de passe pour l'authentification de l'agence
    ];

    public function agentsSwap()
    {
        return $this->hasMany(AgentSwap::class, 'agency_id');
    }

    // Authentification de l'agence (si nécessaire pour l'API ou la connexion)
    protected $hidden = [
        'password',  // Ne pas exposer le mot de passe
    ];
}
