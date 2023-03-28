<?php
//Pour savoir si c'est un pilote
class EntrepriseController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getOffre($id_etudiant) {
        $sql = "";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_etudiant' => $id_etudiant]);
    
        $offres = [];
        while ($row = $stmt->fetch()) {
            $offre = new offre($row['titre_offre']);
            $offres[] = $offre;
        }
        return $offres;
    }
}