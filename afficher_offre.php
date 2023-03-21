<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdd_staj";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialisation de l'id_offre
$id_offre = 1;

// Requête SQL pour récupérer les informations de l'offre
$sql = "SELECT * FROM Offre WHERE id_offre = $id_offre";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Affichage des informations de l'offre
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id_offre"]. "<br>";
        echo "Durée: " . $row["duree"]. "<br>";
        echo "Rémunération: " . $row["remuneration"]. "<br>";
        echo "Date de l'offre: " . $row["date_offre"]. "<br>";
        echo "Nombre de places: " . $row["nbr_places"]. "<br>";
    }
} else {
    echo "Aucun résultat trouvé pour l'id_offre $id_offre";
}

// Fermeture de la connexion
$conn->close();
?>