queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");

fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
  .then((response) => response.json())
  .then((data) => {
    dataglobal = data;
    programmeprincipal();
  })
  .catch((error) => console.error("Erreur: ", error));

function programmeprincipal() {
  console.log(id);
  let talentsHTML = "";
  dataglobal.abilities.forEach((item, index) => {
    talentsHTML += `<p>Ability ${index + 1}: ${item.ability.name}</p>`;
  });

  html = `
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
  <h1> <u>${dataglobal.forms[0].name}</u> id: ${id}</h1>
  <div class="container">
  <div class="element" id="image">
  <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png">
  </div>
  <div class="element">
  <table  id = "statsTable">
  <tr>
    <th id="left">Stat</th>
    <th id="right">Value</th>
  </tr>
  <tr>
    <td>Health</td>
    <td>${dataglobal.stats[0].base_stat}</td>
  </tr>
  <tr>
    <td>Attack</td>
    <td>${dataglobal.stats[1].base_stat}</td>
  </tr>
  <tr>
    <td>Defense</td>
    <td>${dataglobal.stats[2].base_stat}</td>
  </tr>
  <tr>
    <td>Special Attack</td>
    <td>${dataglobal.stats[3].base_stat}</td>
  </tr>
  <tr>
    <td>Special Defense</td>
    <td>${dataglobal.stats[4].base_stat}</td>
  </tr>
  <tr>
    <td>Speed</td>
    <td>${dataglobal.stats[5].base_stat}</td>
  </tr> 
</table>
</div>
<strong>
${talentsHTML}
</strong>
</div>
<div class="video-background">
        <video id="background" autoplay loop muted>
            <source src="media/pokemon-background-2.mp4">
        </video>
    </div>
`;
  document.body.innerHTML = html;
}
