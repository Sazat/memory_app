<?php
require '../.././src/Entity/Card.php';
/**
 * GameManager
 * Gère les requêtes SQL envoyées à la base de données pour les objets (class) Card
 * Hérite de la class Database
 */
class CardManager extends Database {
    // l'héritage nous permet d'avoir accès à la méthode getConnection de la class "mère" Database
    // on peut ainsi créer une connexion à la base de donnée comme on le souhaite
    public function addCard(Card $card){
        $req = $this->getConnection()->prepare('INSERT INTO card (sprite_index,board_index, is_matched,game_id) VALUES (:indexSprite,:indexBoard,:isMatched,:gameId)');
        $req->execute([
            'indexSprite' => $card->getIndexSprite(),
            'indexBoard' => $card->getIndexBoard(),
            'isMatched' => $card->getIsMatched(),
            'gameId' => $card->getGameId()
        ]);
    }
}