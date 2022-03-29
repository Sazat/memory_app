<?php
/*
* Class Carte du jeu
*/

class Card {

    private $id;
    private $indexSprite; // emplace sur l'image card.png 
    private $indexBoard; // emplacement de la carte sur le plateau du jeu
    private $isMatched; // boolean true si paire trouvée - sinon false
    private $gameId; // on relie les objets Card à  la partie (objet Game) jouée

    public function __construct(array $cardTable){        
        $this->hydrate($cardTable);
    }

    /* Le principe de l'hydratation consiste à remplir un objet, 
    * donc l'instance d'une classe, avec les variables lui permettant 
    * d'être "remplie".
    * Cela permet par exemple d'éviter d'avoir à remplir manuellement 
    * chaque champ de chaque objet lorsque l'on lit les données dans la base
    * dans mon gameController, je n'ai pas besoin d'utiliser setIndexSprite, etc.
    * c'est la méthode hydrate qui va le faire à ma place
    */
    public function hydrate(array $cardTable){
        foreach($cardTable as $key => $value){
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
     * Get the value of indexSprite
     */ 
    public function getIndexSprite()
    {
        return $this->indexSprite;
    }

    /**
     * Set the value of indexSprite
     *
     * @return  self
     */ 
    public function setIndexSprite($indexSprite)
    {
        $this->indexSprite = $indexSprite;

        return $this;
    }

    /**
     * Get the value of indexBoard
     */ 
    public function getIndexBoard()
    {
        return $this->indexBoard;
    }

    /**
     * Set the value of indexBoard
     *
     * @return  self
     */ 
    public function setIndexBoard($indexBoard)
    {
        $this->indexBoard = $indexBoard;

        return $this;
    }

    /**
     * Get the value of isMatched
     */ 
    public function getIsMatched()
    {
        return $this->isMatched;
    }

    /**
     * Set the value of isMatched
     *
     * @return  self
     */ 
    public function setIsMatched($isMatched)
    {
        $this->isMatched = $isMatched;

        return $this;
    }

    /**
     * Get the value of gameId
     */ 
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set the value of gameId
     *
     * @return  self
     */ 
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }


}