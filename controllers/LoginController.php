<?php
require_once '../../models/Entreprise.php';

class EntrepriseController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getEntreprises($start_from, $records_per_page, $search_query = null) {
        if ($search_query) {
            $sql = "SELECT id_entreprise, nom_entreprise, secteur_activite, description FROM Entreprise WHERE nom_entreprise LIKE :search_query ORDER BY id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT entreprise.id_entreprise, nom_entreprise, secteur_activite, ville, code_postal, description FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse ORDER BY entreprise.id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
    
        $entreprises = [];
        while ($row = $stmt->fetch()) {
            $entreprise = new Entreprise($row['id_entreprise'], $row['nom_entreprise'], $row['secteur_activite'], $row['description'], $row['ville'], $row['code_postal']);
            $entreprises[] = $entreprise;
        }
    
        return $entreprises;
    }

    public function getTotalRecords() {
        $sql = "SELECT COUNT(*) AS total FROM Entreprise";
        $result = $this->conn->query($sql);
        $row = $result->fetch();
        return $row['total'];
    }

    public function getEntrepriseById($id_entreprise) {
        $sql = "SELECT nom_entreprise, secteur_activite, description, ville, code_postal FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse WHERE entreprise.id_entreprise = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row) {
            $entreprise = new Entreprise($id_entreprise, $row['nom_entreprise'], $row['secteur_activite'], $row['description'], $row['ville'], $row['code_postal']);
            return $entreprise;
        }

        return null;
    }

    public function searchEntreprises($search_query) {
        $this->getEntreprisesJson(0, PHP_INT_MAX, $search_query);
    }

    public function getEntreprisesJson($start_from, $records_per_page, $search_query = null) {
        $entreprises = $this->getEntreprises($start_from, $records_per_page, $search_query);
        header('Content-Type: application/json');
        echo json_encode($entreprises);
        }
        public function closeConnection() {
            $this->conn = null;
        }
    }


