<?php
require_once '../../controllers/OffreController.php';

if (!isset($_GET['id'])) {
    header('Location: afficher_offres.php');
    exit;
}
$id_offre = (int)$_GET['id'];

$offreController = new OffreController();
$offre = $offreController->getOffreById($id_offre);

if (!$offre) {
    header('Location: afficher_offres.php');
    exit;
}

echo '<div class="container">';
echo '<h2>Offre ID: ' . $offre->id_offre . '</h2>';
echo '<p>Durée: ' . $offre->duree . '</p>';
echo '<p>Rémunération: ' . $offre->remuneration . '</p>';
echo '<p>Date: ' . $offre->date_offre . '</p>';
echo '<p>Nombre de places: ' . $offre->nbr_places . '</p>';
echo '<p>ID Entreprise: ' . $offre->id_entreprise . '</p>';
echo '<a href="../afficher_offre/afficher_offre.php" class="btn-back">Retour</a>';
echo '</div>';

$offreController->closeConnection();
?>