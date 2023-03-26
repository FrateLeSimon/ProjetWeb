<?php require_once '../../controllers/EntrepriseController.php'; ?>


<html>
    <head>
        <title>StaJ</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php
    echo "<form action='afficher_entreprise.php' method='get'>
        <input type='text' name='search' placeholder='Rechercher une entreprise...'>
        <input type='submit' value='Rechercher'>
    </form>";
    ?>

<!--
<form action="" method="post" enctype="multipart/form-data">
    <label for="nom_entreprise">Nom de l'entreprise :</label>
    <input type="text" name="nom_entreprise" required>

    <label for="secteur_activite">Secteur d'activité :</label>
    <input type="text" name="secteur_activite" required>

    <label for="logo">Logo :</label>
    <input type="file" name="logo" accept="image/*" required>

    <label for="description">Description :</label>
    <textarea name="description" required></textarea>

    <label for="num_rue">Numéro de rue :</label>
    <input type="text" name="num_rue" required>

    <label for="nom_rue">Nom de rue :</label>
    <input type="text" name="nom_rue" required>

    <label for="ville">Ville :</label>
    <input type="text" name="ville" required>

    <label for="code_postal">Code postal :</label>
    <input type="text" name="code_postal" required>

    <label for="pays">Pays :</label>
    <input type="text" name="pays" required>

    <input type="submit" value="Ajouter l'entreprise">
</form> -->

    <?php
    $entrepriseController = new EntrepriseController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $entrepriseController->handleRequest();
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 6;
    $start_from = ($page-1) * $records_per_page;

    if (isset($_GET['search'])) {
        $search_query = $_GET['search'];
        $entreprises = $entrepriseController->getEntreprises($start_from, $records_per_page, $search_query);
    } else {
        $entreprises = $entrepriseController->getEntreprises($start_from, $records_per_page);
    }

    foreach ($entreprises as $entreprise) {
        echo '<div class="box">';
        echo '<h3>' . $entreprise->nom_entreprise . '</h3>';
        echo '<p>' . $entreprise->secteur_activite . '</p>';
        echo '<p>' . $entreprise->description  .'</p>';
        echo '<p>' . $entreprise->ville  .'</p>';
        echo '<p>' . $entreprise->code_postal  .'</p>';
        echo '<img src="../../img/entreprise/' . $entreprise->logo . '" alt="image">';
        echo '<a href="../fiche_entreprise/fiche_entreprise.php?id=' . $entreprise->id_entreprise . '">Voir plus</a>';
   
        echo '<a href="../modifier_entreprise/modifier_entreprise.php?id=' . $entreprise->id_entreprise . '">Modifier</a>';
        echo '</div>';
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
</html>