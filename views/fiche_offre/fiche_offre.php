<?php require_once '../../controllers/OffreController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?> 
<?php require_once '../../controllers/ApplyController.php'; ?>
<?php require_once '../../controllers/WishListController.php'; ?>

<html>
    <head>
        <title>Fiche offre</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

<?php


if (!isset($_GET['id'])) {
    header('Location: ../afficher_offre/afficher_offre.php');
    exit;
}
$id_offre = (int)$_GET['id'];

$offreController = new OffreController();
$offre = $offreController->getOffreById($id_offre);
$competences = $offreController->getCompetencesByOffreId($id_offre);

if (!$offre) {
    header('Location: afficher_offres.php');
    exit;
}
        echo'<div class="titre"><h1>Fiche Offre</h1></div>';

        echo '<section class="sect"> <div class="container">';
        echo '<div class="text"><h1>' . $offre->titre_offre . '</h1>';
        echo '<p><b>Entreprise :</b> ' . $offre->nom_entreprise  .'</p>';
        echo '<p><b>Date :</b> ' . $offre->date_offre  .'</p>';
        echo '<p><b>Durée :</b> ' . $offre->duree . ' semaines </p>';
        echo '<p><b>Rémunération :</b> ' . $offre->remuneration . ' €</p>';
        echo '<p><b>Nombre de places :</b> ' . $offre->nbr_places  .'</p>';
        echo '<p><b>Description :</b><br> ' . $offre->desc_offre  .'</p>';
        echo '<p><b>Compétences :</b></p>';
        echo '<ul>';
            foreach ($competences as $competence) {
        echo '<li>' . $competence->competence . '</li>';
    }
        echo '</div>';
        echo '<div class="buttons">';
        echo '<button onclick="javascript:history.back()">Retour</button>';
        echo '<a href="../modifier_offre/modifier_offre.php?id=' . $offre->id_offre . '" id="ent">Modifier</a>';
        echo '<a href="../fiche_entreprise/fiche_entreprise.php?id=' . $offre->id_entreprise . '" id="ent">Fiche entreprise</a>';
        echo '</div>';
        echo '<img src="../../img/entreprise/' . $offre->logo . '" alt="image">';
        echo '</div>';
        echo '</div> </section>';

$offreController->closeConnection();
?>

    
</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>