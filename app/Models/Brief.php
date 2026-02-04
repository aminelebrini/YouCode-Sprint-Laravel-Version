<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brief extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'description',
        'type',
        'sprint_id',
        'date_debut',
        'date_fin',
        'formateur_id',
    ];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_brief', 'brief_id','id');
    }
}
