<?php
/**
 * Class GameController
 * C'est le GameController qu'on instancie dans api.php
 * Il décide de quelle méthode du GameManager il va se servir pour manipuler les données
 */
require_once '../.././src/Model/GameManager.php';

class GameController {

    //propriété gameManager
    private $gameManager ;

    public function __construct(){        
        //on instancie un objet GameManager()
        // cette instance est enregistrée dans la propriété
        $this->gameManager = new GameManager();
    }
    
    function saveGameAction(array $input) {
        //à partir du tableau d'inputs, on crée un objet Game      
        $newGame = new Game([
            'playTime' => $input['playTimeData'],
            'numberOfPairsFound' => $input['numberOfPairsFound']
        ]);
        // on met cet objet en argument de la méthode addGame du GameManager
        // c'est cette instance de GameManager qui va enregistrer notre Game en base de données
        $this->gameManager->addGame($newGame);
        exit();
    }
    
    function getListAction($max_duration_game) {
        //on récupère notre variable de temps max
        //on la met en paramètre de la méthode getList() du GameManager
        // c'est cette instance de GameManager qui va requêter la base de données
        // et nous renvoyer notre liste d'objets Game
        $list = $this->gameManager->getList($max_duration_game);
        return $list;
    }
}
