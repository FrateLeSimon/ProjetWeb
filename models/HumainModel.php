<?php
class Humain {
    public $id_humain;
    public $nom;
    public $prenom;
    public $photo_profil;
    public $admin;
    public $id_etudiant;
    public $id_pilote;


    public function __construct($id_humain, $nom, $prenom, $admin, $id_etudiant, $id_pilote, $photo_profil) {
        $this->id_humain = $id_humain;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->photo_profil = $photo_profil;
        $this->admin = $admin;
        $this->id_etudiant = $id_etudiant;
        $this->id_pilote = $id_pilote;
    }
}


