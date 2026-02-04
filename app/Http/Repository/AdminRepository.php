<?php

namespace App\Http\Repository;

use App\Models\Classe;
use App\Models\Competence;
use App\Models\Formateur;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public function createUser($nom, $prenom, $role, $email, $password)
    {
        $user = User::create([
            'firstname' => $nom,
            'lastname'  => $prenom,
            'role'      => $role,
            'email'     => $email,
            'password'  => Hash::make($password),
        ]);

        if($user->role === 'formateur') {
            $formateur = Formateur::create([
                'username' => strtolower($user->firstname . $user->lastname),
                'user_id'  => $user->id,
            ]);
        }
        return $user;

    }

    public function createSprint($titre, $dateDebut, $dateFin)
    {
        return Sprint::create([
            'nom'        => $titre,
            'date_debut' => $dateDebut,
            'date_fin'   => $dateFin,
        ]);
    }

    public function getSprints()
    {
        return Sprint::all();
    }

    public function createClasse($nom, $capacity, $anneeScolaire)
    {
        return Classe::create([
            'nom'    => $nom,
            'nombre' => $capacity,
            'promo'  => $anneeScolaire,
            'taux' => 0
        ]);
    }

    public function getClasses()
    {
        return Classe::all();
    }

    public function addSkill($competenceName)
    {
        return Competence::create([
            'nom'        => $competenceName,
            'created_at' => now(),
        ]);
    }

    public function getCompetences()
    {
        return Competence::all();
    }

    public function assignerFormateur($classeId, $formateurId)
    {
        return \DB::table('formateurs_classe')->insert([
            'formateur_id'  => $formateurId,
            'classe_id'     => $classeId,
        ]);
    }

    public function getUsers()
    {
        return User::all();
    }
}
