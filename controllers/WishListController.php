<?php
require_once 'veriflogin.php';
require_once '../../models/WishListModel.php';

class WishListController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getEtudiantId($humain_id) {
        $sql = "SELECT id_etudiant FROM etudiant WHERE id_humain = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $humain_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id_etudiant'] : null;
    }

    public function isInWishlist($id_offre, $id_etudiant) {
        $etudiant_id = $this->getEtudiantId($_COOKIE['user_id']);

        $sql = "SELECT COUNT(*) FROM wishlist WHERE id_offre = ? AND id_etudiant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id_offre, PDO::PARAM_INT);
        $stmt->bindParam(2, $etudiant_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

public function ajouterALaWishlist($id_offre) {
    $etudiant_id = $this->getEtudiantId($_COOKIE['user_id']);

    $sql = "INSERT INTO wishlist (id_offre, id_etudiant) VALUES (?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $id_offre, PDO::PARAM_INT);
    $stmt->bindParam(2, $etudiant_id, PDO::PARAM_INT);
    $stmt->execute();
}

public function supprimerDeLaWishlist($id_offre) {
    $etudiant_id = $this->getEtudiantId($_COOKIE['user_id']);

    $sql = "DELETE FROM wishlist WHERE id_offre = ? AND id_etudiant = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $id_offre, PDO::PARAM_INT);
    $stmt->bindParam(2, $etudiant_id, PDO::PARAM_INT);
    $stmt->execute();
}

}
?>