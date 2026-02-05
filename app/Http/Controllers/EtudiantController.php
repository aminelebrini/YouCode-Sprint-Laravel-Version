<?php

namespace App\Http\Controllers;
use App\Models\Brief;
use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\EtudiantService;



class EtudiantController extends Controller
{
    private $EtudiantService;
    
    public function __construct(EtudiantService $EtudiantService)
    {
        $this->EtudiantService = $EtudiantService;
    }
    public function soummetreRendu(Request $request)
    {
        
        $titre = $request->Titrerendu;
        $brief_id = $request->brief_id;
        $lien = $request->lien_rendu;
        $commentaire = $request->commentaire;
        // dd($titre);
            if($this->EtudiantService->SoumettreRendu($titre,$brief_id,$lien,$commentaire))
            {
                return redirect()->route('etudiantdash')->with('success', 'Rendu soumis !');
                
            }
    }
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
