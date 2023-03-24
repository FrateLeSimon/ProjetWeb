<?php
class AuthenticationModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function getUserByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM Authentification WHERE login = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        // Vérifie si le mot de passe correspond sans utiliser le hachage
        if ($user && $user["mdp"] === $password) {
            return $user;
        } else {
            return null;
        }
    }
}
?>