<?php
class PostulerModel {
    public $id_offre;
    public $id_etudiant;

    public function __construct($id_offre, $id_etudiant) {
        $this->id_offre = $id_offre;
        $this->id_etudiant = 0;
    }
}
?>