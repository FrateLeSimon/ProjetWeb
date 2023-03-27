<?php
require_once '../../models/OffreModel.php';

class OffreController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getOffres($start_from, $records_per_page, $search_query = '') {
        $offres = array();
    
        if ($search_query) {
            $sql = "SELECT offre.*, entreprise.nom_entreprise, entreprise.logo FROM offre INNER JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise WHERE offre.titre_offre LIKE ? ORDER BY offre.date_offre DESC LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, "%{$search_query}%", PDO::PARAM_STR);
            $stmt->bindParam(2, $start_from, PDO::PARAM_INT);
            $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
        } else {
            $sql = "SELECT offre.*, entreprise.nom_entreprise, entreprise.logo FROM offre INNER JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise ORDER BY offre.date_offre DESC LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $start_from, PDO::PARAM_INT);
            $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        }
    
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $offre = new Offre($row['id_offre'], $row['titre_offre'], $row['remuneration'], $row['date_offre'], $row['duree'], $row['desc_offre'], $row['nbr_places'], $row['id_entreprise'], $row['nom_entreprise'], $row['logo']);
            $offre->nom_entreprise = $row['nom_entreprise'];
            $offre->logo = $row['logo'];
            $offres[] = $offre;
        }
    
        return $offres;
    }

    public function getTotalRecords() {
        $sql = "SELECT COUNT(*) AS total FROM Offre";
        $result = $this->conn->query($sql);
        $row = $result->fetch();
        return $row['total'];
    }

    public function getOffreById($id_offre) {
        $sql = "SELECT o.*, e.nom_entreprise, e.logo FROM Offre AS o INNER JOIN Entreprise AS e ON o.id_entreprise = e.id_entreprise WHERE o.id_offre = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_offre, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
    
        if ($row) {
            $offre = new Offre($row['id_offre'], $row['titre_offre'], $row['remuneration'], $row['date_offre'], $row['duree'], $row['desc_offre'],  $row['nbr_places'], $row['id_entreprise'], $row['nom_entreprise'], $row['logo']);
            return $offre;
        }
    
        return null;
    }
    public function updateOffre($id_offre, $titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places) {
        $sql = "UPDATE offre SET titre_offre = :titre_offre, remuneration = :remuneration, date_offre = :date_offre, duree = :duree, desc_offre = :desc_offre, nbr_places = :nbr_places WHERE id_offre = :id_offre";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindParam(':titre_offre', $titre_offre, PDO::PARAM_STR);
        $stmt->bindParam(':remuneration', $remuneration, PDO::PARAM_INT);
        $stmt->bindParam(':date_offre', $date_offre, PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':desc_offre', $desc_offre, PDO::PARAM_STR);
        $stmt->bindParam(':nbr_places', $nbr_places, PDO::PARAM_INT);
        $stmt->execute();
        return header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
    }

    public function createOffre($titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places, $id_entreprise) {
        $sql = "INSERT INTO offre (titre_offre, remuneration, date_offre, duree, desc_offre, nbr_places, id_entreprise) VALUES (:titre_offre, :remuneration, :date_offre, :duree, :desc_offre, :nbr_places, :id_entreprise)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titre_offre', $titre_offre, PDO::PARAM_STR);
        $stmt->bindParam(':remuneration', $remuneration, PDO::PARAM_INT);
        $stmt->bindParam(':date_offre', $date_offre, PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':desc_offre', $desc_offre, PDO::PARAM_STR);
        $stmt->bindParam(':nbr_places', $nbr_places, PDO::PARAM_INT);
        $stmt->bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
        $stmt->execute();
        return header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
    }
    public function deleteOffre($id_offre) {
        $sql = "DELETE FROM offre WHERE id_offre = :id_offre";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->execute();
        return header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
    }
    public function closeConnection() {
        $this->conn = null;
    }
}
?>