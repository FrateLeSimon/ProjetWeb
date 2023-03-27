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
            // Les informations de l'utilisateur sont correctes, vous pouvez les rediriger vers une autre page (par exemple, la page d'accueil)
            session_start();
            $_SESSION['user'] = $user;

            if (ord($user["admin"]) === 1) {
                // Si l'utilisateur est un administrateur, redirigez-le vers la page admin
                header("Location: ../admin_page/admin_page.php");
            } else {
                // Sinon, redirigez l'utilisateur vers la page d'accueil normale
                header("Location: ../afficher_entreprise/afficher_entreprise.php");
            }
            exit;
        } else {
            $error_message = "E-mail ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir les champs E-mail et Mot de passe.";
    }

}
?>