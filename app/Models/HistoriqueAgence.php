<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueAgence extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_agence', 'id_distributeur','id_entrepot', 'bat_sortante', 'bat_entrante', 'type_swap', 'date_time',
    ];

    // Relation avec l'agence
    public function agence()
    {
        return $this->belongsTo(Agence::class, 'id_agence');
    }

    // Relation avec le distributeur (peut être null si l'agence reçoit directement de l'entrepôt)
    public function distributeur()
    {
        return $this->belongsTo(Distributeur::class, 'id_distributeur');
    }

    // Relation avec la batterie sortante
    public function batterySortante()
    {
        return $this->belongsTo(BatteriesValide::class, 'bat_sortante');
    }

    // Relation avec la batterie entrante
    public function batteryEntrante()
    {
        return $this->belongsTo(BatteriesValide::class, 'bat_entrante');
    }

    // Relation avec l'entrepôt (peut être null si le distributeur est impliqué)
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class, 'id_entrepot');
    }

    // Relation avec l'utilisateur de l'entrepôt (l'utilisateur qui a effectué la transaction)
    public function userEntrepot()
    {
        return $this->belongsTo(UsersEntrepot::class, 'id_user_entrepot');
    }
}
