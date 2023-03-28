<?php require_once '../navfooter/navbar/navbar.php'; ?> 

<html>
<head>
    <title>Fiche utilisateur</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
</head>
<body>

<?php
require_once '../../controllers/HumainController.php';
require_once '../../controllers/EtudiantController.php';

if (!isset($_GET['id'])) {
    header('Location: afficher_humain.php');
    exit;
}
$id_humain = (int)$_GET['id'];

$humainController = new HumainController();
$humain = $humainController->getHumainById($id_humain);



if (!$humain) {
    header('Location: afficher_humain.php');
    exit;
}

            echo'<div class="titre"><h1>Fiche Utilisateur</h1></div>';

            echo '<section class="sect"> <div class="container">';
            echo '<div class="text"><h1>' . $humain->prenom . ' ' . $humain->nom . '</h1>';
            echo '<img src="../../img/humain/' . $humain->photo_profil . '" alt="image">';
            if ($humain->id_etudiant) {
                echo '<p><b>Rôle : Étudiant</b></p>';
                $etudiant = new EtudiantController($humain->id_etudiant);
                $offres = $etudiant->getOffre($humain->id_etudiant);
                
                $a = new EtudiantController($humain->id_etudiant);
                $promo = $a->getPromo($humain->id_etudiant);

                $b = new EtudiantController($humain->id_etudiant);
                $ville = $b->getVille($humain->id_etudiant);
            
                echo '<p><b>Promotion : ' . $promo[1] ." ". $promo[0] . ' </b></p>';
                echo '<p><b>Centre : ' . $ville . ' </b></p>';

            
            } elseif ($humain->id_pilote) {
                echo '<p><b>Rôle : Pilote</b></p>';
            } else {
                echo '<p>Rôle : Admin</p>';
            }
            echo '<div class="buttons">';
            echo '<button onclick="javascript:history.back()">Retour</button>';
            echo '<a href="../modifier_humain/modifier_humain.php?id=' . $humain->id_humain . '" id="ent">Modifier</a>';
            $id_user = $_COOKIE['user_id'];
            if($id_user == $humain->id_humain){
                echo'<form method="post" action="../../controllers/deconnexion.php">';
                echo'<button id="deco" type="submit" name="deconnexion">Déconnexion</button>';
                echo'</form> ';
                
            }
            echo '</div>';
            echo '</div>';
            echo '</div> </div></section>';
            if(isset($offres)){
            echo'<div class="titre2"><h1>Liste des offres postulées</h1></div>';
        
            foreach ($offres as $offre) {
                echo '<section class="sect2"> <div class="container2">';
                echo '<div class="text2"><h1>' . $offre->titre_offre . '</h1>';
                echo '<p><b>Entreprise :</b> ' . $offre->nom  .'</p>';
                echo '<p><b>Date :</b> ' . $offre->date_offre  .'</p>';
                echo '<p><b>Durée :</b> ' . $offre->date_duree . ' semaines </p>';
                echo '<p><b>Rémunération :</b> ' . $offre->remuneration . ' €</p>';
                echo '<p><b>Nombre de places :</b> ' . $offre->nbr_places  .'</p>';
                echo '<p><b>Description :</b><br> ' . $offre->desc_offre  .'</p>';
                echo '<div class="buttons2">';
                echo '<a href="../fiche_offre/fiche_offre.php?id=' . $offre->id_offre . '">Voir plus</a>';
                echo '</div>';
                echo '</div>';
                echo '<img src="../../img/entreprise/' . $offre->logo . '" alt="image">';
                echo '</div>';
                echo '</div> </div></section>';
            }
        }




$humainController->closeConnection();

?>

</body>
</html>

<?php require_once '../navfooter/footer/footer.php'; ?>