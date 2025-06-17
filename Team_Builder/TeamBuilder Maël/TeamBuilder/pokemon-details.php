<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="details.css">
    <link id="icon" rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
    <link rel="stylesheet" href="pokemon-details.css">
    
    <title>Pokemon</title>
</head>

<body>
    <header></header>
    <div></div>
    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>
    <script src="./pokemon-details.js"></script>
</body>

</html>

<?php
session_start();
if (!isset($_SESSION['trainer'])){
    header('Location: index.php');
}