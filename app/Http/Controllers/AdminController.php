<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Services\AdminService;

class AdminController extends Controller
{
    private $AdminService;
    public function __construct(AdminService $AdminService)
    {
        $this->AdminService = $AdminService;
    }
    public function Create()
    {
        $nom = request('nom');
        $prenom = request('prenom');
        $role = request('role');
        $email = request('email');
        $password = request('password');

        echo $nom;
        if($this->AdminService->CreateUser($nom, $prenom, $role, $email, $password))
        {
            return redirect()
                ->route('admindash')
                ->with('success', 'Compte créé avec succès');
        } else {
            return redirect()
                ->route('admindash')
                ->withErrors(['error' => 'Erreur lors de la création']);
        }
    }
    public function addSprint()
    {
        $titre = $_POST['titre'] ?? null;
        $dateDebut = $_POST['date_debut'] ?? null;
        $dateFin = $_POST['date_fin'] ?? null;

        if($this->AdminService->createSprint($titre, $dateDebut, $dateFin))
        {
            header('Location: /admindash');
            exit();
        } else {
            die("Erreur lors de l'ajout du sprint");
        }
    }

    public function add_class()
    {
        $nom = $_POST['class_name'];
        $capacity = $_POST['capacity'];
        $annescolaire = $_POST['annee_scolaire'];

        if($this->AdminService->CreateClasse($nom,$capacity,$annescolaire))
        {
            header('Location: /admindash');
            exit();
        } else {
            die("Erreur lors de l'ajout du classe");
        }
    }

    public function assignation()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $ClasseId = $_POST['class_id'];
            $FormateurId = $_POST['teacher_id'];

            if(!$this->AdminService->AssignerFormateur($ClasseId,$FormateurId))
            {
                die("Erreur lors de l'ajout du fromateur");

            }
            header('Location: /admindash');
            exit();
        }
    }

    public function add_skill()
    {
        $ComperenceName = $_POST['competence_name'];

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(!$this->AdminService->addSkill($ComperenceName))
            {
                die("Erreur lors de l'ajout du Competence");

            }
            header('Location: /admindash');
            exit();
        }

    }

//    public function modifier_info()
//    {
//
//    }


    public function index()
    {
        $sprints = $this->AdminService->get_Sprints() ?? [];
        $users = $this->AdminService->getUsers() ?? [];
        $classes = $this->AdminService->get_Classes() ?? [];
        $competences = $this->AdminService->get_Competence() ?? [];

//        $sprints = [];
//        $users = [];
//        $classes = [];
//        $competences = [];
        return view('admindash', [
            'sprints' => $sprints,
            'users' => $users,
            'classes' => $classes,
            'competences' => $competences
        ]);
    }
}
