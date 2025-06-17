<?php
class TrainerManager
{
    private $db;

    public function __construct()
    {
        $dbName = "team_builder";
        $port = 3306;
        $userName = "root";
        $password = "root";
        try {
            // Connexion à la BDD avec encodage utf8mb4 (gère caractères spéciaux/emojis)
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $password));
        } catch (PDOException $error) {
            echo $error->getMessage(); // Affiche l’erreur si la connexion échoue
        }
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function add(Trainer $trainer)
    {
        // Préparation d'une requête sécurisée avec valeurs nommées
        $req = $this->db->prepare("INSERT INTO `trainer` (name,rank,password) VALUES (:name,:rank,:password)");

        $req->bindValue(":name", $trainer->getName(), PDO::PARAM_STR);
        $req->bindValue(":rank", $trainer->getRank(), PDO::PARAM_STR);
        $req->bindValue(":password", $trainer->getPassword(), PDO::PARAM_STR);

        $req->execute();
    }

    public function get(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `trainer` WHERE id =:id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $donnees = $req->fetch(); // récupère les données du dresseur

        $trainer = new Trainer($donnees); // constructeur avec données
        $trainer->hydrate($donnees);      // hydrate redondant ici mais utile si constructeur vide

        return $trainer;
    }

    public function getAll()
    {
        $trainers = [];
        $req = $this->db->prepare("SELECT * FROM `trainer` ORDER BY name"); // tri par nom
        $req->execute();
        $donnees = $req->fetchAll(); // retourne tableau de tous les résultats

        foreach ($donnees as $donnee) {
            $trainer = new Trainer($donnee); // création d’objet Trainer pour chaque ligne
            $trainers[] = $trainer;
        }

        return $trainers;
    }

    public function update(Trainer $trainer)
    {
        $req = $this->db->prepare("UPDATE `trainer` SET name = :name, rank = :rank, password = :password WHERE id = :id");

        // mise à jour sécurisée des champs
        $req->bindValue(":id", $trainer->getId(), PDO::PARAM_INT);
        $req->bindValue(":name", $trainer->getName(), PDO::PARAM_STR);
        $req->bindValue(":rank", $trainer->getRank(), PDO::PARAM_STR);
        $req->bindValue(":password", $trainer->getPassword(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `trainer` WHERE id = :id"); // suppression via ID
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
