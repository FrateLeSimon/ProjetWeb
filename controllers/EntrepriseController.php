<?php
require_once 'veriflogin.php';
require_once '../../models/Entreprise.php';

class EntrepriseController {
    private $db_host = 'localhost';
    private $db_name = 'bdd_staj';
    private $db_user = 'root';
    private $db_pass = '';
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }

    public function getEntreprises($start_from=0, $records_per_page=50, $search_query = null) {
        if ($search_query) {
            $sql = "SELECT entreprise.id_entreprise, nom_entreprise, secteur_activite, description_entreprise, ville, code_postal, logo, num_rue, nom_rue, pays FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse WHERE nom_entreprise LIKE :search_query ORDER BY entreprise.id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT entreprise.id_entreprise, nom_entreprise, secteur_activite, description_entreprise, ville, code_postal, logo, num_rue, nom_rue, pays FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse ORDER BY entreprise.id_entreprise ASC LIMIT $start_from, $records_per_page";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
    
        $entreprises = [];
        while ($row = $stmt->fetch()) {
            $entreprise = new Entreprise($row['id_entreprise'], $row['nom_entreprise'], $row['secteur_activite'], $row['description_entreprise'], $row['ville'], $row['code_postal'], $row['logo'], $row['num_rue'], $row['nom_rue'], $row['pays']);
            $entreprises[] = $entreprise;
        }
    
        return $entreprises;
    }
    public function addEntreprise($nom_entreprise, $secteur_activite, $logo, $description_entreprise, $num_rue, $nom_rue, $ville, $code_postal, $pays) {
        // Insérer les données dans la table entreprise
        $sql = "INSERT INTO Entreprise (nom_entreprise, secteur_activite, logo, description_entreprise) VALUES (:nom_entreprise, :secteur_activite, :logo, :description_entreprise)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom_entreprise', $nom_entreprise);
        $stmt->bindParam(':secteur_activite', $secteur_activite);
        $stmt->bindParam(':logo', $logo);
        $stmt->bindParam(':description_entreprise', $description_entreprise);
        $stmt->execute();

        // Récupérer l'ID de l'entreprise insérée
        $id_entreprise = $this->conn->lastInsertId();

        // Insérer les données dans la table adresse
        $sql = "INSERT INTO adresse (num_rue, nom_rue, ville, code_postal, pays) VALUES (:num_rue, :nom_rue, :ville, :code_postal, :pays)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':num_rue', $num_rue);
        $stmt->bindParam(':nom_rue', $nom_rue);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':code_postal', $code_postal);
        $stmt->bindParam(':pays', $pays);
        $stmt->execute();

        // Récupérer l'ID de l'adresse insérée
        $id_adresse = $this->conn->lastInsertId();

        // Insérer les données dans la table est_localisé_à
        $sql = "INSERT INTO est_localisé_à (id_entreprise, id_adresse) VALUES (:id_entreprise, :id_adresse)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_entreprise', $id_entreprise);
        $stmt->bindParam(':id_adresse', $id_adresse);
        $stmt->execute();

        header("Location: http://localhost:3000/projetWeb/views/afficher_entreprise/afficher_entreprise.php");
    }
    public function handleRequest($entreprise_id = null) {
        if (isset($_POST['id_entreprise'])) {
            $id_entreprise = $_POST['id_entreprise'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom_entreprise = $_POST['nom_entreprise'];
            $secteur_activite = $_POST['secteur_activite'];
            $description_entreprise = $_POST['description_entreprise'];
            $num_rue = $_POST['num_rue'];
            $nom_rue = $_POST['nom_rue'];
            $ville = $_POST['ville'];
            $code_postal = $_POST['code_postal'];
            $pays = $_POST['pays'];
    
            // Gérer l'upload du logo et définir le nom du fichier
            $logo = "";
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $upload_dir = '../../img/entreprise/';
                $file_name = basename($_FILES['logo']['name']);
                $target_file = $upload_dir . $file_name;
    
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
                    $logo = $file_name;
                }
            }
    
            // Vérifier si c'est une mise à jour ou un ajout
            if (isset($_POST['update']) && $_POST['update'] == '1' && isset($_POST['id_entreprise'])) {
                $id_entreprise = $_POST['id_entreprise'];
                $this->updateEntreprise($id_entreprise, $nom_entreprise, $secteur_activite, $logo, $description_entreprise, $num_rue, $nom_rue, $ville, $code_postal, $pays);
                // Rediriger vers la même page pour actualiser
                header("Location: http://localhost:3000/projetWeb/views/afficher_entreprise/afficher_entreprise.php");
            } 
         elseif (isset($_POST['delete'])) {
            $this->deleteEntreprise($entreprise_id);
        }
            else {
                $this->addEntreprise($nom_entreprise, $secteur_activite, $logo, $description_entreprise, $num_rue, $nom_rue, $ville, $code_postal, $pays);
            }
        }
    }
    
    public function getEntrepriseById($id_entreprise) {
        $sql = "SELECT nom_entreprise, secteur_activite, description_entreprise, ville, code_postal, logo, num_rue, nom_rue, pays FROM Entreprise LEFT JOIN est_localisé_à ON entreprise.id_entreprise = est_localisé_à.id_entreprise LEFT JOIN adresse ON est_localisé_à.id_adresse = adresse.id_adresse WHERE entreprise.id_entreprise = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
    
        if ($row) {
            $entreprise = new Entreprise($id_entreprise, $row['nom_entreprise'], $row['secteur_activite'], $row['description_entreprise'], $row['ville'], $row['code_postal'], $row['logo'], $row['num_rue'], $row['nom_rue'], $row['pays']);
            return $entreprise;
        }
    
        return null;
    }

    public function getTotalRecords() {
        $sql = "SELECT COUNT(*) AS total FROM Entreprise";
        $result = $this->conn->query($sql);
        $row = $result->fetch();
        return $row['total'];
    }
    public function updateEntreprise($id_entreprise, $nom_entreprise, $secteur_activite, $logo, $description_entreprise, $num_rue, $nom_rue, $ville, $code_postal, $pays) {
        try {
            // Si un nouveau logo est fourni, mettez-le à jour, sinon conservez l'ancien
            if ($logo !== "") {
                $logo_sql = ", logo = :logo";
            } else {
                $logo_sql = "";
            }
            
            // Mettre à jour les données dans la table entreprise
            $sql = "UPDATE Entreprise SET nom_entreprise = :nom_entreprise, secteur_activite = :secteur_activite, description_entreprise = :description_entreprise" . $logo_sql . " WHERE id_entreprise = :id_entreprise";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_entreprise', $id_entreprise);
            $stmt->bindParam(':nom_entreprise', $nom_entreprise);
            $stmt->bindParam(':secteur_activite', $secteur_activite);
            $stmt->bindParam(':description_entreprise', $description_entreprise);
            if ($logo !== "") {
                $stmt->bindParam(':logo', $logo);
            }
            $stmt->execute();
            
            // Vérifier si la mise à jour a affecté des lignes dans la base de données
            if ($stmt->rowCount() == 0) {
                throw new PDOException("La mise à jour de l'entreprise n'a affecté aucune ligne.");
            }
        
            // Récupérer l'ID de l'adresse associée à l'entreprise
            $sql = "SELECT id_adresse FROM est_localisé_à WHERE id_entreprise = :id_entreprise";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_entreprise', $id_entreprise);
            $stmt->execute();
            $id_adresse = $stmt->fetchColumn();
        
            // Mettre à jour les données dans la table adresse
            $sql = "UPDATE adresse SET num_rue = :num_rue, nom_rue = :nom_rue, ville = :ville, code_postal = :code_postal, pays = :pays WHERE id_adresse = :id_adresse";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_adresse', $id_adresse);
            $stmt->bindParam(':num_rue', $num_rue);
            $stmt->bindParam(':nom_rue', $nom_rue);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':code_postal', $code_postal);
            $stmt->bindParam(':pays', $pays);
            $stmt->execute();
    
            // Vérifier si la mise à jour a affecté des lignes dans la base de données
            if ($stmt->rowCount() == 0) {
                throw new PDOException("La mise à jour de l'adresse n'a affecté aucune ligne.");
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }

    public function deleteEntreprise($id_entreprise) {

        $sql = "DELETE FROM est_localisé_à WHERE id_entreprise = :id_entreprise";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_entreprise' => $id_entreprise]);

        $sql = "DELETE FROM entreprise WHERE id_entreprise = :id_entreprise";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id_entreprise' => $id_entreprise]);
    }

    
    
        public function closeConnection() {
            $this->conn = null;
        }
    }

