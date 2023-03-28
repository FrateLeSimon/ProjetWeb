<?php require_once '../../controllers/OffreController.php'; ?>
<?php require_once '../../controllers/WishListController.php'; ?>
<?php require_once '../../controllers/ApplyController.php'; ?>
<?php require_once '../../controllers/GetPilote.php'; ?>

<html>
    <head>
        <title>StaJ Offres</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>

    <?php

    
    $offreController = new OffreController();
    if (isset($_GET['delete'])) {
        $offreController->deleteOffre($_GET['delete']);
        header("Location: ../afficher_offre/afficher_offre.php");
        exit;
    }

    $WishlistController = new WishListController();
    if (isset($_GET['add_to_wishlist'])) {
        $WishlistController->ajouterALaWishlist($_GET['add_to_wishlist']);
        header("Location: afficher_offre.php");
        exit;
    }

    $WishlistController = new WishListController();
    if (isset($_GET['del_from_wishlist'])) {
        $WishlistController->supprimerDeLaWishlist($_GET['del_from_wishlist']);
        header("Location: afficher_offre.php");
        exit;
    }

    $ApplyController = new ApplyController();
    if (isset($_GET['add_to_postuler'])) {
        $ApplyController->ajouterpostuler($_GET['add_to_postuler']);
        header("Location: afficher_offre.php");
        exit;
    }

    
    require_once '../navfooter/navbar/navbar.php';   
    echo "<form action='afficher_offre.php' method='get'>
        <input type='text' name='search' placeholder='Rechercher une offre...'>
        <input type='submit' value='Rechercher'>
        </form>";
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Déterminez le nombre de résultats à récupérer par page
    $records_per_page = 3;

    // Calculez l'index de début pour la récupération des résultats
    $start_from = ($page-1) * $records_per_page;

    // Récupérez les offres à afficher
    if (isset($_GET['search'])) {
        $search_query = $_GET['search'];
        $offres = $offreController->getOffres($start_from, $records_per_page, $search_query);
    } else {
        $offres = $offreController->getOffres($start_from, $records_per_page);
    }

    $wishlistController = new WishListController();
    $etudiant_id = $wishlistController->getEtudiantId($_COOKIE['user_id']);
    
    $PiloteController = new PiloteController;
    if($PiloteController->getPiloteId($_COOKIE['user_id'])){    
    echo'<div class ="add">';
    echo'<a href="../ajouter_offre/ajouter_offre.php" class="add-button">Ajouter une offre</a>';
    echo'</div>';
    }
    // Parcourez les offres et affichez-les dans des éléments HTML

    echo'<div class="titre"><h1>Toutes les offres</h1></div>';

    foreach ($offres as $offre) {
        echo '<section class="sect"> <div class="container">';
        echo '<div class="text"><h1>' . $offre->titre_offre . '</h1>';
        echo '<p><b>Entreprise :</b> ' . $offre->nom_entreprise  .'</p>';
        echo '<p><b>Date :</b> ' . $offre->date_offre  .'</p>';
        echo '<p><b>Durée :</b> ' . $offre->duree . ' semaines </p>';
        echo '<p><b>Rémunération :</b> ' . $offre->remuneration . ' €</p>';
        echo '<p><b>Nombre de places :</b> ' . $offre->nbr_places  .'</p>';
        echo '<p><b>Description :</b><br> ' . $offre->desc_offre  .'</p>';
        echo '<div class="buttons">';
        echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre->id_offre . '">Voir plus</a>';
        
        // BOUTON WISHLIST
        if ($wishlistController->isInWishlist($offre->id_offre, $etudiant_id)) {
            echo '<a class="coeur" id="c_vide" href="afficher_offre.php?del_from_wishlist=' . $offre->id_offre . '"><i class="fas fa-heart"></i></a>'; //SIMON AJOUTER LE COEUR ICI
        } else {
            echo '<a class="coeur" id="c_plein" href="afficher_offre.php?add_to_wishlist=' . $offre->id_offre . '"><i class="far fa-heart"></i></a>'; //SIMON AJOUTER LE COEUR ICI
        }

        // BOUTON POSTULER
        if ($ApplyController->isInPostuler($offre->id_offre, $etudiant_id)) {
            echo ''; 
        } else {
            echo "<a id='postuler' href='afficher_offre.php?add_to_postuler=" . $offre->id_offre . "'>Postuler</a>";
        }

        echo '</div>';
        echo '</div>';
            echo '<img src="../../img/entreprise/' . $offre->logo . '" alt="image">';
        echo '</div>';
        echo '</div> </div></section>';
    }

    // Affichez les liens de pagination
    $total_records = isset($search_query) ? $offreController->getTotalRecords($search_query) : $offreController->getTotalRecords();

    $total_pages = ceil($total_records / $records_per_page);

    echo'<div class="pagination">';

    for ($i = 1; $i <= $total_pages; $i++) {
        $class = ($i == $page) ? "current-page" : "";
        echo "<a class='$class' href='afficher_offre.php?page=$i'>$i</a> ";
    }
  
    echo'</div>';

    // Fermez la connexion
    $offreController->closeConnection();
    ?>
</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>