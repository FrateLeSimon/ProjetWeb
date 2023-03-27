<?php
class Humain {
    public $id_humain;
    public $nom;
    public $prenom;
    public $admin;
    public $id_etudiant;
    public $id_pilote;


    public function __construct($id_humain, $nom, $prenom, $admin, $id_etudiant, $id_pilote) {
        $this->id_humain = $id_humain;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->admin = $admin;
        $this->id_etudiant = $id_etudiant;
        $this->id_pilote = $id_pilote;
    }
}


