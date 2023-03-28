<?php
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_token'])) {
   
} else {
    
    header("Location: http://localhost:3000/projetWeb/views/vitrine/page_vitrine.php");
    exit;
}
?>