<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Formateur;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\AdminService;

class AdminController extends Controller
{
    private AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function create(Request $request)
    {

        $this->adminService->createUser(
            $request->nom,
            $request->prenom,
            $request->role,
            $request->email,
            $request->password
        );

        return redirect()
            ->route('admindash')
            ->with('success', 'Compte créé avec succès');
    }

    public function addSprint(Request $request)
    {
        $request->validate([
            'titre'      => 'required|string',
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
        ]);

        $this->adminService->createSprint(
            $request->titre,
            $request->date_debut,
            $request->date_fin
        );

        return redirect()->route('admindash')->with('success', 'Sprint ajouté');
    }

    public function addClass(Request $request)
    {
        $request->validate([
            'class_name'     => 'required|string',
            'capacity'       => 'required|integer',
            'annee_scolaire' => 'required|string',

        ]);

        $this->adminService->createClasse(
            $request->class_name,
            $request->capacity,
            $request->annee_scolaire
        );

        return redirect()->route('admindash')->with('success', 'Classe ajoutée');
    }

    public function assignation(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'teacher_id'=> 'required|exists:users,id',
        ]);

        $this->adminService->assignerFormateur(
            $request->class_id,
            $request->teacher_id
        );

        return redirect()->route('admindash')->with('success', 'Formateur assigné');
    }

    public function addCompetence(Request $request)
    {
        $request->validate([
            'competence_name' => 'required|string',
        ]);

        $this->adminService->addSkill($request->competence_name);

        return redirect()->route('admindash')->with('success', 'Compétence ajoutée');
    }

    public function index()
    {

        return view('admindash', [
            'formateurs' => Formateur::all(),
            'sprints'     => $this->adminService->getSprints(),
            'users'       => $this->adminService->getUsers(),
            'classes'     => Classe::with('formateurs')->get(),
            'competences' => $this->adminService->getCompetences(),
        ]);
    }
}
