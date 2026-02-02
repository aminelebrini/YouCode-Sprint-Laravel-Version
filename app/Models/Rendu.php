<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rendu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'rendu';

    protected $fillable = [
        'text',
        'description',
        'link',
        'date_soumission',
    ];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'rendu_etudiant');
    }
}
