<?php
require_once '../../models/login.php';
require_once '../../views/login/login.php';

// Remplacez les valeurs ci-dessous par celles de votre base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdd_staj";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialiser les variables pour les messages d'erreur
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Créer une instance du modèle d'authentification
        $auth_model = new AuthenticationModel($conn);
        $user = $auth_model->getUserByEmailAndPassword($email, $password);

        if ($user) {
            // Générer un jeton de sécurité pour l'utilisateur et le stocker dans la base de données
            $user_token = $auth_model->generateUserToken($user["id_humain"]);

            // Stocker l'identifiant de l'utilisateur et le jeton de sécurité dans des cookies
            setcookie('user_id', $user["id_humain"], time() + (86400 * 30), "/"); // valide pendant 30 jours
            setcookie('user_token', $user_token, time() + (86400 * 30), "/"); // valide pendant 30 jours

            // Rediriger l'utilisateur vers la page d'accueil
            header("Location: http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php");
            exit;

        } else {
            $error_message = "E-mail ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir les champs E-mail et Mot de passe.";
    }

}
?>
