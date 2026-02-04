<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'nombre',
        'promo',
        'taux',
    ];

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function formateurs()
    {
        return $this->belongsToMany(
            User::class,
            'formateurs_classe',
            'classe_id',
            'formateur_id'
        )->where('role', 'formateur');    }
}
