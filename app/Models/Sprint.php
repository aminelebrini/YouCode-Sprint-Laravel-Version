<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nom',
        'date_debut',
        'date_fin',
        'classe_id'
    ];


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function briefs()
    {
        return $this->hasMany(Brief::class);
    }
}
