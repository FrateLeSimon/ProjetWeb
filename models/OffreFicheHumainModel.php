<?php
class offre {
    public $titre_offre;
    public $nom;
    public $date_offre;
    public $date_duree;
    public $remuneration;
    public $nbr_places;
    public $desc_offre;
    public $id_offre;
    public $logo;

    public function __construct($titre_offre, $nom, $date_offre, $date_duree, $date_remuneration, $nbr_places, $desc_offre, $id_offre, $logo) {
        $this->titre_offre = $titre_offre;
        $this->nom = $nom;
        $this->date_offre = $date_offre;
        $this->date_duree = $date_duree;
        $this->remuneration = $date_remuneration;
        $this->nbr_places = $nbr_places;
        $this->desc_offre = $desc_offre;
        $this->id_offre = $id_offre;
        $this->logo = $logo;
    }
}

?>
