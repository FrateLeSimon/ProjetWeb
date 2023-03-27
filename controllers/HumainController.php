<?php
require_once 'veriflogin.php';
require '../../models/HumainModel.php';

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
        $sql = "SELECT humain.id_humain, nom, prenom, admin, id_etudiant, id_pilote FROM Humain
        LEFT JOIN Etudiant ON humain.id_humain = etudiant.id_humain
        LEFT JOIN pilote ON humain.id_humain = pilote.id_humain
        Where humain.admin = 0x00";

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
                $row['id_pilote'],
            );
            $humains[] = $humain;
        }

        return $humains;
    }


    public function searchHumains($search) {
        $sql = "SELECT humain.id_humain, nom, prenom, admin, id_etudiant, id_pilote FROM Humain
        LEFT JOIN Etudiant ON humain.id_humain = etudiant.id_humain
        LEFT JOIN pilote ON humain.id_humain = pilote.id_humain
        Where humain.admin = 0x00 AND (humain.nom LIKE :search OR humain.prenom LIKE :search);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => '%' . $search . '%']);
    
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
    public function getHumainById($id_humain) {
        $sql = "SELECT H.id_humain, H.nom, H.prenom, H.admin, E.id_etudiant, P.id_pilote
                FROM Humain H
                LEFT JOIN Etudiant E ON H.id_humain = E.id_humain
                LEFT JOIN Pilote P ON H.id_humain = P.id_humain
                WHERE H.id_humain = :id_humain";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_humain' => $id_humain]);
    
        $row = $stmt->fetch();
        if ($row) {
            $humain = new Humain(
                $row['id_humain'],
                $row['nom'],
                $row['prenom'],
                $row['admin'],
                $row['id_etudiant'],
                $row['id_pilote']
            );
            return $humain;
        }
        return null;
    }


    public function closeConnection() {
        $this->conn = null;
    }
}
?>