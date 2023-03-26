<?php
class AuthenticationModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByEmailAndPassword($email, $password) {
        $stmt = $this->conn->prepare("SELECT Authentification.*, Humain.admin FROM Authentification INNER JOIN Humain ON Authentification.id_humain = Humain.id_humain WHERE Authentification.login = ? AND Authentification.mdp = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>