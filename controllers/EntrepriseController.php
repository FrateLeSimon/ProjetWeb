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
            $sql = "SELECT entreprise.id_entreprise, nom_entreprise, secteur_activite, description, ville, code_postal, logo FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse WHERE nom_entreprise LIKE :search_query ORDER BY entreprise.id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT entreprise.id_entreprise, nom_entreprise, secteur_activite, description, ville, code_postal, logo FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse ORDER BY entreprise.id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
    
        $entreprises = [];
        while ($row = $stmt->fetch()) {
            $entreprise = new Entreprise($row['id_entreprise'], $row['nom_entreprise'], $row['secteur_activite'], $row['description'], $row['ville'], $row['code_postal'], $row['logo']);
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
        public function closeConnection() {
            $this->conn = null;
        }
    }

