<?php require_once '../../controllers/EntrepriseController.php'; ?>
<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html lang ='fr'>
    <head>
        <title>StaJ Entreprises</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php
        $PiloteController = new PiloteController;
        if($PiloteController->getPiloteId($_COOKIE['user_id'])){    
    echo "<form action='afficher_entreprise.php' method='get'>
        <input type='text' name='search' placeholder='Rechercher une entreprise...'>
        <input type='submit' value='Rechercher'>
    </form>";
        }

    require_once '../../controllers/GetPilote.php'; 
    $EntrepriseController = new PiloteController;
    if ($EntrepriseController->getPiloteId($_COOKIE['user_id'])) {
        echo'<div class ="add">';
        echo'<a href="../ajouter_entreprise/ajouter_entreprise.php" class="add-button">Ajouter une entreprise</a>';
        echo'</div>';
    }
    
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
    if (isset($_GET['delete'])) {
        $entrepriseController->deleteEntreprise((int)$_GET['delete']);
        header('Location: afficher_entreprise.php');
        exit;
    }
    
    echo'<div class="titre"><h1>Toutes les entreprises</h1></div>';

    foreach ($entreprises as $entreprise) {
            echo '<section class="sect"> <div class="container">';
            echo '<div class="text"><h1>' . $entreprise->nom_entreprise . '</h1>';
            echo '<p>' . $entreprise->description_entreprise  .'</p>';

            echo '<div class="location">';
            echo '<p id="icon"><i class="fa-solid fa-location-dot"></i><p>    ';
            echo '<p>' . $entreprise->ville  .'</p>';
            echo '<p>' . $entreprise->code_postal  .'</p>';
            echo '</div>';

            echo '<div class="buttons">';
            echo '<a href="../fiche_entreprise/fiche_entreprise.php?id=' . $entreprise->id_entreprise . '">Voir plus</a>';
    
            echo '</div>';
        
            echo '<img src="../../img/entreprise/' . $entreprise->logo . '" alt="image">';
            echo '</div>';
            echo '</div> </div></section>';
    }

    $total_records = isset($search_query) ? $entrepriseController->getTotalRecords($search_query) : $entrepriseController->getTotalRecords();
    $total_pages = ceil($total_records / $records_per_page);


    echo'<div class="pagination">';

    for ($i = 1; $i <= $total_pages; $i++) {
        $class = ($i == $page) ? "current-page" : "";
        echo "<a class='$class' href='afficher_entreprise.php?page=$i'>$i</a> ";
    }
  
    echo'</div>';

    $entrepriseController->closeConnection();
    ?>
</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>