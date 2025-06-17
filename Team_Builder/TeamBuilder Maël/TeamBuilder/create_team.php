<?php
require_once 'Trainer.php';
require_once 'TrainerManager.php';
require_once 'Team.php';
require_once 'TeamManager.php';

session_start();
if (!isset($_SESSION['trainer'])) {
    header('Location: index.php');
    exit;
}

$trainer = $_SESSION['trainer'];
$trainer_id = $trainer->getId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pokemons = [];
    for ($i = 1; $i <= 6; $i++) {
        if (!isset($_POST["pokemon$i"])) {
            die("Pokémon $i manquant !");
        }
        $pokemons["pokemon$i"] = intval($_POST["pokemon$i"]); // cast en entier pour éviter injections ou données invalides
    }

    $json_pokemons = json_encode($pokemons); // encodage JSON pour stocker plusieurs valeurs dans un seul champ BDD

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=team_builder;charset=utf8', 'root', 'root'); // connexion PDO avec encodage UTF-8

        $stmt = $pdo->prepare("INSERT INTO team (trainer_id, pokemons) VALUES (:trainer_id, :pokemons)"); // requête préparée pour éviter injections SQL
        $stmt->execute([
            'trainer_id' => $trainer_id,
            'pokemons' => $json_pokemons
        ]);
    } catch (PDOException $e) {
        die("Erreur base de données : " . $e->getMessage()); // gestion d'erreur propre à PDO
    }

    header('Location: teams.php');
    exit;
}
?>
