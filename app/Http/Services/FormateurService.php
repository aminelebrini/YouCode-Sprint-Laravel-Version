<?php

    namespace App\Http\Services;
    use App\Http\Repository\FormateurRepository;

    class FormateurService
    {
        private $FormateurRepository;

        public function __construct(FormateurRepository $FormateurRepository)
        {
            $this->FormateurRepository = $FormateurRepository;
        }
        public function CreateBrief($Titre,$DateDebut,$DateFin,$SprintId,$type,$CompetenceId,$Description,$Formateur_id)
        {
            return $this->FormateurRepository->Create_Brief($Titre,$DateDebut,$DateFin,$SprintId,$type,$CompetenceId,$Description,$Formateur_id);
        }

        public function AssignStudents($studentId,$classId)
        {
            return $this->FormateurRepository->Assign_Students($studentId,$classId);
        }

        public function CorrectionRendu($renduId,$briefId,$etudiantId,$commentaire,$competenceId,$levels)
        {
            return $this->FormateurRepository->CorrectionRendu($renduId,$briefId,$etudiantId,$commentaire,$competenceId,$levels);
        }

        public function getUsers()
        {
            $users = $this->FormateurRepository->getUsers();
        }
        public function get_Sprints()
        {
            $sprints = $this->FormateurRepository->getSprint();
            return $sprints ?? [];
        }
        public function get_Classes()
        {
            $classes = $this->FormateurRepository->getClasses();
            return $classes ?? [];
        }
        public function get_Competence()
        {
            $comperences = $this->FormateurRepository->getCompetence();
            return $comperences ?? [];
        }
        public function get_Brief()
        {
            $briefs = $this->FormateurRepository->getAllBriefs();
            return $briefs ?? [];
        }
        public function get_Etudiant()
        {
            $etudiants = $this->FormateurRepository->getEtudiant();
            return $etudiants ?? [];
        }
        public function getAllRendu()
        {
            $rendus = $this->FormateurRepository->getAll_Rendu();
            return $rendus ?? [];
        }
    }
?>
