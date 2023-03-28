<?php require_once '../../controllers/HumainController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html lang='fr'>
<head>
    <title>Modifier l'étudiant</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
</head>
<body>

    <?php
    $humainController = new humainController();
    
    $etudiant_id = $_GET['id'];
    $etudiant = $humainController->getHumainById($etudiant_id);
    $promos = $humainController->getAllPromos();
    ?>

    <section class="container">
        <form action="modifier_etudiant.php?id=<?php echo $etudiant_id; ?>" method="post" enctype="multipart/form-data">
            <h1 class="title">Modifier l'étudiant</h1>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $etudiant->nom; ?>">

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value=" <?php echo $etudiant->prenom; ?>">
            <label for="photo_profil">Photo de profil :</label>
        <input type="file" name="photo_profil" accept="image/*">

        <label for="cv">CV :</label>
        <input type="file" name="cv" accept="application/pdf">

        <label for="lettre_lm">Lettre de motivation :</label>
        <input type="file" name="lettre_lm" accept="application/pdf">

        <label for="id_promo">Promotion :</label>
        <select name="id_promo">
            // affichage de toute les promotions dans un menu déroulant
            <?php foreach ($promos as $promo) { ?>
                <option value="<?php echo $promo->id_promo; ?>" <?php if ($promo->id_promo == $etudiant->id_promo) echo "selected"; ?>>
                    <?php echo $promo->nom_promo; ?>
                </option>
            <?php } ?>


           

</select>

        <input type="hidden" name="update" value="1">
        <input type="hidden" name="id_etudiant" value="<?php echo $etudiant->id_etudiant; ?>">

        <input type="submit" value="Modifier l'étudiant">
        <a id="suppr" type="button" id="supprimerEtudiant" onclick="supprimerEtudiant()">Supprimer l'étudiant</a>
        <a id="return" href="../afficher_etudiant/afficher_etudiant.php">Retour</a>
    </form>
    
</section>
<script>
function supprimerEtudiant() {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")) {
        window.location.href = "../afficher_etudiant/afficher_etudiant.php?delete=" + <?php echo $etudiant->id_etudiant; ?>;
    }
}
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $etudiantController->handleRequest($etudiant_id);
}
$humainController->closeConnection();

?>
</body>
</html>
<?php require_once '../navfooter/footer/footer.php'; ?>