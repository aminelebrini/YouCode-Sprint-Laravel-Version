<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'user_id',
        'level',
        'classe_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function rendus()
    {
        return $this->belongsToMany(Rendu::class, 'rendu_etudiant');
    }
}
