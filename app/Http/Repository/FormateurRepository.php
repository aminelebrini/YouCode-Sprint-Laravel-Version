<?php

    namespace App\Http\Repository;
    use App\Models\Etudiant;
    use App\Models\User;
    use App\Models\Formateur;
    use App\Models\Brief;
    use App\Models\Competence;
    use App\Models\Evaluation;
    use App\Models\Sprint;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;


    class FormateurRepository
    {
        public function Create_Brief($Titre,$DateDebut,$DateFin,$SprintId,$type,$CompetenceId,$Description,$Formateur_id)
        {
            $userId = Formateur::where('user_id', Auth::user()->id)->value('user_id');

            $typeString = '';
            foreach ($type as $index => $t) {
                if ($index > 0) $typeString .= ',';
                $typeString .= (string)$t;
            }

            $brief = Brief::create([
                'nom' => $Titre,
                'description' => $Description,
                'type' => (string) $typeString,
                'sprint_id' => $SprintId,
                'date_debut' => $DateDebut,
                'date_fin' => $DateFin,
                'formateur_id' => $userId,
            ]);

            if ($brief){
                foreach ($CompetenceId as $cid) {
                    DB::table('competence_brief')->insert([
                        'brief_id' => $brief->id,
                        'competence_id' => $cid,
                        'created_at' => now(),
                    ]);
                }
            }

            //ajout de brief_type
        }

        public function Assign_Students($studentId,$classId)
        {
            $fullname = User::where('id', $studentId)->first(['firstname', 'lastname']);
            $username = $fullname->firstname . $fullname->lastname;
            $etudiant = Etudiant::create([
               'username' => $username,
                'user_id'  => $studentId,
                'level' => 0,
                'classe_id' => $classId,
            ]);
        }

        public function CorrectionRendu($renduId,$briefId,$etudiantId,$commentaire,$competenceId,$levels)
        {
            $typeString = '';
            foreach ($competenceId as $index => $c) {
                if ($index > 0) $typeString .= ',';
                $typeString .= (string)$c;
            }
            // dd($typeString);
            Evaluation::create([
                'commentaire' => $commentaire,
                'niveau_maitrise' => $levels,
                'etudiant_id' => $etudiantId,
                'formateur_id'=> Auth::user()->id,
                'brief_id' => $briefId,
                'competence_id' => $typeString
            ]);
        }
        public function getUsers()
        {
            etudiant::all();
        }

        public function getClasses()
        {

        }

        public function getSprint()
        {
            Sprint::all();
        }
        public function getCompetence()
        {
            Competence::all();
        }

        public function getAllBriefs()
        {
            Brief::all();
        }
        public function getEtudiant()
        {

        }
        public function getAll_Rendu()
        {

        }
    }
?>
