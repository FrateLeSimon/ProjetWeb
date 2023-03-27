<html>
    <head>
        <title>Fiche entreprise</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php
    require_once '../../controllers/EntrepriseController.php';
    require_once '../../controllers/OffreController.php';
    if (!isset($_GET['id'])) {
        header('Location: afficher_entreprise.php');
        exit;
    }
    $id_entreprise = (int)$_GET['id'];
    
    $entrepriseController = new EntrepriseController();
    $offreController = new OffreController();
    $entreprise = $entrepriseController->getEntrepriseById($id_entreprise);
    $offres = $offreController->getOffresByEntrepriseId($id_entreprise);
    if (!$entreprise) {
        header('Location: afficher_entreprise.php');
        exit;
    }

    echo'<div class="titre"><h1>Fiche Entreprise</h1></div>';
    
    echo '<section class="sect"> <div class="container">';
    echo '<div class="text"><h1>' . $entreprise->nom_entreprise . '</h1>';
    echo '<p><b>Secteur d\'activié : </b>  ' . $entreprise->secteur_activite  .'</p>';
    echo '<p><b>Description : </b><br>' . $entreprise->description_entreprise  .'</p>';

    echo '<p><b>Adresse : </b></p>';
    echo '<div class="location">';
    echo '<p id="icon"><i class="fa-solid fa-location-dot"></i><p>    ';
    echo '<p>' . $entreprise->ville  .'</p>';
    echo '<p>' . $entreprise->code_postal  .'</p>';
    echo '</div>';

    echo '<div class="buttons">';
    echo '<button onclick="javascript:history.back()">Retour</button>';
    echo '</div>';
        
    echo '<img src="../../img/entreprise/' . $entreprise->logo . '" alt="image">';
    echo '</div>';
    echo '</div> </div></section>';
    echo '<h2>Offres de ' . $entreprise->nom_entreprise . '</h2>';

foreach ($offres as $offre) {
    echo '<div class="offre">';
    echo '<h3>' . $offre->titre_offre . '</h3>';
    echo '<p><b>Date :</b> ' . $offre->date_offre  .'</p>';
    echo '<p><b>Durée :</b> ' . $offre->duree . ' semaines </p>';
    echo '<p><b>Rémunération :</b> ' . $offre->remuneration . ' €</p>';
    echo '<p><b>Nombre de places :</b> ' . $offre->nbr_places  .'</p>';
    echo '<p><b>Description :</b><br> ' . $offre->desc_offre  .'</p>';
    echo '</div>';
}
    $entrepriseController->closeConnection();
    ?>

    
</body>
</html>