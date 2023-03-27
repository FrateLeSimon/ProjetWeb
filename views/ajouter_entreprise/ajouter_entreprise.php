<?php require_once '../../controllers/EntrepriseController.php'; ?>

<html>
    <head>
        <title>Ajouter une entreprise</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>

    <?php
    $entrepriseController = new EntrepriseController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $entrepriseController->handleRequest();
    }
    ?>

    <body>
    <section class="container">
        <form action="" method="post" enctype="multipart/form-data">
        <h1 class="title">Ajouter une entreprise</h1>
            <label for="nom_entreprise">Nom de l'entreprise :</label>
            <input type="text" name="nom_entreprise" required>

            <label for="secteur_activite">Secteur d'activité :</label>
            <input type="text" name="secteur_activite" required>

            <label for="logo">Logo :</label>
            <input type="file" name="logo" accept="image/*" required>

            <label for="description_entreprise">Description :</label>
            <textarea name="description_entreprise" required></textarea>

            <label for="num_rue">Numéro de rue :</label>
            <input type="text" name="num_rue" required>

            <label for="nom_rue">Nom de rue :</label>
            <input type="text" name="nom_rue" required>

            <label for="pays">Pays :</label>
            <input type="text" name="pays" required>

            <label for="code_postal">Code postal :</label>
            <input type="text" name="code_postal" required>

            <label for="ville">Ville :</label>
            <diV id="ville">
                <input type="text" name="ville" required>
            </diV>

            <input type="submit" value="Ajouter l'entreprise">
            <a id="return" href="../afficher_entreprise/afficher_entreprise.php">Retour</a>
        </form>
            
        </section>

        <?php
            $entrepriseController->closeConnection();
        ?>

    <script src="../../assets/vendors/jquery/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    </body>
</html>