<?php
require_once 'veriflogin.php';
require '../../models/HumainModel.php';

class HumainController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }


    public function getAllHumains() {
        $sql = "SELECT humain.id_humain, nom, prenom, photo_profil, admin, id_etudiant, id_pilote FROM Humain LEFT JOIN Etudiant ON humain.id_humain = etudiant.id_humain LEFT JOIN pilote ON humain.id_humain = pilote.id_humain Where humain.admin = 0x00;";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $humains = [];
        
        while ($row = $stmt->fetch()) {
            $humain = new Humain(
                $row['id_humain'],
                $row['nom'],
                $row['prenom'],
                $row['admin'],
                $row['id_etudiant'],
                $row['id_pilote'],
                $row['photo_profil']
                
            );
            $humains[] = $humain;
        }

        return $humains;
    }


    public function searchHumains($search) {
        $sql = "SELECT humain.id_humain, nom, prenom, photo_profil, admin, id_etudiant, id_pilote FROM Humain
        LEFT JOIN Etudiant ON humain.id_humain = etudiant.id_humain
        LEFT JOIN pilote ON humain.id_humain = pilote.id_humain
        Where humain.admin = 0x00 AND (humain.nom LIKE :search OR humain.prenom LIKE :search);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => '%' . $search . '%']);
    
        $humains = [];
        while ($row = $stmt->fetch()) {
            $humain = new Humain(
                $row['id_humain'],
                $row['nom'],
                $row['prenom'],
                $row['admin'],
                $row['id_etudiant'],
                $row['id_pilote'],
                $row['photo_profil']
            );
            $humains[] = $humain;
        }
    
        return $humains;
    }
    public function getHumainById($id_humain) {
        $sql = "SELECT H.id_humain, H.nom, H.prenom, H.admin, E.id_etudiant, P.id_pilote, photo_profil
                FROM Humain H
                LEFT JOIN Etudiant E ON H.id_humain = E.id_humain
                LEFT JOIN Pilote P ON H.id_humain = P.id_humain
                WHERE H.id_humain = :id_humain";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_humain' => $id_humain]);
    
        $row = $stmt->fetch();
        if ($row) {
            $humain = new Humain(
                $row['id_humain'],
                $row['nom'],
                $row['prenom'],
                $row['admin'],
                $row['id_etudiant'],
                $row['id_pilote'],
                $row['photo_profil']
            );
            return $humain;
        }
        return null;
    }
    
    public function getAllPromos() {
        $query = "SELECT id_promo, type_promo, annee FROM promo";
        $result = $this->conn->query($query);
    
        $promos = array();
        if ($result ) {
            while($row = $result->fetch()) {
                array_push($promos, (object) $row);
            }
        }
        return $promos;
    }

    public function updateEtudiant($id_humain, $nom, $prenom, $photo_profil, $cv, $lettre_lm, $id_promo)
{
    // Mettre à jour la table humain
    $query = "UPDATE humain SET nom = ?, prenom = ? WHERE id_humain = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssi", $nom, $prenom, $id_humain);
    $stmt->execute();
    $query = "SELECT * FROM etudiant WHERE id_humain = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindparam("i", $id_humain);
    $stmt->execute();
    $result = $stmt->get_result();
    $query = "UPDATE etudiant SET photo_profil = ?, cv = ?, lettre_lm = ?, id_promo = ? WHERE id_humain = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindparam("sssii", $photo_profil, $cv, $lettre_lm, $id_promo);
    $stmt->execute();
    $stmt->close();
}

public function getEtudiantById($id) {
    $query = "SELECT * FROM etudiant WHERE id_etudiant = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if ($result !== false) {
        return $result;
    } else {
        return null;
    }
}

public function handleRequest($etudiant_id) {
    if (isset($_POST['update'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_promo = $_POST['id_promo'];
    $query = "UPDATE etudiant SET nom = ?, prenom = ?, id_promo = ? WHERE id_etudiant = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindparam("ssii", $nom, $prenom, $id_promo, $etudiant_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<p class='success'>L'étudiant a été modifié avec succès.</p>";
    } else {
        echo "<p class='error'>Erreur lors de la modification de l'étudiant.</p>";
    }
}
}

public function deleteEtudiantById($id) {
    $query = "DELETE FROM etudiant WHERE id_etudiant = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindparam('i', $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<p class='success'>L'étudiant a été supprimé avec succès.</p>";
    } else {
        echo "<p class='error'>Erreur lors de la suppression de l'étudiant.</p>";
    }
}
public function getTotalRecords($search_query = null) {
    if (!is_null($search_query)) {
        $query = "SELECT COUNT(*) AS total_records FROM humain WHERE nom LIKE :search_query OR prenom LIKE :search_query";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':search_query', "%$search_query%", PDO::PARAM_STR);
    } else {
        $query = "SELECT COUNT(*) AS total_records FROM humain";
        $stmt = $this->conn->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_records'];
}


    public function closeConnection() {
        $this->conn = null;
    }
}
?>