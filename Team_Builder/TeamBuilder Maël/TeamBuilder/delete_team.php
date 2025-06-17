<?php
require_once 'Trainer.php';
require_once 'Team.php';
require_once 'TeamManager.php';
session_start();

file_put_contents("debug_log.txt", "Script lancé\n", FILE_APPEND); // log de démarrage du script (debug)

header('Content-Type: application/json'); // indique que la réponse sera en JSON (API REST)

if (!isset($_SESSION['trainer'])) {
    file_put_contents("debug_log.txt", "Trainer non connecté\n", FILE_APPEND); // log pour debug si utilisateur non connecté
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit;
}

$trainer = $_SESSION['trainer'];
file_put_contents("debug_log.txt", "Trainer ID: " . $trainer->getId() . "\n", FILE_APPEND); // log ID du dresseur

$data = json_decode(file_get_contents("php://input"), true); // lecture du corps JSON brut de la requête HTTP
file_put_contents("debug_log.txt", "Données reçues: " . json_encode($data) . "\n", FILE_APPEND); // log des données reçues (debug)

if (!isset($data['id'])) {
    file_put_contents("debug_log.txt", "ID manquant\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'ID manquant']);
    exit;
}

$teamId = (int)$data['id']; // cast en entier pour sécurité (éviter injection, typage strict)
file_put_contents("debug_log.txt", "Recherche de l'équipe ID: $teamId\n", FILE_APPEND);

$teamManager = new TeamManager();
$team = $teamManager->get($teamId); // récupération de l'équipe depuis la BDD

if (!$team) {
    file_put_contents("debug_log.txt", "Équipe introuvable\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Équipe introuvable']);
    exit;
}

if ($team->getTrainerId() !== $trainer->getId()) { // vérifie que l'équipe appartient bien à l'utilisateur connecté
    file_put_contents("debug_log.txt", "Équipe ne vous appartient pas\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Vous ne pouvez pas supprimer cette équipe']);
    exit;
}

$teamManager->delete($teamId); // suppression de l'équipe en base
file_put_contents("debug_log.txt", "Équipe supprimée avec succès\n", FILE_APPEND); // log suppression réussie
echo json_encode(['success' => true]); // réponse JSON pour confirmer la suppression
