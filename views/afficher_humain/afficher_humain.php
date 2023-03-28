<?php require_once '../../controllers/HumainController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?>

<html>
<head>
    <title>StaJ Utilisateurs</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
</head>
<body>
<?php
echo "<form method='GET' >
        <input type='text' name='search' placeholder='Rechercher par nom'>
        <input type='submit' value='Rechercher'>
      </form>";

$humainController = new HumainController();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $humains = $humainController->searchHumains($search);
} else {
    $humains = $humainController->getAllHumains();
}

$total_records = count($humains);
$records_per_page = 4;
$total_pages = ceil($total_records / $records_per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;
$humains = array_slice($humains, $start_from, $records_per_page);

echo '<div class="add">
    <a href="../ajouter_humain/ajouter_humain.php" class="add-button">Ajouter un étudiant</a>
    </div>';

echo '<div class="titre"><h1>Tous les utilisateurs</h1></div>';

foreach ($humains as $humain) {
    echo '<section class="sect"> <div class="container">';
    echo '<div class="text"><h1>' . $humain->prenom . ' ' . $humain->nom . '</h1>';
    echo '<img src="../../img/humain/' . $humain->photo_profil . '" alt="image">';
    if ($humain->id_etudiant) {
        echo '<p><b>Étudiant</b></p>';
    } elseif ($humain->id_pilote) {
        echo '<p><b>Pilote</b></p>';
    } else {
        echo '<p>Admin</p>';
    }
    echo '<div class="buttons">';
    echo '<a href="../fiche_humain/fiche_humain.php?id=' . $humain->id_humain . '" class="btn-voir-plus">Voir plus</a>';
    echo '</div>';
    echo '</div>';
    echo '</div> </div></section>';
}

echo '<div class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    $class = ($i == $page) ? "current-page" : "";
    echo "<a class='$class' href='afficher_humain.php?page=$i'>$i</a> ";
}
echo '</div>';

$humainController->closeConnection();
?>
</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>