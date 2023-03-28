<?php
require_once '../../controllers/OffreController.php';
require_once '../navfooter/navbar/navbar.php';

$controller = new OffreController();
$offres = $controller->getOffres(0, 1000); // Récupérer toutes les offres disponibles dans la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les ID des offres sélectionnées
    $id_offre_1 = $_POST['id_offre_1'] ?? null;
    $id_offre_2 = $_POST['id_offre_2'] ?? null;

    // Récupérer les offres correspondantes à partir du contrôleur
    $offre_1 = $controller->getOffreById($id_offre_1);
    $offre_2 = $controller->getOffreById($id_offre_2);
}
?>

<!DOCTYPE html>
<html lang ='fr'>
<head>
    <meta charset="UTF-8">
    <title>Comparer des offres</title>  
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
</head>
<body>
  <div class="titre"><h1>Comparez des offres</h1></div>
  <form method="post">
  <div class="form-group-container">
    <div class="form-group">
      <label for="offre1">Offre 1 :</label>
      <select name="id_offre_1">
        <?php foreach ($offres as $offre): ?>
          <option value="<?php echo $offre->id_offre;?>"><?php echo $offre->titre_offre; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="offre2">Offre 2 :</label>
      <select name="id_offre_2">
        <?php foreach ($offres as $offre): ?>
          <option value="<?php echo $offre->id_offre; ?>"><?php echo $offre->titre_offre; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="submit-button-container">
    <input type="submit" value="Comparer">
  </div>
</form>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les détails des offres sélectionnées
    $offre1 = $controller->getOffreById($_POST['id_offre_1']);
    $offre2 = $controller->getOffreById($_POST['id_offre_2']);
    
    // Afficher les détails des offres
    if ($offre1 && $offre2) {
      echo '<div class="container">';

      echo '<div class="offre">';
      echo'<img src="../../img/entreprise/' . $offre1->logo . '" alt="image">';
      echo '<h1>' . $offre1->titre_offre . '</h1>';
      echo '<p><b>Entreprise :</b> ' . $offre1->nom_entreprise .'</p>';
      echo '<p><b>Date :</b> ' . $offre1->date_offre .'</p>';
      echo '<p><b>Durée :</b> ' . $offre1->duree . ' semaines </p>';
      echo '<p><b>Rémunération :</b> ' . $offre1->remuneration . ' €</p>';
      echo '<p><b>Nombre de places :</b> ' . $offre1->nbr_places .'</p>';
      echo '<p><b>Description :</b><br> ' . $offre1->desc_offre .'</p>';
      echo '<div class="buttons">';
      echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre1->id_offre . '">Voir plus</a>';
      echo '</div>';
      
      echo '</div>';
      
      echo '<div class="offre">';
      echo'<img src="../../img/entreprise/' . $offre2->logo . '" alt="image">';
      echo '<h1>' . $offre2->titre_offre . '</h1>';
      echo '<p><b>Entreprise :</b> ' . $offre2->nom_entreprise .'</p>';
      echo '<p><b>Date :</b> ' . $offre2->date_offre .'</p>';
      echo '<p><b>Durée :</b> ' . $offre2->duree . ' semaines </p>';
      echo '<p><b>Rémunération :</b> ' . $offre2->remuneration . ' €</p>';
      echo '<p><b>Nombre de places :</b> ' . $offre2->nbr_places .'</p>';
      echo '<p><b>Description :</b><br> ' . $offre2->desc_offre .'</p>';
      echo '<div class="buttons">';
      echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre2->id_offre . '">Voir plus</a>';
      echo '</div>';
      
      echo '</div>';
      
      echo '</div>';
    }
}
?>

</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>