<?php
class Offre {
    public $id_offre;
    public $duree;
    public $remuneration;
    public $date_offre;
    public $nbr_places;
    public $id_entreprise;

    public function __construct($id_offre, $duree, $remuneration, $date_offre, $nbr_places, $id_entreprise) {
        $this->id_offre = $id_offre;
        $this->duree = $duree;
        $this->remuneration = $remuneration;
        $this->date_offre = $date_offre;
        $this->nbr_places = $nbr_places;
        $this->id_entreprise = $id_entreprise;
    }
}
?>