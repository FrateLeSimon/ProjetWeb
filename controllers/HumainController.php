<?php
require_once '../../models/HumainModel.php';

class HumainController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getAllHumains() {
        $sql = "SELECT H.id_humain, H.nom, H.prenom, H.admin, E.id_etudiant, P.id_pilote
                FROM Humain H
                LEFT JOIN Etudiant E ON H.id_humain = E.id_humain
                LEFT JOIN Pilote P ON H.id_humain = P.id_humain";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $humains = [];
        while ($row = $stmt->fetch()) {
            $humain = new Humain(
                $row['id_humain'],
                $row['nom'],
                $row['prenom'],
                $row['admin'],
                $row['id_etudiant'],
                $row['id_pilote']
            );
            $humains[] = $humain;
        }

        return $humains;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>