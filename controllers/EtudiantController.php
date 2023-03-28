<?php
require_once 'veriflogin.php';
require '../../models/EtudiantModel.php';
require '../../models/OffreFicheHumainModel.php';

class EtudiantController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;
    public $id_etudiant;

    public function __construct($id_etudiant) {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
        $this->id_etudiant = $id_etudiant;
    }

    public function getOffre($id_etudiant) {
        $sql = "SELECT offre.titre_offre, entreprise.nom_entreprise, offre.date_offre, offre.duree, offre.remuneration, offre.nbr_places, offre.desc_offre, offre.id_offre, entreprise.logo FROM a_postule LEFT JOIN offre ON a_postule.id_offre = offre.id_offre LEFT JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise WHERE id_etudiant = :id_etudiant; LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);
    
        $offres = [];
        while ($row = $stmt->fetch()) {
            $offre = new offre($row['titre_offre'], $row['nom_entreprise'], $row['date_offre'], $row['duree'], $row['remuneration'], $row['nbr_places'], $row['desc_offre'], $row['id_offre'], $row['logo']);
            $offres[] = $offre;
        }
        return $offres;
    }

    public function getPromo($id_etudiant) {
        $sql = "SELECT type_promo, annee FROM etudiant LEFT JOIN promo ON etudiant.id_promo = promo.id_promo WHERE id_etudiant = :id_etudiant;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);
    
        while ($row = $stmt->fetch()) {
            $type_promo = $row['type_promo'];
            $annee = $row['annee'];
        }
        return [$type_promo, $annee];
    }

    public function getVille($id_etudiant) {
        $sql = "SELECT ville FROM etudiant LEFT JOIN promo ON etudiant.id_promo = promo.id_promo LEFT JOIN centre ON promo.id_centre = centre.id_centre LEFT JOIN adresse ON centre.id_adresse = adresse.id_adresse WHERE id_etudiant = :id_etudiant;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);
    
        while ($row = $stmt->fetch()) {
            $ville = $row['ville'];
        }
        return $ville;
    }

}

?>