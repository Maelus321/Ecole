<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pokedex.css">
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
    <div class="search-container">
            <input type="text" id="search" placeholder="Search Pokémon...">
        </div>
    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>
    <h1 class="container" id="oui"></h1>
    <script src="importPokemons.js"></script>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['trainer'])) {
    header('Location: index.php');
}
