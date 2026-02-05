<?php

    namespace App\Http\Repository;
    use App\Models\Rendu;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

    class EtudiantRepository
    {
        
        public function Soumettre_Rendu($titre,$brief_id,$lien,$commentaire)
        {
            $rendu = Rendu::create([
                'text' => $titre,
                'description' => $commentaire,
                'link' => $lien,
                'date_soumission' => now()

            ]);
            if($rendu)
            {
               return DB::table('rendu_etudiant')->insert([
                    'etudiant_id' => Auth::user()->etudiant->id,
                    'rendu_id' => $rendu->id,
                    'brief_id' => $brief_id
                ]);
            }
        }
    }


?>