<?php require_once '../../controllers/OffreController.php'; ?>

<html>
    <head>
        <title>StaJ Offres</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php
        echo "<form action='afficher_offre.php' method='get'>
        <input type='text' name='search' placeholder='Rechercher une offre...'>
        <input type='submit' value='Rechercher'>
    </form>";
    
    $offreController = new OffreController();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 2;
    $start_from = ($page-1) * $records_per_page;

    $offres = $offreController->getOffres($start_from, $records_per_page);



    foreach ($offres as $offre) {
        echo '<div class="box">';
        echo '<h3>Offre ID: ' . $offre->id_offre . '</h3>';
        echo '<p>Durée: ' . $offre->duree . '</p>';
        echo '<p>Rémunération: ' . $offre->remuneration . '</p>';
        echo '<p>Date: ' . $offre->date_offre  .'</p>';
        echo '<p>Nombre de places: ' . $offre->nbr_places  .'</p>';
        echo '<p>ID Entreprise: ' . $offre->id_entreprise  .'</p>';
        echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre->id_offre . '">Voir plus</a>';
        echo '</div>';
    }

    $total_records = $offreController->getTotalRecords();
    $total_pages = ceil($total_records / $records_per_page);
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='afficher_offre.php?page=$i'>$i</a> ";
    }

    $offreController->closeConnection();
    ?>
</body>
</html>