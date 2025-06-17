<?php
require_once 'Trainer.php';
require_once 'TrainerManager.php';
session_start();

$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';

$manager = new TrainerManager();
$trainers = $manager->getAll();

$found = false;

foreach ($trainers as $trainer) {
    if ($trainer->getName() === $name && $trainer->getPassword() === $password) {
        $_SESSION['trainer'] = $trainer;
        $_SESSION['user_id'] = $trainer->getId();
        header('Location: pokedex.php');
        exit;
    }
}

if (!$found) {
    // Aucun compte trouvé avec ce nom + mot de passe
    echo "<script>
        alert('Nom ou mot de passe incorrect.');window.history.back();</script>";
    exit;
}
