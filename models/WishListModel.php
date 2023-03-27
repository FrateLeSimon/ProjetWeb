<?php
























// require_once __DIR__ . '/../controllers/WishListController.php';

// class WishlistModel {
//     private $db;

//     public function __construct() {
//         $database = new Database();
//         $this->db = $database->getConnection();
//     }

//     public function addWish($id_etudiant, $id_offre) {
//         // Préparer la requête SQL
//         $sql = "INSERT INTO Wishlist (id_etudiant, id_offre) VALUES (?, ?)";

//         // Exécuter la requête avec les valeurs
//         $stmt = $this->db->prepare($sql);
//         $stmt->execute([$id_etudiant, $id_offre]);
//     }
// }