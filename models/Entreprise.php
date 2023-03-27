<?php
class Entreprise {
    public $id_entreprise;
    public $nom_entreprise;
    public $secteur_activite;
    public $description_entreprise;
    public $ville;
    public $code_postal;
    public $logo;
    public $num_rue;
    public $nom_rue;
    public $pays;

    public function __construct($id_entreprise, $nom_entreprise, $secteur_activite, $description_entreprise, $ville, $code_postal, $logo, $num_rue = null, $nom_rue = null, $pays = null) {
        $this->id_entreprise = $id_entreprise;
        $this->nom_entreprise = $nom_entreprise;
        $this->secteur_activite = $secteur_activite;
        $this->description_entreprise = $description_entreprise;
        $this->ville = $ville;
        $this->code_postal = $code_postal;
        $this->logo = $logo;
        $this->num_rue = $num_rue;
        $this->nom_rue = $nom_rue;
        $this->pays = $pays;   
    }
}
?>