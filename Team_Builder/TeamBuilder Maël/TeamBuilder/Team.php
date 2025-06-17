<?php

class Team
{
    private int $id;
    private int $trainer_id;  // clé étrangère, id d’un Trainer
    private array $pokemons;  // on stockera un tableau PHP, qui sera converti en JSON à la sauvegarde


    public function __construct(int $id = 0, int $trainer_id = 0, array $pokemons = [])
    {
        $this->id = $id;
        $this->trainer_id = $trainer_id;
        $this->pokemons = $pokemons;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }
    public function getTrainerId(): int {
        return $this->trainer_id;
    }
    public function getPokemons(): array {
        return $this->pokemons;
    }

    // Setters
    public function setId(int $id): void {
        if ($id > 0) $this->id = $id;
    }
    public function setTrainerId(int $trainer_id): void {
        if ($trainer_id > 0) $this->trainer_id = $trainer_id;
    }
    public function setPokemons(array $pokemons): void {
        $this->pokemons = $pokemons;
    }

    // Hydrate
    public function hydrate(array $data): void {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                // Si clé 'pokemons', on décode le JSON en tableau PHP
                if ($key === 'pokemons' && is_string($value)) {
                    $value = json_decode($value, true); // true = tableau associatif
                }
                $this->$method($value);
            }
        }
    }

    public function toArray(): array {
    return [
        'id' => $this->getId(),
        'trainer_id' => $this->getTrainerId(),
        'pokemons' => $this->getPokemons(),
    ];
}

}


?>