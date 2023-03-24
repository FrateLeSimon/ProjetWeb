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

    public function getOffres($start_from, $records_per_page, $search_query = null) {
        if ($search_query) {
            $sql = "SELECT id_offre, duree, remuneration, date_offre, nbr_places, id_entreprise FROM Offre WHERE id_offre LIKE :search_query ORDER BY id_offre ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT id_offre, duree, remuneration, date_offre, nbr_places, id_entreprise FROM Offre ORDER BY id_offre ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
    
        $offres = [];
        while ($row = $stmt->fetch()) {
            $offre = new Offre($row['id_offre'], $row['duree'], $row['remuneration'], $row['date_offre'], $row['nbr_places'], $row['id_entreprise']);
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
        $sql = "SELECT * FROM Offre WHERE id_offre = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_offre, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
    
        if ($row) {
            $offre = new Offre($row['id_offre'], $row['duree'], $row['remuneration'], $row['date_offre'], $row['nbr_places'], $row['id_entreprise']);
            return $offre;
        }
    
        return null;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>