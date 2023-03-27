<?php
require_once 'veriflogin.php';
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

    public function ajouterALaWishlist($id_offre, $id_etudiant) {
        $sql = "INSERT INTO wishlist (id_offre, id_etudiant) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $id_offre, $id_etudiant);
        $stmt->execute();
        $stmt->close();
    }

    public function getOffres($start_from, $records_per_page, $search_query = '') {
        $offres = array();
    
        if ($search_query) {
            $sql = "SELECT offre.*, entreprise.nom_entreprise, entreprise.logo FROM offre INNER JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise WHERE offre.titre_offre LIKE ? ORDER BY offre.date_offre DESC LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, "%{$search_query}%", PDO::PARAM_STR);
            $stmt->bindParam(2, $start_from, PDO::PARAM_INT);
            $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
        } else {
            $sql = "SELECT offre.*, entreprise.nom_entreprise, entreprise.logo FROM offre INNER JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise ORDER BY offre.date_offre DESC LIMIT ?, ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $start_from, PDO::PARAM_INT);
            $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        }
    
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $offre = new Offre($row['id_offre'], $row['titre_offre'], $row['remuneration'], $row['date_offre'], $row['duree'], $row['desc_offre'], $row['nbr_places'], $row['id_entreprise'], $row['nom_entreprise'], $row['logo']);
            $offre->nom_entreprise = $row['nom_entreprise'];
            $offre->logo = $row['logo'];
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
        $sql = "SELECT o.*, e.nom_entreprise, e.logo FROM Offre AS o INNER JOIN Entreprise AS e ON o.id_entreprise = e.id_entreprise WHERE o.id_offre = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_offre, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
    
        if ($row) {
            $offre = new Offre($row['id_offre'], $row['titre_offre'], $row['remuneration'], $row['date_offre'], $row['duree'], $row['desc_offre'],  $row['nbr_places'], $row['id_entreprise'], $row['nom_entreprise'], $row['logo']);
            return $offre;
        }
    
        return null;
    }
    public function updateOffre($id_offre, $titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places) {
        $sql = "UPDATE offre SET titre_offre = :titre_offre, remuneration = :remuneration, date_offre = :date_offre, duree = :duree, desc_offre = :desc_offre, nbr_places = :nbr_places WHERE id_offre = :id_offre";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt->bindParam(':titre_offre', $titre_offre, PDO::PARAM_STR);
        $stmt->bindParam(':remuneration', $remuneration, PDO::PARAM_INT);
        $stmt->bindParam(':date_offre', $date_offre, PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':desc_offre', $desc_offre, PDO::PARAM_STR);
        $stmt->bindParam(':nbr_places', $nbr_places, PDO::PARAM_INT);
        $stmt->execute();
        return header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
    }

    public function createOffre($titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places, $id_entreprise) {
        $sql = "INSERT INTO offre (titre_offre, remuneration, date_offre, duree, desc_offre, nbr_places, id_entreprise) VALUES (:titre_offre, :remuneration, :date_offre, :duree, :desc_offre, :nbr_places, :id_entreprise)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titre_offre', $titre_offre, PDO::PARAM_STR);
        $stmt->bindParam(':remuneration', $remuneration, PDO::PARAM_INT);
        $stmt->bindParam(':date_offre', $date_offre, PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':desc_offre', $desc_offre, PDO::PARAM_STR);
        $stmt->bindParam(':nbr_places', $nbr_places, PDO::PARAM_INT);
        $stmt->bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
        $stmt->execute();
        return header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
    }
    public function deleteOffre($id_offre) {
        // Supprimez les enregistrements liés dans la table a_besoin_de
        $sql_delete_abesoinde = "DELETE FROM a_besoin_de WHERE id_offre = :id_offre";
        $stmt_delete_abesoinde = $this->conn->prepare($sql_delete_abesoinde);
        $stmt_delete_abesoinde->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt_delete_abesoinde->execute();
    
        // Supprimez les enregistrements liés dans la table concerne
        $sql_delete_concerne = "DELETE FROM concerne WHERE id_offre = :id_offre";
        $stmt_delete_concerne = $this->conn->prepare($sql_delete_concerne);
        $stmt_delete_concerne->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt_delete_concerne->execute();
    
        // Supprimez les enregistrements liés dans la table wishlist
        $sql_delete_wishlist = "DELETE FROM wishlist WHERE id_offre = :id_offre";
        $stmt_delete_wishlist = $this->conn->prepare($sql_delete_wishlist);
        $stmt_delete_wishlist->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt_delete_wishlist->execute();
    
        // Supprimez l'offre de la table offre
        $sql_delete_offre = "DELETE FROM offre WHERE id_offre = :id_offre";
        $stmt_delete_offre = $this->conn->prepare($sql_delete_offre);
        $stmt_delete_offre->bindParam(':id_offre', $id_offre, PDO::PARAM_INT);
        $stmt_delete_offre->execute();
    }
    public function getOffresByEntrepriseId($id_entreprise)
{
    $stmt = $this->conn->prepare("SELECT offre.*, entreprise.nom_entreprise, entreprise.logo
    FROM offre
    JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise
    WHERE offre.id_entreprise = :id_entreprise");
$stmt->bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
$stmt->execute();
    $offresData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $offres = [];
    foreach ($offresData as $offreData) {
        $offre = new Offre(
            $offreData['id_offre'],
            $offreData['titre_offre'],
            $offreData['desc_offre'],
            $offreData['date_offre'],
            $offreData['duree'],
            $offreData['remuneration'],
            $offreData['nbr_places'],
            $offreData['id_entreprise'],
            $offreData['nom_entreprise'],
            $offreData['logo']

        );
        array_push($offres, $offre);
    }

    return $offres;
}


    public function closeConnection() {
        $this->conn = null;
    }
}
?>