<?php

namespace App\Http\Services;

use App\Http\Repository\AdminRepository;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /* ========== USERS ========== */
    public function createUser($nom, $prenom, $role, $email, $password)
    {
        return $this->adminRepository->createUser($nom, $prenom, $role, $email, $password);
    }

    /* ========== CLASSES ========== */
    public function createClasse($nom, $capacity, $anneeScolaire)
    {
        return $this->adminRepository->createClasse($nom, $capacity, $anneeScolaire);
    }

    /* ========== SPRINTS ========== */
    public function createSprint($titre, $dateDebut, $dateFin)
    {
        return $this->adminRepository->createSprint($titre, $dateDebut, $dateFin);
    }

    /* ========== ASSIGNATION ========== */
    public function assignerFormateur($classeId, $formateurId)
    {
        return $this->adminRepository->assignerFormateur($classeId, $formateurId);
    }

    /* ========== SKILLS ========== */
    public function addSkill($competenceName)
    {
        return $this->adminRepository->addSkill($competenceName);
    }

    /* ========== GETTERS ========== */
    public function getUsers()
    {
        return $this->adminRepository->getUsers();
    }

    public function getSprints()
    {
        return $this->adminRepository->getSprints() ?? [];
    }

    public function getClasses()
    {
        return $this->adminRepository->getClasses() ?? [];
    }

    public function getCompetences()
    {
        return $this->adminRepository->getCompetences() ?? [];
    }
}
