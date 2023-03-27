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

    <?php
    $entrepriseController = new EntrepriseController();
    $entreprise_id = $_GET['id'];
    $entreprise = $entrepriseController->getEntrepriseById($entreprise_id);
    ?>

    <section class="container">
        <form action="modifier_entreprise.php?id=<?php echo $entreprise_id; ?>" method="post" enctype="multipart/form-data">
            <h1 class="title">Modifier l'entreprise</h1>
            <label for="nom_entreprise">Nom de l'entreprise :</label>
            <input type="text" name="nom_entreprise" value="<?php echo $entreprise->nom_entreprise; ?>">

            <label for="secteur_activite">Secteur d'activité :</label>
            <input type="text" name="secteur_activite" value="<?php echo $entreprise->secteur_activite; ?>">

            <label for="logo">Logo :</label>
            <input type="file" name="logo" accept="image/*">

            <label for="description_entreprise">Description :</label>
            <textarea name="description_entreprise"><?php echo $entreprise->description_entreprise; ?></textarea>

            <label for="num_rue">Numéro de rue :</label>
            <input type="text" name="num_rue" value="<?php echo $entreprise->num_rue; ?>">

            <label for="nom_rue">Nom de rue :</label>
            <input type="text" name="nom_rue" value="<?php echo $entreprise->nom_rue; ?>">

            <label for="pays">Pays :</label>
            <input type="text" name="pays" value="<?php echo $entreprise->pays; ?>">

            <label for="code_postal">Code postal :</label>
            <input type="text" name="code_postal" value="<?php echo $entreprise->code_postal; ?>">  

            <label for="ville">Ville :</label>
            <input type="text" name="ville" value="<?php echo $entreprise->ville; ?>">

            <input type="hidden" name="update" value="1">
            <input type="hidden" name="id_entreprise" value="<?php echo $entreprise->id_entreprise; ?>">

            <input type="submit" value="Modifier l'entreprise">
            <a id="suppr" type="button" id="supprimerEntreprise" onclick="supprimerEntreprise()">Supprimer l'entreprise</a>
            <a id="return" href="../afficher_entreprise/afficher_entreprise.php">Retour</a>
        </form>
        
    </section>
    <script>
    function supprimerEntreprise() {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette entreprise ?")) {
            window.location.href = "../afficher_entreprise/afficher_entreprise.php?delete=" + <?php echo $entreprise->id_entreprise; ?>;
        }
    }
</script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $entrepriseController->handleRequest($entreprise_id);
    }
    $entrepriseController->closeConnection();
    ?>

</body>
</html>
