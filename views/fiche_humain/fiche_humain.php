<?php
require_once '../../controllers/HumainController.php';

if (!isset($_GET['id'])) {
    header('Location: afficher_humain.php');
    exit;
}
$id_humain = (int)$_GET['id'];

$humainController = new HumainController();
$humain = $humainController->getHumainById($id_humain);

if (!$humain) {
    header('Location: afficher_humain.php');
    exit;
}

echo '<div class="container">';
echo '<h2>' . $humain->prenom . ' ' . $humain->nom . '</h2>';

if ($humain->id_etudiant) {
    echo '<p>Type: Étudiant</p>';
    echo '<p>ID Étudiant: ' . $humain->id_etudiant . '</p>';
} elseif ($humain->id_pilote) {
    echo '<p>Type: Pilote</p>';
    echo '<p>ID Pilote: ' . $humain->id_pilote . '</p>';
} else {
    echo '<p>Type: Admin</p>';
}

echo '<a href="../afficher_humain/afficher_humain.php" class="btn-back">Retour</a>';
echo '</div>';

$humainController->closeConnection();
?>