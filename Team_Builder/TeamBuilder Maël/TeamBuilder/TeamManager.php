<?php
class TeamManager
{
    private PDO $db;

    public function __construct()
    {
        $dbName = "team_builder";
        $port = 3306;
        $userName = "root";
        $password = "root";
        try {
            // Connexion PDO avec encodage UTF-8 (utf8mb4 pour emojis/compatibilité étendue)
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port;charset=utf8mb4", $userName, $password));
        } catch(PDOException $error) {
            echo $error->getMessage(); // affichage de l'erreur si la connexion échoue
        }
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function add(Team $team): void
    {
        $sql = "INSERT INTO team (trainer_id, pokemons) VALUES (:trainer_id, :pokemons)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':trainer_id', $team->getTrainerId(), PDO::PARAM_INT);

        // Encodage du tableau PHP en JSON pour l’enregistrer dans un champ SQL unique
        $pokemonsJson = json_encode($team->getPokemons());
        $stmt->bindValue(':pokemons', $pokemonsJson, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function get(int $id): ?Team
    {
        $sql = "SELECT id, trainer_id AS trainerId, pokemons FROM team WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC); // retourne false si aucune ligne

        if (!$data) return null; // retourne null si l’équipe n’existe pas

        $team = new Team();
        $team->hydrate($data); // remplit l’objet Team à partir du tableau associatif

        return $team;
    }

    public function getAll(): array
    {
        $teams = [];
        $sql = "SELECT id, trainer_id AS trainerId, pokemons FROM team ORDER BY id";
        $stmt = $this->db->query($sql); // pas besoin de prepare car pas de données dynamiques ici

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC); // liste des équipes en tableau associatif

        foreach ($dataList as $data) {
            $team = new Team();
            $team->hydrate($data); // hydrate chaque objet Team
            $teams[] = $team;
        }

        return $teams;
    }

    public function update(Team $team): void
    {
        $sql = "UPDATE team SET trainer_id = :trainer_id, pokemons = :pokemons WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':trainer_id', $team->getTrainerId(), PDO::PARAM_INT);
        $stmt->bindValue(':pokemons', json_encode($team->getPokemons()), PDO::PARAM_STR); // conversion JSON pour BDD
        $stmt->bindValue(':id', $team->getId(), PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM team WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteAllByTrainerId(int $trainerId)
    {
        // Supprime toutes les équipes appartenant à un même dresseur
        $req = $this->db->prepare("DELETE FROM `team` WHERE trainer_id = :trainer_id");
        $req->bindValue(":trainer_id", $trainerId, PDO::PARAM_INT);
        $req->execute();
    }
}
?>
