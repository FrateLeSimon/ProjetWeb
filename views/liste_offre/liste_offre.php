<link rel="stylesheet" href="style.css">
<body>
<?php
require_once '../../controllers/EntrepriseController.php';

$entrepriseController = new EntrepriseController();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 2;
$start_from = ($page-1) * $records_per_page;

$entreprises = $entrepriseController->getEntreprises($start_from, $records_per_page);

echo '<h3> Voici les entreprises </h3>';

foreach ($entreprises as $entreprise) {
    echo '<div>';
    echo '<h3>' . $entreprise->nom_entreprise . '</h3>';
    echo '<p>' . $entreprise->secteur_activite . '</p>';
    echo '<p>' . $entreprise->description  .'</p>';
    echo '<a href="../fiche_entreprise/fiche_entreprise.php?id=' . $entreprise->id_entreprise . '">Voir plus</a>';
    echo '</div>';
}

$total_records = $entrepriseController->getTotalRecords();
$total_pages = ceil($total_records / $records_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='afficher_entreprise.php?page=$i'>$i</a> ";
}


$entrepriseController->closeConnection();
?>
</body>