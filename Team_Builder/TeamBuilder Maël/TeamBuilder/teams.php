    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="icon" rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
        <link rel="stylesheet" href="teams.css">
        <title>Teams</title>
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

        <div id="container"></div>
        <div class="video-background">
            <video id="background" autoplay loop muted>
                <source src="media/pokemon-background-2.mp4">
            </video>
        </div>
        <script src="teams.js"></script>
    </body>

    </html>






    <?php
    require_once 'Trainer.php';
    require_once 'TrainerManager.php';
    require_once 'Team.php';
    require_once 'TeamManager.php';
    session_start();



    if (!isset($_SESSION['trainer'])) {
        header('Location: index.php');
    }
    $trainer = $_SESSION['trainer'];




    $trainer_id = $trainer->getId();




    $manager = new TeamManager();
    $teams = $manager->getAll();

    $trainer_list = [];


    foreach ($teams as $team) {
        if ($team->getTrainerId() === $trainer_id) {
            $trainer_list[] = $team;
        }
    }


    $arrayTeams = array_map(fn($team) => $team->toArray(), $trainer_list);
    $jsonTeams = json_encode($arrayTeams);




    ?>
    <script>
    const teams = <?php echo $jsonTeams; ?>;
    console.log(teams);

    let html = `
    <a href="newteam.php">
    <div class="team" id="new-team">
        
            <img class="plus-button" src="media/plus_PNG100.png" alt="plus image">
        
    </div>
    </a>`;

    for (let i = 0; i < teams.length; i++) {
        html += `<div class="team" data-id="${teams[i].id}"><div class="row">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon1}.png">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon2}.png">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon3}.png">
</div><div class="row">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon4}.png">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon5}.png">
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${teams[i].pokemons.pokemon6}.png">
</div></div>`;
    }

    document.getElementById("container").innerHTML = html;

    // Attendre que le DOM soit complètement chargé
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.team').forEach(teamElement => {
            const teamId = teamElement.getAttribute('data-id');

            // On ignore le bouton "nouvelle équipe"
            if (!teamId) return;

            teamElement.addEventListener('click', async (e) => {
                e.preventDefault(); // Empêcher tout comportement par défaut
                const confirmDelete = confirm("Do you really want to delete this team ?");
                if (!confirmDelete) return;

                try {
                    const response = await fetch('delete_team.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: parseInt(teamId)
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        alert("Équipe supprimée !");
                        location.reload();
                    } else {
                        alert("Erreur : " + result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert("Une erreur s'est produite lors de la suppression");
                }
            });
        });
    });
</script>