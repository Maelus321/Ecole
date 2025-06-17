let dataglobal = null;

fetch("https://pokeapi.co/api/v2/pokemon?limit=1025&offset=0")
  .then((response) => response.json())
  .then((data) => {
    dataglobal = data.results; // on simplifie ici
    displayPokemons(dataglobal);
  })
  .catch((error) => console.error("Erreur: ", error));

function displayPokemons(pokemons) {
  let html = "";

  pokemons.forEach((pokemon) => {
    const name = pokemon.name;

    // ✅ Extraire l'ID depuis l'URL
    const urlParts = pokemon.url.split("/");
    const id = urlParts[urlParts.length - 2];

    html += `
      <a href='pokemon-details.php?id=${id}'>
        <div class="card" id="pokemon-${id}">
          ${name}
          <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png" alt="image de ${name}">
        </div>
      </a>`;
  });

  document.getElementById("oui").innerHTML = html;
}


// 🔍 Ajout de la recherche dynamique
document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("search");

  searchInput.addEventListener("input", function () {
    const searchTerm = this.value.toLowerCase();

    const filtered = dataglobal.filter((pokemon) =>
      pokemon.name.toLowerCase().includes(searchTerm)
    );

    displayPokemons(filtered);
  });
});
