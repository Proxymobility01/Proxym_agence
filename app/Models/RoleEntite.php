<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleEntite extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    // Si un rôle est associé à plusieurs utilisateurs (UserAgences, UserEntrepots)
    public function usersAgences()
    {
        return $this->hasMany(UserAgences::class, 'id_role_entite');
    }

    public function usersEntrepots()
    {
        return $this->hasMany(UserEntrepots::class, 'id_role_entite');
    }
}
