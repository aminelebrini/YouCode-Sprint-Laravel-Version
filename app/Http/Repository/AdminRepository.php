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
    public function createUser(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'role'      => $data['role'] ?? 'Etudiant',
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        if($data['role'] === 'Formateur') {
            $formateur = Formateur::create([
                'username' => strtolower($data['firstname'] . $data['lastname']),
                'user_id'  => $user->id,
            ]);
        }

        return $user;

    }

    /* ========== SPRINTS ========== */
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

    /* ========== CLASSES ========== */
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

    /* ========== COMPETENCES ========== */
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

    /* ========== ASSIGNATION FORMATEUR ========== */
    public function assignerFormateur($classeId, $formateurId)
    {
        return \DB::table('formateurs_classe')->insert([
            'classe_id'     => $classeId,
            'formateur_id'  => $formateurId,
        ]);
    }

    /* ========== USERS LIST ========== */
    public function getUsers()
    {
        return User::all();
    }
}
