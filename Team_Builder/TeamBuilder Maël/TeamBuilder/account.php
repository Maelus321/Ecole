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

// Récupérer les informations du trainer connecté
$trainerManager = new TrainerManager();
$trainer = $trainerManager->get($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="account.css">
    <link rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
    <title>Pokedex</title>
</head>

<body>
    <header>
        <div class="top-banner">
            <div class="left-group">
                <a href="pokedex.php"><span>Pokedex</span></a>
                <a href="teams.php"><span>Teams</span></a>
            </div>
            <div class="right-group">
                <a href="account.php">
                    <span>Account </span>
                </a>
                <a href="index.php">
                    <span>Disconnect</span>
                </a>
            </div>
        </div>
    </header>

    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>

    <div class="account-container">
        <h1>Account</h1>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
        <form action="update_account.php" method="POST" class="account-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($trainer->getName()); ?>" required>
            </div>
            <div class="form-group">
                <label for="rank">Rank:</label>
                <select id="rank" name="rank" required>
                    <option value="bronze" <?php echo $trainer->getRank() === 'bronze' ? 'selected' : ''; ?>>Bronze</option>
                    <option value="argent" <?php echo $trainer->getRank() === 'argent' ? 'selected' : ''; ?>>Argent</option>
                    <option value="or" <?php echo $trainer->getRank() === 'or' ? 'selected' : ''; ?>>Or</option>
                    <option value="platine" <?php echo $trainer->getRank() === 'platine' ? 'selected' : ''; ?>>Platine</option>
                    <option value="diamant" <?php echo $trainer->getRank() === 'diamant' ? 'selected' : ''; ?>>Diamant</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</body>
</html>