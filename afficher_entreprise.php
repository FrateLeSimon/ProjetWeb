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

// Requête SQL pour récupérer les entreprises avec la pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 2;
$start_from = ($page-1) * $records_per_page;
$sql = "SELECT id_entreprise, nom_entreprise, secteur_activite, description FROM Entreprise ORDER BY id_entreprise ASC LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// Stockage des entreprises dans des objets
$entreprises = [];
while ($row = $result->fetch()) {
    $entreprise = new Entreprise($row['id_entreprise'], $row['nom_entreprise'], $row['secteur_activite'], $row['description']);
    $entreprises[] = $entreprise;
}

// Affichage des entreprises
foreach ($entreprises as $entreprise) {
    echo '<div>';
    echo '<h3>' . $entreprise->nom_entreprise . '</h3>';
    echo '<p>' . $entreprise->secteur_activite . '</p>';
    echo '<p>' . $entreprise->description . '</p>';
    echo '<a href="entreprise.php?id=' . $entreprise->id_entreprise . '">Voir plus</a>';
    echo '</div>';
}

// Pagination
$sql = "SELECT COUNT(*) AS total FROM Entreprise";
$result = $conn->query($sql);
$row = $result->fetch();
$total_records = $row['total'];
$total_pages = ceil($total_records / $records_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='afficher_entreprise.php?page=$i'>$i</a> ";
}

// Fermeture de la connexion à la base de données
$conn = null;
?>