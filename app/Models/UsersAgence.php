<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAgence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_agence_unique_id', 
        'nom',
        'prenom',
        'phone' ,
        'email',  
        'password',
        'ville',
        'photo',   
        'quartier', 
        'id_role_entite', 'id_agence',
    ];

    // Relation avec le rôle (un utilisateur a un rôle)
    public function role()
    {
        return $this->belongsTo(RoleEntite::class, 'id_role_entite');
    }

    // Relation avec l'agence (un utilisateur appartient à une agence)
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence');
    }
}
