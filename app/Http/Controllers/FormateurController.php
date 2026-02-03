<?php

namespace App\Http\Controllers;

use App\Http\Services\FormateurService;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    private $FormateurService;

    public function __construct(FormateurService $FormateurService) {

        $this->FormateurService = $FormateurService;
    }

    public function creer_brief()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $Titre = $_POST['titre'] ?? [];
            $DateDebut = $_POST['date_debut'] ?? [];
            $DateFin = $_POST['date_fin'] ?? [];
            $SprintId = $_POST['sprint_id'] ?? [];
            $type = $_POST['type'] ?? [];
            $CompetenceId = $_POST['competence_ids'];
            $Description = $_POST['description'];
            $Formateur_id = $_POST['formateur_id'];

            if($this->FormateurService->CreateBrief($Titre,$DateDebut,$DateFin,$SprintId,$type,$CompetenceId,$Description,$Formateur_id))
            {
                header('Location: /formateurdash');
                exit();
            } else {
                die("Erreur lors de l'ajout du Brief");
            }
        }
    }

    public function assign_students()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $studentId = $_POST['student_id'] ?? null;
            $classId   = $_POST['classes_id'] ?? null;

            echo $studentId;
            echo "<br>";
            echo "form" . $classId;

            if($this->FormateurService->AssignStudents($studentId,$classId))
            {
                header('Location: /formateurdash');
                exit();
            } else {
                die("Erreur lors de l'ajout du Brief");
            }
        }

    }
    public function index()
    {
        $users = $this->UserService->getUsers() ?? [];
        $classes = $this->FormateurService->get_Classes() ?? [];
        $sprints = $this->FormateurService->get_Sprints() ?? [];
        $competences = $this->FormateurService->get_Competence() ?? [];
        $briefs = $this->FormateurService->get_Brief() ?? [];
        $etudiants = $this->FormateurService->get_Etudiant() ?? [];
        $rendus = $this->FormateurService->getAllRendu() ?? [];

        return view('formateurdash',[
            'title' => "Formateur Dashboard",
            'users' => $users,
            'classes' => $classes,
            'sprints' => $sprints,
            'competences' => $competences,
            'briefs' => $briefs,
            'etudiants' => $etudiants,
            'rendus' => $rendus
        ]);
    }
}
