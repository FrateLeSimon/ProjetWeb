<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=bdd_staj', 'root', '');


// Récupération des id_offre
$req = $bdd->query('SELECT * FROM offre');

// Affichage des id_offre avec un lien vers la page afficher_offre.php pour chaque id_offre
while ($donnees = $req->fetch()) {
    echo '<p>Offre n°' . $donnees['id_offre'] . ' <a href="afficher_offre.php?id_offre=' . $donnees['id_offre'] . '">Afficher cette offre</a></p>';
    echo "Durée: " . $donnees['id_offre']. "<br>";
    echo "Rémunération: " . $donnees["remuneration"]. "<br>";
    echo "Nombre de places: " . $donnees["nbr_places"]. "<br>";
}

// Fermeture de la requête
$req->closeCursor();
?>