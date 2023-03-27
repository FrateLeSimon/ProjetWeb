<?php require_once '../../controllers/HumainController.php'; ?>

<html>
    <head>
        <title>Humains</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>
        <?php

        echo "<form method='GET' >
        <input type='text' name='search' placeholder='Rechercher par nom'>
        <button type='submit'>Rechercher</button>
    </form>";
        $humainController = new HumainController();

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $humains = $humainController->searchHumains($search);
    } else {
    $humains = $humainController->getAllHumains();
    }

        foreach ($humains as $humain) {
            echo '<div class="box">';
            echo '<h3>' . $humain->prenom . ' ' . $humain->nom . '</h3>';
            if ($humain->id_etudiant) {
                echo '<p><b>Étudiant</b></p>';
                echo '<p>ID Étudiant: ' . $humain->id_etudiant . '</p>';
            } elseif ($humain->id_pilote) {
                echo '<p><b>Pilote</b></p>';
                echo '<p>ID Pilote: ' . $humain->id_pilote . '</p>';
            } else {
                echo '<p>Type: Admin</p>';
            }
            echo '<a href="../fiche_humain/fiche_humain.php?id=' . $humain->id_humain . '" class="btn-voir-plus">Voir plus</a>';
            echo '</div>';
        }

        $humainController->closeConnection();
        ?>
    </body>
</html>