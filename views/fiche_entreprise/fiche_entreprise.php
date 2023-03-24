<?php
require_once '../../controllers/EntrepriseController.php';

if (!isset($_GET['id'])) {
    header('Location: afficher_entreprise.php');
    exit;
}
$id_entreprise = (int)$_GET['id'];

$entrepriseController = new EntrepriseController();
$entreprise = $entrepriseController->getEntrepriseById($id_entreprise);

if (!$entreprise) {
    header('Location: afficher_entreprise.php');
    exit;
}

echo '<div class="container">';
echo '<h2>' . $entreprise->nom_entreprise . '</h2>';
echo '<p>' . $entreprise->secteur_activite . '</p>';
echo '<p>' . $entreprise->description . '</p>';
echo '<p>' . $entreprise->ville . '</p>';
echo '<p>' . $entreprise->code_postal . '</p>';
echo '<a href="../afficher_entreprise/afficher_entreprise.php" class="btn-back">Retour</a>';
echo '</div>';

$entrepriseController->closeConnection();
?>