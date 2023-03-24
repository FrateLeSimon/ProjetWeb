<?php 
// UserModel.php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function isEmailExists($email)
    {
        $sql = "SELECT * FROM Authentification WHERE login = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
}
?>