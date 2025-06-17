<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
    <link rel="stylesheet" href="signup.css">
    <title>Signup</title>
</head>

<body>

    <div class="fomulaire">
        <form method="POST" action="signup.php" class="container">

            <div>
                <label for="name">Name </label>
                <br>
                <input type="name" id="name" name="name" placeholder="Name" required class="form-control">
            </div>
            <br>

            <div>
                <label for="password">Password </label>
                <br>
                <input type="password" id="password" name="password" placeholder="Password" required
                    minlength="8" class="form-control">
                <br>
                <br>
                <label for="rank">Rank </label>
                <select name="rank" id="rank" class="form-control">
                    <option value="bronze">Bronze</option>
                    <option value="argent">Argent</option>
                    <option value="or">Or</option>
                    <option value="platine">Platine</option>
                    <option value="diamant">Diamant</option>
                </select>
                <br>
                <br>
                <input type="submit" value="Send" />
            </div>
        </form>
    </div>
    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>
</body>