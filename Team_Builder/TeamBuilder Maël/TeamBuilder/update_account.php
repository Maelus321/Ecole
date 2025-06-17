<?php
session_start();
require_once 'config/database.php';
require_once 'Trainer.php';
require_once 'TrainerManager.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['username']);
    $rank = htmlspecialchars($_POST['rank']);
    $trainer_id = $_SESSION['user_id'];

    try {
        // Afficher les valeurs pour le débogage
        error_log("Tentative de mise à jour - Trainer ID: " . $trainer_id);
        error_log("Nouveau name: " . $name);
        error_log("Nouveau rank: " . $rank);

        // Vérifier d'abord si le trainer existe
        $check_query = "SELECT * FROM trainer WHERE id = :trainer_id";
        $check_stmt = $pdo->prepare($check_query);
        $check_stmt->execute([':trainer_id' => $trainer_id]);
        
        if ($check_stmt->rowCount() === 0) {
            throw new Exception("Trainer non trouvé");
        }

        // Préparer la requête de mise à jour
        $query = "UPDATE trainer SET name = :name, rank = :rank WHERE id = :trainer_id";
        $stmt = $pdo->prepare($query);
        
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute([
            ':name' => $name,
            ':rank' => $rank,
            ':trainer_id' => $trainer_id
        ]);

        if ($result) {
            error_log("Mise à jour réussie");
            $_SESSION['success_message'] = "Account updated successfully!";
            
            // Mettre à jour l'objet trainer dans la session
            $trainerManager = new TrainerManager();
            $updatedTrainer = $trainerManager->get($trainer_id);
            $_SESSION['trainer'] = $updatedTrainer;
        } else {
            error_log("Échec de la mise à jour");
            $_SESSION['error_message'] = "Failed to update account.";
        }

        header('Location: account.php');
        exit();

    } catch (Exception $e) {
        error_log("Erreur lors de la mise à jour: " . $e->getMessage());
        $_SESSION['error_message'] = "An error occurred: " . $e->getMessage();
        header('Location: account.php');
        exit();
    }
} else {
    // Si quelqu'un accède directement à ce fichier sans POST
    header('Location: account.php');
    exit();
}
?> 