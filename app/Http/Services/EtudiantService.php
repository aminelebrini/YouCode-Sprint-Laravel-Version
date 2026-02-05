<?php

    namespace App\Http\Services;

    use App\Http\Repository\EtudiantRepository;

    class EtudiantService
    {
        private $EtudiantRepository;

        public function __construct(EtudiantRepository $EtudiantRepository)
        {
            $this->EtudiantRepository = $EtudiantRepository;
        }
        public function SoumettreRendu($titre,$brief_id,$lien,$commentaire)
        {
            return $this->EtudiantRepository->Soumettre_Rendu($titre,$brief_id,$lien,$commentaire);
        }
    }

?>