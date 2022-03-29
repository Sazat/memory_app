<?php

/*
* Class Game pour gérer les parties du jeu de mémoire
*/
class Game {

    private $id;
    private $playTime; // temps de jeu du joueur
    private $numberOfPairsFound;
    
    // dans le constructeur de la class, on appelle la fonction hydrate
    public function __construct(array $gameTable){        
        $this->hydrate($gameTable);
    }

    /* Le principe de l'hydratation consiste à remplir un objet, 
    * donc l'instance d'une classe, avec les variables lui permettant 
    * d'être "remplie".
    * Cela permet par exemple d'éviter d'avoir à remplir manuellement 
    * chaque champ de chaque objet lorsque l'on lit les données dans la base
    * dans mon gameController, je n'ai pas besoin d'utiliser setPlayTime et setNumberOfPairsFound
    * c'est la méthode hydrate qui va le faire à ma place
    */
    public function hydrate(array $gameTable){
        foreach($gameTable as $key => $value){
            $method = 'set' . ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
      }


    // === GETTERS & SETTERS ===   
    /*
     * Les getters et les setters nous permettent d'avoir accès
     * aux propriétés "private" de nos instances d'objet
     * On notera qu'il n'y a pas de setter pour la propriété Id
     * car c'est la base de données qui se charge de cela (auto-incrémentation) 
     */
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of playTime
     */ 
    public function getPlayTime()
    {
        return $this->playTime;
    }

    /**
     * Set the value of playTime
     *
     * @return  self
     */ 
    public function setPlayTime($playTime)
    {
        $this->playTime = $playTime;

        return $this;
    }


    /**
     * Get the value of numberOfPairsFound
     */ 
    public function getNumberOfPairsFound()
    {
        return $this->numberOfPairsFound;
    }

    /**
     * Set the value of numberOfPairsFound
     *
     * @return  self
     */ 
    public function setNumberOfPairsFound($numberOfPairsFound)
    {
        $this->numberOfPairsFound = $numberOfPairsFound;

        return $this;
    }
}