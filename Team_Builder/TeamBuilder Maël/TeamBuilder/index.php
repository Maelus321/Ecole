<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
    <link rel="stylesheet" href="style.css">
    <title>Acceuil</title>
</head>

<body>
    <div class="logo"><img src="media/pokedex-logo.svg" alt="logo pokedex"></div>
    <div class="box">
        <div class="button" id="login-btn">
            <p>Login</p>
        </div>
        <a href="signupPage.php">
        <div class="button">
            <p>Signup</p>
        </div>
        </a>
    </div>

    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>

    <div id="popup" class="hidden">
    </div>

    <script src="script.js"></script>
</body>
</html>