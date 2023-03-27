<?php
class AuthenticationModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT Authentification.*, Humain.admin, Humain.id_humain FROM Authentification INNER JOIN Humain ON Authentification.id_humain = Humain.id_humain WHERE Authentification.login = ? AND Authentification.mdp = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function generateUserToken($user_id) {
        // Générer un jeton de sécurité unique
        $user_token = bin2hex(random_bytes(16));
        
        // Stocker le jeton de sécurité dans la base de données
        $stmt = $this->conn->prepare("UPDATE Authentification SET token = ? WHERE id_humain = ?");
        $stmt->bind_param("si", $user_token, $user_id);
        $stmt->execute();
        
        return $user_token;
    }


}
?>