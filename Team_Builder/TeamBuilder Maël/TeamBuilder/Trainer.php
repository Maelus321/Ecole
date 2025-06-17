<?php

class Trainer
{

    #atributs
    private int $id;
    private string $name;
    private string $rank;
    private string $password;

    #getters

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getRank(){
        return $this->rank;
    }
    public function getPassword(){
        return $this->password;
    }

    #setters

    public function setId($id){
        $id = (int) $id;
        if ($id > 0){
            $this->id = $id;
        }
    }

    public function setName($name){
        if (is_string($name)){
            $this->name = $name;
        }
    }
    public function setRank($rank){
        if (is_string($rank)){
            $this->rank = $rank;
        }
    }
    public function setPassword($password){
        if (is_string($password)){
            $this->password = $password;
        }
    }

public function __construct(array $data = [])
{
    if (!empty($data)) {
        $this->hydrate($data);
    }
}

    public function hydrate(array $donnees) {
        foreach ($donnees as $cle => $valeur){
            $methode = "set".ucfirst($cle);
            if (method_exists($this, $methode)){
                $this->$methode($valeur);
            }
        }
    }
} 


