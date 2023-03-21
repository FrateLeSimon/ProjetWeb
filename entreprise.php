
<?php
class Entreprise {
    public $id_entreprise;
    public $nom_entreprise;
    public $secteur_activite;
    public $description;

    public function __construct($id_entreprise, $nom_entreprise, $secteur_activite, $description) {
        $this->id_entreprise = $id_entreprise;
        $this->nom_entreprise = $nom_entreprise;
        $this->secteur_activite = $secteur_activite;
        $this->description = $description;
    }
}

$db_host = 'localhost';
$db_name = 'bdd_staj';
$db_user = 'root';
$db_pass = '';
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

// Récupération de l'ID de l'entreprise depuis l'URL
if (!isset($_GET['id'])) {
    header('Location: afficher_entreprise.php');
    exit;
}
$id_entreprise = (int)$_GET['id'];

// Requête SQL pour récupérer les détails de l'entreprise
$sql = "SELECT nom_entreprise, secteur_activite, description FROM Entreprise WHERE id_entreprise = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id_entreprise, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

// Vérification de l'existence de l'entreprise
if (!$row) {
    header('Location: afficher_entreprise.php');
    exit;
}

// Création d'un objet Entreprise
$entreprise = new Entreprise($id_entreprise, $row['nom_entreprise'], $row['secteur_activite'], $row['description']);

// Affichage des détails de l'entreprise
echo '<div class="container">';
echo '<h2>' . $entreprise->nom_entreprise . '</h2>';
echo '<p>' . $entreprise->secteur_activite . '</p>';
echo '<p>' . $entreprise->description . '</p>';
echo '<a href="afficher_entreprise.php" class="btn-back">Retour</a>';
echo '</div>';

// Fermeture de la connexion à la base de données
$conn = null;
?>