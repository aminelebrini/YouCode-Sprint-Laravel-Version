<?php

namespace App\Http\Controllers;
use App\Models\Brief;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EtudiantController extends Controller
{
    public function index()
    {
        $etudiant = Etudiant::with('classe.formateurs')
                        ->where('user_id', Auth::id())
                        ->first();
        $briefs = Brief::all();
        $formateurIds = $etudiant->classe->formateurs->pluck('id');
        $briefs = Brief::whereIn('formateur_id', $formateurIds)->get();
        return view('etudiantdash',
            [
                'title' => "Formateur Dashboard",
                'briefs' => $briefs,
                'etudiants' => $etudiant
            ]);
    }
}
