<?php
class Entreprise {
    public $id_entreprise;
    public $nom_entreprise;
    public $secteur_activite;
    public $description;
    public $ville;
    public $code_postal;
    public $logo;

    public function __construct($id_entreprise, $nom_entreprise, $secteur_activite, $description, $ville, $code_postal, $logo) {
        $this->id_entreprise = $id_entreprise;
        $this->nom_entreprise = $nom_entreprise;
        $this->secteur_activite = $secteur_activite;
        $this->description = $description;
        $this->ville = $ville;
        $this->code_postal = $code_postal;
        $this->logo = $logo;
    }
}
?>