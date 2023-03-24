<?php require_once '../../controllers/EntrepriseController.php'; ?>

<?php //include '../navfooter/navbar/navbar.php'; ?>

<html>
    <head>
        <title>StaJ Login</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php
    $entrepriseController = new EntrepriseController();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 6;
    $start_from = ($page-1) * $records_per_page;

    $entreprises = $entrepriseController->getEntreprises($start_from, $records_per_page);

    foreach ($entreprises as $entreprise) {
        echo '<div class="box">';
        echo '<h3>' . $entreprise->nom_entreprise . '</h3>';
        echo '<p>' . $entreprise->secteur_activite . '</p>';
        echo '<p>' . $entreprise->description  .'</p>';
        echo '<p>' . $entreprise->ville  .'</p>';
        echo '<p>' . $entreprise->code_postal  .'</p>';
        echo '<img src="../../img/entreprise/' . $entreprise->logo . '"alt="image">';
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