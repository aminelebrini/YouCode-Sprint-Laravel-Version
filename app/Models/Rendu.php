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

    public function briefs()
    {
        return $this->belongsToMany(Brief::class, 'rendu_etudiant', 'rendu_id', 'brief_id');
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'rendu_etudiant', 'rendu_id', 'etudiant_id')->limit(1);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_brief', 'brief_id', 'competence_id');
    }
}
