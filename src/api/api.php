<?php
/**
 * Quand JQuery envoie une requête, il l'envoie à ce fichier
 * C'est ici qu'on va faire appe à nos Controllers
 * Les controllers ont pour mission de faire appel à la méthode adéquate du Manager
 */
require_once '../.././src/Controller/GameController.php';
require_once '../.././src/Controller/CardController.php';

// on crée nos instances d'object 'Controller'
$gameController = new GameController();
$cardController = new CardController();

// on vérifie s'il s'agit d'une méthode GET et dans ce cas, la superglobale GET existe
if($_GET) {
    //on regarde quelle action on doit réaliser
    // la clé action est précisée par Jquery
    // pour l'instant il n'y a qu'une requête GET dans notre code mais s'il évolue,
    // on pourrait potentiellement en avoir plusieurs selon les besoins
    if($_GET['action'] === 'getBestScores'){
        $gameController->getListAction($_GET['max_duration_game']);
    }
}
// on vérifie s'il s'agit d'une méthode GET et dans ce cas, la superglobale POST existe
if($_POST) {
    //on regarde quelle action on doit réaliser
    // la clé action est précisée par Jquery
    if($_POST['action'] === 'addGame') {
        //on veut ajouter une partie en base de données
        // le controller gameController va utiliser sa méthode saveGameAction
        // qui prend en paramètre les données envoyées par Jquery (data)
        $gameController->saveGameAction($_POST);
    }
    if($_POST['action'] === 'addCards') {
        //on veut ajouter les cartes du jeu
        // le cardController va faire appel à sa méthode saveCardsAction
        // qui prend en paramètre les données envoyées par Jquery (data)
        $cardController->saveCardsAction($_POST);
    }
}