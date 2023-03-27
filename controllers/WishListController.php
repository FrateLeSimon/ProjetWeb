<?php require_once '../../models/WishlistModel.php'; ?>

<?php
class Database {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
    class WishListController {

    public function addWish() {
        // Récupérer les identifiants
        $id_etudiant = 0; // Assurez-vous que l'ID de l'étudiant est stocké dans la session
        $id_offre = $_POST['id_offre'];

        // Ajouter l'offre à la wishlist
        $wishlistModel = new WishlistModel();
        $wishlistModel->addWish($id_etudiant, $id_offre);

        // Rediriger vers la page précédente ou la page de la wishlist
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function __construct() {
        if (isset($_GET['action']) && $_GET['action'] === 'addWish') {
            $this->addWish();
        }
    }

}