<?php

/* 
* Page Index
* Page principale de l'application
* 1. on inclut le header
* 2. on y définit notre routeur
* 3. on inclut le footer
*/

// ***** HEAD *****
include 'src/inc/head.php';

//  ***** MINI-ROUTER *****
// comme c'est un petit projet, on s'assure uniquement d'être sur la bonne page sinon page40
$page = strtolower($_SERVER['REQUEST_URI']);
$page = explode('/', $page);

// on va rester sur la même page pour cette application
if (empty($page[2])) { // on affiche la page du jeu
    require 'src/template/gameBoard.php';
}
else { //erreur on affiche 404
    require 'src/template/erreur404.php';    
}

// ***** FOOTER *****
include 'src/inc/footer.php'
?>