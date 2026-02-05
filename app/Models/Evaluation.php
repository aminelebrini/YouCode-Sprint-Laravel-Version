<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentaire',
        'niveau_maitrise',
        'etudiant_id',
        'formateur_id',
        'brief_id',
        'competence_id'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id', 'user_id');
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id', 'user_id');
    }

    public function brief()
    {
        return $this->belongsTo(Brief::class, 'brief_id');
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competence_id');
    }
}