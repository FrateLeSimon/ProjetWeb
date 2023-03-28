<?php

class PiloteController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getPiloteId($user_id) {
        $sql = "SELECT id_pilote FROM humain LEFT JOIN pilote ON humain.id_humain = pilote.id_humain WHERE humain.id_humain = :user_id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        
    
        while ($row = $stmt->fetch()) {
            $id_pilote = $row['id_pilote'];
        }
        
        $sql = "SELECT admin FROM `humain` Where id_humain = :user_id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        while ($row = $stmt->fetch()) {
            $admin = $row['admin'];
        }
        return $id_pilote > 0 || $admin == 0x01;
    }
}