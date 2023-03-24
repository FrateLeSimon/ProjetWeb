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
        $humainController = new HumainController();
        $humains = $humainController->getAllHumains();

        foreach ($humains as $humain) {
            echo '<div class="box">';
            echo '<h3>' . $humain->prenom . ' ' . $humain->nom . '</h3>';
            if ($humain->id_etudiant) {
                echo '<p>Type: Étudiant</p>';
                echo '<p>ID Étudiant: ' . $humain->id_etudiant . '</p>';
            } elseif ($humain->id_pilote) {
                echo '<p>Type: Pilote</p>';
                echo '<p>ID Pilote: ' . $humain->id_pilote . '</p>';
            } else {
                echo '<p>Type: Admin</p>';
            }

            echo '</div>';
        }

        $humainController->closeConnection();
        ?>
    </body>
</html>