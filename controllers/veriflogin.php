<?php
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
    // Vérifier si l'identifiant d'utilisateur et le jeton de sécurité sont valides
    // Si oui, l'utilisateur est connecté et vous pouvez laisser l'accès à la page
} else {
    // Rediriger l'utilisateur vers la page de connexion
    header("Location: http://localhost:3000/projetWeb/views/vitrine/page_vitrine.php");
    exit;
}
?>