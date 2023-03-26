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

    echo '<section class="sect"> <div class="container">';
    echo '<div class="text"><h1>' . $entreprise->nom_entreprise . '</h1>';
    echo '<p><b>Secteur d\'activié : </b>  ' . $entreprise->secteur_activite  .'</p>';
    echo '<p><b>Description : </b><br>' . $entreprise->description  .'</p>';

    echo '<p><b>Adresse : </b></p>';
    echo '<div class="location">';
    echo '<p id="icon"><i class="fa-solid fa-location-dot"></i><p>    ';
    echo '<p>' . $entreprise->ville  .'</p>';
    echo '<p>' . $entreprise->code_postal  .'</p>';
    echo '</div>';

    echo '<div class="buttons">';
    echo '<a href="../afficher_entreprise/afficher_entreprise.php">Retour</a>';
    echo '</div>';
        
    echo '<img src="../../img/entreprise/' . $entreprise->logo . '" alt="image">';
    echo '</div>';
    echo '</div> </div></section>';

    $entrepriseController->closeConnection();
    ?>

    
</body>
</html>