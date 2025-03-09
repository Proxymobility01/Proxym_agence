<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotosValide extends Model
{
    use HasFactory;

    protected $table = 'motos_valides';

    protected $fillable = [
        'vin',
        'moto_unique_id',
        'model',
        'gps',
        'assurance',
        'permis',
        'gps_imei'
    ];

   

    // Relation many-to-many avec les utilisateurs validés via la table pivot 'association_user_motos'
    public function users()
    {
        return $this->belongsToMany(ValidatedUser::class, 'association_user_motos', 'moto_valide_id', 'validated_user_id');
    }

    // Relation many-to-many avec BatteriesValide via la table pivot 'battery_moto_user_association'
    public function batteries()
    {
        return $this->belongsToMany(BatteriesValide::class, 'battery_moto_user_association');
    }

    // Dans le modèle MotosValide :
    public function swaps()
    {
        return $this->hasMany(Swap::class);
    }

}
