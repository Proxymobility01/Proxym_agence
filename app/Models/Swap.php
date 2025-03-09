<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use HasFactory;

    protected $table = 'swaps';

    protected $fillable = [
        'battery_moto_user_association_id', // Clé étrangère vers la table 'battery_moto_user_association'
        'battery_in_id', // ID de la batterie entrante
        'battery_out_id', // ID de la batterie sortante
        'swap_date', // Date du swap
        'battery_in_soc',
        'battery_out_soc',
        'swap_price'
    ];

    /**
     * Définir la relation avec BatteryMotoUserAssociation
     */
    public function batteryMotoUserAssociation()
    {
        return $this->belongsTo(BatteryMotoUserAssociation::class, 'battery_moto_user_association_id');
    }

    /**
     * Relation avec l'utilisateur via BatteryMotoUserAssociation.
     */
    public function user()
    {
        // Utilisation de la relation avec AssociationUserMoto pour accéder à ValidatedUser
        return $this->batteryMotoUserAssociation->association->validatedUser();
    }


    public function swappeur()
    {
        // Utilisation de la relation avec AssociationUserMoto pour accéder à ValidatedUser
        return $this->belongsTo(UsersAgence::class, 'agent_user_id');
    }
    


    /**
     * Relation avec la moto via BatteryMotoUserAssociation.
     */
    public function moto()
    {
        // Relation directe avec la moto via BatteryMotoUserAssociation > AssociationUserMoto
        return $this->batteryMotoUserAssociation->association->motosValide();
    }
    

    
        public function batteryOut()
        {
            return $this->belongsTo(BatteriesValide::class, 'battery_out_id'); // Batterie sortante
        }
    
        public function batteryIn()
        {
            return $this->belongsTo(BatteriesValide::class, 'battery_in_id'); // Batterie entrante
        }
    
    


public function swapsIn()
{
    return $this->hasMany(Swap::class, 'battery_in_id');
}

}
