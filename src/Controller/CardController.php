<?php
/**
 * Class CardController
 * C'est le CardController qu'on instancie dans api.php
 * Il décide de quelle méthode du GameManager il va se servir pour manipuler les données
 */
require_once '../.././src/Model/CardManager.php';

class CardController extends Database {
    //propriété cardManager
    private $cardManager;

    public function __construct(){
        //on instancie un objet CardManager()
        // cette instance est enregistrée dans la propriété      
        $this->cardManager = new CardManager();
    }

    function saveCardsAction(array $input) {
        $gameId = $input['idGame'];
        // on parcourt le tableau de cartes
        foreach ($input['cards'] as $key => $card) {
            /*on reçoit les booleans en string
            * on va utiliser la méthode filter_var pour obenir un boolean
            * https://www.php.net/manual/fr/function.filter-var.php
            * accompagné du filtre de validation FILTER_VALIDATE_BOOLEAN
            * https://www.php.net/manual/fr/filter.filters.validate.php
            */
            $isMatchedBoolean = filter_var($card['isMatched'], FILTER_VALIDATE_BOOLEAN);
            $newCard = new Card([
                'gameId' => $gameId,
                'indexSprite'=> $card['indexSprite'],
                'indexBoard'=> $key, // le tableau est celui utilisé dans le script JS, donc l'index de la carte dans ce table réprésente son indexBoard
                'isMatched'=> (int)$isMatchedBoolean // on utilise le cast (int) pour modifié le boolean en integer
            ]);
            $this->cardManager->addCard($newCard);
        }
        exit();
    }
}