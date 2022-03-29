<?php

require_once '../.././src/Entity/Game.php';
require_once '../.././src/db/Database.php';
/**
 * GameManager
 * Gère les requêtes SQL envoyées à la base de données pour les objets (class) Game
 * Hérite de la class Database
 */

class GameManager extends Database {

    public function addGame(Game $game){
        
        // l'héritage nous permet d'avoir accès à la méthode getConnection de la class "mère" Database
        // on peut ainsi créer une connexion à la base de donnée comme on le souhaite
        $conn =$this->getConnection();
        // on prépare la requête $req
        // On veut insérer une nouvelle entrée dans la table game
        // En SQL on utilise INSERT INTO pour enregistrer une nouvelle entrée dans une table
        // Ci-dessous, une requête SQL pour insérer du contenu dans une table.
        // On met les valeurs dans l’ordre des champs en base de données
        // INSERT INTO nomDeLaTable VALUES ('valeur 1', 'valeur 2', ...) --> prend l'id en compte
        // Mais dans notre cas, on a l’id qui s’auto incrémente donc on va devoir spécifier les colonnes qui nous intéressent
        // INSERT INTO table (nom_colonne_1, nom_colonne_2, ...) VALUES ('valeur 1', 'valeur 2', ...)
        // dans les parenthèses après VALUES, on écrit des "arguments nommés" https://www.php.net/manual/fr/functions.arguments.php

        $req = $conn->prepare('INSERT INTO game (play_time, number_of_pairs_found) VALUES (:playTime, :numberOfPairsFound)');
        //execute permet d'exécuter notre requête préparée
        // on lui donne en argument un tableau, qui contient nos "vraies" valeurs à enregistrer
        $req->execute([
            'playTime' => $game->getPlayTime(), // comme on manipule des objets, on utilise le getter pour obtenir la valeur
            'numberOfPairsFound' => $game->getNumberOfPairsFound()
        ]);
        //on va récupérer l'id de la dernière entrée insérée dans la table game
        // C'est une méthode de la class PDO https://www.php.net/manual/fr/pdo.lastinsertid.php
        // ATTENTION : il faut absolument garder la même connexion (ici $conn)
        // et ne pas en créer une nouvelle pour récupérer ce dernier id inséré
        $idGame = $conn->lastInsertId();
        //on va renvoyer les résultats au front-end (à notre fichier JS)
        //on va encoder en JSON notre tableau de résultats $data
        // pour qu'il soit manipulable en JS
        echo json_encode(['idGame' => $idGame]);
    }

    public function getList($max_duration_game){
        //on prépare la requête
        // ici on sélectionne tous les champs grâce à * dans la table game
        // il y a une condition à respecter : le champ playtime doit contenir une valeur inférieure
        // à celle passée en argument (dans notre cas, il s'agit de la durée maximale de jeu)
        // en effet, on ne veut que les gagnants !
        // order by permet de trier notre tableau 
        $req = $this->getConnection()->prepare('SELECT * FROM game where play_time < :maxDurationGame ORDER BY play_time asc LIMIT 3');
        $req->execute([
            'maxDurationGame' => $max_duration_game
        ]);
        $data = $req->fetchAll();
        //on va renvoyer les résultats au front-end (à notre fichier JS)
        //on va encoder en JSON notre tableau de résultats $data
        // pour qu'il soit manipulable en JS
        echo json_encode($data);
    }
}