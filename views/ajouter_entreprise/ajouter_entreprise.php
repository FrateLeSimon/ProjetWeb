<?php require_once '../../controllers/EntrepriseController.php'; ?>

<html>
    <head>
        <title>Modifier l'entreprise</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>
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
        </form>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $entrepriseController->handleRequest($entreprise_id);
            }
            $entrepriseController->closeConnection();
        ?>

    </body>
</html>