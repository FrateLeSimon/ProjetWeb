<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html lang='fr'>
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
    $evaluations = $entrepriseController->getMoyenneEvaluationsByIdEntreprise($id_entreprise);
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
    echo '<p><b>Moyenne des évaluations :</b></p>';
    echo '<ul class="notes">';
    echo '<li>Fiabilité : ';
    for($i = 0; $i < round($evaluations->moyenne_fiabilite/2); $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    if($evaluations->moyenne_fiabilite%2 > 0){
        echo '<i class="fas fa-star-half"></i>';
    }
    echo '<li>Pertinence : ';
    for($i = 0; $i < round($evaluations->moyenne_pertinence/2); $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    if($evaluations->moyenne_pertinence%2 > 0){
        echo '<i class="fas fa-star-half"></i>';
    }
    echo '<li>Ambiance : ';
    for($i = 0; $i < round($evaluations->moyenne_ambiance/2); $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    if($evaluations->moyenne_ambiance%2 > 0){
        echo '<i class="fas fa-star-half"></i>';
    }
    echo '<li>Salaire : ';
    for($i = 0; $i < round($evaluations->moyenne_salaire/2); $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    if($evaluations->moyenne_salaire%2 > 0){
        echo '<i class="fas fa-star-half"></i>';
    }
    echo '<li><b>Moyenne Générale :</b> ';
    $moy = ($evaluations->moyenne_salaire+ $evaluations->moyenne_ambiance + $evaluations->moyenne_pertinence + $evaluations->moyenne_fiabilite)/4;
    for($i = 0; $i < round($moy/2); $i++) {
        echo '<i class="fas fa-star"></i>';
    }
    if($moy%2 > 0){
        echo '<i class="fas fa-star-half"></i>';
    }

    
    echo '</ul>';
    echo '<div class="buttons">';
    echo '<button onclick="javascript:history.back()">Retour</button>';
    echo '<a href="../modifier_entreprise/modifier_entreprise.php?id=' . $entreprise->id_entreprise . '" id="ent">Modifier</a>';
    echo '</div>';
        
    echo '<img src="../../img/entreprise/' . $entreprise->logo . '" alt="image">';
    echo '</div>';
    echo '</div> </div></section>';

    
    echo'<div class="titre2"><h1>Liste des offres</h1></div>';

foreach ($offres as $offre) {
    echo '<section class="sect2"> <div class="container2">';
        echo '<div class="text2"><h1>' . $offre->titre_offre . '</h1>';
        echo '<p><b>Entreprise :</b> ' . $offre->nom_entreprise  .'</p>';
        echo '<p><b>Date :</b> ' . $offre->date_offre  .'</p>';
        echo '<p><b>Durée :</b> ' . $offre->duree . ' semaines </p>';
        echo '<p><b>Rémunération :</b> ' . $offre->remuneration . ' €</p>';
        echo '<p><b>Nombre de places :</b> ' . $offre->nbr_places  .'</p>';
        echo '<p><b>Description :</b><br> ' . $offre->desc_offre  .'</p>';
        echo '<div class="buttons2">';
        echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre->id_offre . '">Voir plus</a>';
        echo '</div>';
        echo '</div>';
        echo '<img src="../../img/entreprise/' . $offre->logo . '" alt="image">';
        echo '</div>';
        echo '</div> </div></section>';
}
    $entrepriseController->closeConnection();
    ?>

    
</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>