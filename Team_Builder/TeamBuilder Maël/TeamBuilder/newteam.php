<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="icon" rel="icon" type="image/jpeg" href="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2052px-Pok%C3%A9_Ball_icon.svg.png">
    <link rel="stylesheet" href="newteams.css">
    <title>Team Maker</title>
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
                    <span> Disconnect</span>
                </a>
            </div>
        </div>

    </header>

    <h1>New team</h1>

    <div class="team-maker">
        <form method="POST" action="create_team.php">
            <div class="row">
                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon1" class="form-control"></select>
                </div>

                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon2" class="form-control"></select>
                </div>

                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon3" class="form-control"></select>
                </div>
            </div>
            <div class="row">
                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon4" class="form-control"></select>
                </div>

                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon5" class="form-control"></select>
                </div>

                <div class="pokemon">
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="pokemon image">
                    <p>bulbizare</p>
                    <label for="pokemon"> Pokemon</label>
                    <select name="pokemon6" class="form-control"></select>
                </div>
            </div>
            <div class="button-container">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
    <div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>
</body>

</html>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const MAX_POKEMON = 1025; // nombre total de Pokémon à afficher dans les listes

        // Fonction pour mettre la première lettre d'une chaîne en majuscule
        const capitalize = s => s.charAt(0).toUpperCase() + s.slice(1);

        // Remplit un élément <select> avec les valeurs 1 à 1025
        function populateSelect(select) {
            for (let i = 1; i <= MAX_POKEMON; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                select.appendChild(option); // ajoute chaque option au menu déroulant
            }
        }

        // Initialisation de chaque bloc contenant un Pokémon
        document.querySelectorAll('.pokemon').forEach(block => {
            const select = block.querySelector('select');
            const image = block.querySelector('img');
            const name = block.querySelector('p');

            populateSelect(select); // remplit le select avec tous les numéros de Pokémon

            // Met à jour l'image et le nom quand un Pokémon est sélectionné
            select.addEventListener('change', async () => {
                const id = select.value;
                image.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png`; // URL d'image officielle du Pokémon

                try {
                    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`); // appel API pour récupérer les infos du Pokémon
                    const data = await res.json();
                    name.textContent = capitalize(data.name); // affiche le nom formaté
                } catch (e) {
                    name.textContent = 'Unknown'; // fallback si erreur d’API
                }
            });

            // Déclenche un changement initial pour charger le premier Pokémon par défaut
            select.dispatchEvent(new Event('change')); // force le déclenchement du listener au chargement
        });
    });
</script>
