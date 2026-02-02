<?php

namespace App\Http\Repository;

use App\Models\Classe;
use App\Models\Competence;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public function create_users($nom, $prenom, $role, $email, $password)
    {
        $user = User::create([
            'firstname' => $nom,
            'lastname' => $prenom,
            'role' => $role,
            'email' => $email,
            'password' => hash::make($password),
        ]);

    }

    public function createSprint($titre, $dateDebut, $dateFin)
    {

        $sprints = Sprint::create([
            'nom' => $titre,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ]);
    }
    public function getSprint()
    {
        return Sprint::all();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getClasses()
    {
        return Classe::all();
    }

    public function getCompetence()
    {
        return Competence::all();
    }
}
