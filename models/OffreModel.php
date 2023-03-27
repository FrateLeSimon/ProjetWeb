<?php
class Offre {
    public $id_offre;
    public $titre_offre;
    public $remuneration;
    public $date_offre;
    public $duree;
    public $desc_offre;
    public $nbr_places;
    public $id_entreprise;
    public $nom_entreprise;
    public $logo;

    public function __construct($id_offre, $titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places, $id_entreprise, $nom_entreprise, $logo) {
        $this->id_offre = $id_offre;
        $this->id_offre = $id_offre;
        $this->titre_offre = $titre_offre;
        $this->remuneration = $remuneration;
        $this->date_offre = $date_offre;
        $this->duree = $duree;
        $this->desc_offre = $desc_offre;
        $this->nbr_places = $nbr_places;
        $this->id_entreprise = $id_entreprise;
        $this->nom_entreprise = $nom_entreprise;
        $this->logo = $logo;
    }
}
?>