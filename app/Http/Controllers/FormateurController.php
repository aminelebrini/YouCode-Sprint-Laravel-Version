<?php

namespace App\Http\Controllers;

use App\Http\Services\FormateurService;
use App\Models\Formateur;
use App\Models\Brief;
use App\Models\Classe;
use App\Models\Competence;
use App\Models\Etudiant;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    private $FormateurService;

    public function __construct(FormateurService $FormateurService) {

        $this->FormateurService = $FormateurService;
    }

    public function creer_brief(Request $request)
    {

        $Titre = $request->titre;
        $DateDebut = $request->date_debut;
        $DateFin = $request->date_fin;
        $SprintId = $request->sprint_id;
        $type = 'type';
        $CompetenceId = $request->competence_ids;
        $Description = $request->description;
        $Formateur_id = $request->formateur_id;

        if($this->FormateurService->CreateBrief($Titre,$DateDebut,$DateFin,$SprintId,$type,$CompetenceId,$Description,$Formateur_id)) {

            return redirect()->route('formateurdash')->with('success', 'Brief créé avec succès');

        }
        return back()->with('error', 'Erreur lors de la création du brief');
    }

    public function assign_students(Request $request)
    {

            $studentId = $request->student_id;
            $classId   = $request->classes_id;
            if($this->FormateurService->AssignStudents($studentId,$classId))
            {
                return redirect()
                    ->route('formateurdash')
                    ->with('success', 'Assignement créé avec succès');
            }
    }
    public function index()
    {
        $users = User::where('role', 'etudiant')->whereDoesntHave('etudiants', function($q){
        $q->whereNotNull('classe_id');
        })->get();

        $classes = Classe::all();
        $sprints = Sprint::all();
        $competences = Competence::all();
        $briefs = Brief::all();
        $etudiants = Etudiant::with('user')->get();
        $rendus = $this->FormateurService->getAllRendu() ?? [];
        $formateurs = Formateur::with('classes')->where('user_id', Auth::id())->first();
        
        return view('formateurdash',[
            'title' => "Formateur Dashboard",
            'users' => $users,
            'classes' => $classes,
            'sprints' => $sprints,
            'competences' => $competences,
            'briefs' => $briefs,
            'etudiants' => $etudiants,
            'rendus' => $rendus,
            'formateurs' => $formateurs
        ]);
    }
}
