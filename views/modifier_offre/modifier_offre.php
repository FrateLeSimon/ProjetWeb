<?php require_once '../../controllers/OffreController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html lang= 'fr'>
<head>
    <title>Modifier l'offre</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    <link rel="manifest" href="/manifest.json">
</head>
<body>

    <?php
    $offreController = new OffreController();
    $offre_id = $_GET['id'];
    $offre = $offreController->getOffreById($offre_id);
    ?>

    <section class="container">
        <form action="modifier_offre.php?id=<?php echo $offre_id; ?>" method="post">
            <h1 class="title">Modifier l'offre</h1>
            <label for="titre_offre">Titre de l'offre :</label>
            <input type="text" name="titre_offre" value="<?php echo $offre->titre_offre; ?>">

            <label for="remuneration">Rémunération :</label>
            <input type="text" name="remuneration" value="<?php echo $offre->remuneration; ?>">

            <label for="date_offre">Date de l'offre :</label>
            <input type="date" name="date_offre" value="<?php echo $offre->date_offre; ?>">

            <label for="duree">Durée :</label>
            <input type="number" name="duree" value="<?php echo $offre->duree; ?>">

            <label for="desc_offre">Description de l'offre :</label>
            <textarea name="desc_offre"><?php echo $offre->desc_offre; ?></textarea>

            <label for="nbr_places">Nombre de places :</label>
            <input type="number" name="nbr_places" value="<?php echo $offre->nbr_places; ?>">

            <input type="hidden" name="update" value="1">
            <input type="hidden" name="id_offre" value="<?php echo $offre->id_offre; ?>">
            <input type="hidden" name="delete" value="<?php echo $offre->id_offre; ?>">
            
            <input type="submit" value="Modifier l'offre">
            <a id="suppr" type="button" id="supprimerOffre" onclick="supprimerOffre()">Supprimer l'offre</a>
            <a id="return" href="../afficher_offre/afficher_offre.php">Retour</a>
            
            </form>
            
    </section>

    <script>
        function supprimerOffre() {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette offre ?")) {
                window.location.href = "../afficher_offre/afficher_offre.php?delete=" + <?php echo $offre->id_offre; ?>;
            }
        }
    </script>


</form>
    </section>
    <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id_offre = $_POST['id_offre'];
    $titre_offre = $_POST['titre_offre'];
    $remuneration = $_POST['remuneration'];
    $date_offre = $_POST['date_offre'];
    $duree = $_POST['duree'];
    $desc_offre = $_POST['desc_offre'];
    $nbr_places = $_POST['nbr_places'];

    $offreController->updateOffre($id_offre, $titre_offre, $remuneration, $date_offre, $duree, $desc_offre, $nbr_places);
    header("Location: ../afficher_offre/afficher_offre.php");
    exit;
}

    $offreController->closeConnection();
    ?>

</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>