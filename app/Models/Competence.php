<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'created_at',
    ];

    public function briefs()
    {
        return $this->belongsToMany(Brief::class, 'competence_brief');
    }
}
