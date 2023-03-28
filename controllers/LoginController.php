<?php
require_once '../../models/login.php';
require_once '../../views/login/login.php';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdd_staj";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

       
        $auth_model = new AuthenticationModel($conn);
        $user = $auth_model->getUserByEmailAndPassword($email, $password);

        if ($user) {
            
            $user_token = $auth_model->generateUserToken($user["id_humain"]);

            
            setcookie('user_id', $user["id_humain"], time() + (86400 * 30), "/"); 
            setcookie('user_token', $user_token, time() + (86400 * 30), "/"); 

            
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
