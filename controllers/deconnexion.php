<?php
    // Supprimer les cookies
    unset($_COOKIE['user_id']);
    unset($_COOKIE['user_token']);
    
    // Expire les cookies
    setcookie('user_id', null, -1, '/');
    setcookie('user_token', null, -1, '/');
    
    // Rediriger l'utilisateur vers la page de connexion
    header("Location: http://localhost:3000/projetWeb/views/vitrine/page_vitrine.php");
    exit;

?>