<?php 
require_once 'db_connect.php';
require_once 'UserModel.php';

$userModel = new UserModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    if ($userModel->isEmailExists($email)) {
        $email_error = "Cette adresse e-mail est déjà utilisée.";
    } else {
        
    }
}
