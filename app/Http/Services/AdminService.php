<?php

namespace App\Http\Services;
use App\Http\Repository\AdminRepository;

class AdminService
{
    private $AdminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->AdminRepository = $adminRepository;
    }
    public function CreateUser($nom, $prenom, $role,$email,$password)
    {
        return $this->AdminRepository->create_users($nom, $prenom, $role,$email,$password);
    }
    public function CreateClasse($nom,$capacity,$annescolaire)
    {
        return $this->AdminRepository->Create_Classe($nom,$capacity,$annescolaire);
    }
    public function createSprint($titre, $dateDebut, $dateFin)
    {
        return $this->AdminRepository->createSprint($titre, $dateDebut, $dateFin);
    }
    public function AssignerFormateur($ClasseId,$FormateurId)
    {
        return $this->AdminRepository->Assigne($ClasseId,$FormateurId);
    }
    public function addSkill($ComperenceName)
    {
        return $this->AdminRepository->add_Skill($ComperenceName);
    }
    public function get_Sprints()
    {
       return $sprints = $this->AdminRepository->getSprint();

    }
    public function get_Classes()
    {
        $classes = $this->AdminRepository->getClasses();
        return $classes ?? [];
    }
    public function get_Competence()
    {
        $comperences = $this->AdminRepository->getCompetence();
        return $comperences ?? [];
    }

    public function getUsers()
    {
        return $this->AdminRepository->getUsers();
    }
}
?>
