<?php require_once '../../controllers/OffreController.php'; ?>
<?php require_once '../../controllers/EntrepriseController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html lang='fr'>
<head>
    <title>Créer une offre</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
</head>
<body>

    <?php
    $offreController = new OffreController();
    $entrepriseController = new EntrepriseController();
    $entreprises = $entrepriseController->getEntreprises();
    ?>

    <section class="container">
        <form action="ajouter_offre.php" method="post">
            <h1 class="title">Créer une offre</h1>

            <label for="id_entreprise">Entreprise :</label>
            <select name="id_entreprise">
                <?php foreach ($entreprises as $entreprise): ?>
                    <option value="<?php echo $entreprise->id_entreprise; ?>"><?php echo $entreprise->nom_entreprise; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="titre_offre">Titre de l'offre :</label>
            <input type="text" name="titre_offre"required>

            <label for="remuneration">Rémunération :</label>
            <input type="number" name="remuneration"  required>

            <label for="date_offre">Date de l'offre :</label>
            <input type="date" name="date_offre" required>

            <label for="duree">Durée :</label>
            <input type="number" name="duree" required>

            <label for="desc_offre">Description de l'offre :</label>
            <textarea name="desc_offre" required></textarea>

            <label for="nbr_places">Nombre de places :</label>
            <input type="number" name="nbr_places" required>
            <label for="create"></label>
            <input type="hidden" name="create" value="1">
            <input type="submit" value="Créer l'offre">
            <a id="return" href="../afficher_offre/afficher_offre.php">Retour</a>
        </form>
    </section>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
        $titre_offre = $_POST['titre_offre'];
        $remuneration = $_POST['remuneration'];
        $date_offre = $_POST['date_offre'];
        $duree = $_POST['duree'];
        $desc_offre = $_POST['desc_offre'];
        $nbr_places = $_POST['nbr_places'];
        $id_entreprise = $_POST['id_entreprise'];
    
        $offre_created = $offreController->createOffre($titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places, $id_entreprise);
    
    }

    $offreController->closeConnection();
    $entrepriseController->closeConnection();
    ?>

</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>