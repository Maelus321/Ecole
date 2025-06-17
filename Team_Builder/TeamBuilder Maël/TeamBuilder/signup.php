<?php
require_once 'Trainer.php';
require_once 'TrainerManager.php';

$name = $_POST['name'] ?? '';       // récupération des données POST avec valeur par défaut vide
$password = $_POST['password'] ?? '';
$rank = $_POST['rank'] ?? '';

$manager = new TrainerManager();
$trainers = $manager->getAll();     // récupération de tous les dresseurs existants

$alreadyExists = false;

foreach ($trainers as $trainer) {
    if ($trainer->getName() === $name) { // vérifie si un dresseur a déjà ce nom
        $alreadyExists = true;
        break;
    }
}

if ($alreadyExists) {
    // injecte du JS pour afficher une alerte côté client + revenir à la page précédente
    echo "<script>alert('This name is already used. Please choose another one.'); window.history.back();</script>";
    exit; // arrête l'exécution du script après le message
} else {
    $newTrainer = new Trainer([
        'name' => $name,
        'password' => $password,
        'rank' => $rank
    ]);
    $manager->add($newTrainer); // ajoute le nouveau dresseur en base
    header("Location: pokedex.php"); // redirige vers le pokédex après l'inscription
    exit;
}
