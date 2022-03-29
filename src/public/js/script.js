// Définition des constantes du jeu

// Cartes
const NB_IMAGES_AVAILABLE = 18; // nombre de fruits sur l'image fournie
const NB_CARDS = 28;
const NB_PAIRS_TO_FIND = NB_CARDS /2;

// Plateau
const NB_BOARD_ROWS = 4;
const NB_BOARD_COLS = 7;

//TEMPS
const GAME_MAX_DURATION_MIN = 2; // Durée du jeu - à modifier selon les besoins
const GAME_MAX_DURATION_MS = GAME_MAX_DURATION_MIN * 60* 1000; // Durée du jeu en millisecondes

// MESSAGES AU JOUEUR
const MESSAGE_LOSER = 'Tu as perdu :(';
const MESSAGE_WINNER = 'GG ! Tu as gagné :) !';

// Déclaration et initialisation des variables globales
let is_board_created = false;

/*board_table est un tableau qui va contenir nos cartes
* chaque élément du tableau sera une carte
* d'après la classe PHP Card, 
*   - une carte a une propriété qui désigne sa place dans l'image fournie cards.png
*   - une carte a une propriété qui désigne sa place sur le plateau (table) de jeu
*   - une carte a une propriété isMatched booléenne qui permet de savoir si la paire de cette carte a été trouvée
* board_table sera donc rempli avec des objets JS qui représenteront une carte comme ceci :
* exemple : let card = {indexSprite : 4, isMatched: false}
*/
let board_table = new Array();
let flipped_cards_table = [null, null]; // ce tableau nous servira lors de la comparaison de deux cartes
let nb_of_found_pairs = 0; // compteur de paires trouvées

// Temps qui sera un Date.now() donc en ms
// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Date/now
let time_start_game = 0;

let timer_if_pair_error = 0;

// variables pour le compteur de temps
let timer = 0;

/*
*************** POLYFILL ***************
*/
/* Polyfill date.now
* Source : https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Date/now#proth%C3%A8se_d%C3%A9mulation_polyfill
*/
if (!Date.now) {
    Date.now = function now() {
      return new Date().getTime();
    };
}

/* Polyfill Math.trunc
* sources : 
* https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/trunc#browser_compatibility
* https://github.com/behnammodi/polyfill/blob/master/math.polyfill.js
*/
if (!Math.trunc) {
    Math.trunc = function (n) {
      return n < 0 ? Math.ceil(n) : Math.floor(n);
    };
}

// une fois que le DOM est prêt, on lance nos premières fonctions
$(document).ready(function(){
    //on récupère les meilleurs temps pour les afficher
    getBestScores();
    //on attache un gestionnaire d'évènements pour l'évènement "click" sur le bouton "go"
    $('.go-play').on('click', function() {
        //on montre la partie jeu
        $('#game').css('display', 'block');
        //on cache la première partie
        $('#homepage').css('display', 'none');
        //on appelle la fonction de construction de plateau de jeu
        buildBoard();
        // on attache un gestionnaire d'évènements pour l'évènement mouseup sur les cartes
        $('[idx]').on('mouseup', function(event) {
            //lorsque la souris est relâchée, on appelle la fonction flipCard
            flipCard(event, this);
        })
    });
})


/*
*************** FONCTIONS DU JEU ***************
*/

/**
* Fonction getRandomInteger
* Renvoie un entier choisi aléatoirement entre
* une borne minimum et une borne maximum
* @param {int} max, Borne Maximum
* @return {int} valeur aléatoire
*/
function getRandomInteger(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

/**
* Fonction setCards
* Remplit la variable board_table avec des objets représentant les cartes du jeu
*/
function setCards() { 
    // on vide le tableau
    board_table = [];
    // ici on définit le nombre d'éléments du tableau
    // à chaque indice du tableau on aura une valeur "undefined"
    board_table.length = NB_CARDS;
    
    let firstCardSpriteIndex;
    let secondCardBoardIndex;

    for (let index = 0; index < NB_CARDS; index++) {
        if(board_table[index] == undefined) {
            while(true) {
                // on sélectionne aléatoirement un entier qui représente l'indice de la carte dans le sprite
                firstCardSpriteIndex = getRandomInteger(NB_IMAGES_AVAILABLE);
                
                // on vérifie si cette carte a déjà été sélectionnée
                if(checkIfSpriteIndexAlreadyChose(firstCardSpriteIndex)){
                    //indice de carte déjà sélectionné
                    continue;
                }
                //on sort de la boucle while si l'indice n'est pas encore entré dans le tableau
                break;
            }
            //on crée un objet carte avec l'index de sprite tiré au sort
            let card = {indexSprite : firstCardSpriteIndex, isMatched : false };
            // on place la carte dans le tableau
            board_table[index] = card;

            //il faut maintenant placer son "double" car on doit trouver des paires
            while(true) {
                // cette fois, on choisit aléatoire un entier qui représentera l'indice dans le plateau
                secondCardBoardIndex = getRandomInteger(NB_CARDS);
                // on vérifie que le tableau ne contient pas déjà un objet à cet indice
                if(board_table[secondCardBoardIndex] !=undefined) {
                    continue;
                }
                break;
            }
            // on place une nouvelle fois la carte card dans le tableau board_table, à l'indice nouvellement choisi
            board_table[secondCardBoardIndex] = card;
        }
    }
}

/**
* Fonction checkIfSpriteIndexAlreadyChose
* Vérifie que l'indice de sprite choisit aléatoirement
* n'a pas déjà été sélectionné
* @param {number} entier qui représente un indice du sprite
* @return {boolean} true si index déjà choisi, sinon false
*/
function checkIfSpriteIndexAlreadyChose(randomIndex) {
    let found = false;
    board_table.forEach(card => {
        if(card != undefined && card.indexSprite == randomIndex) {
            found = true;
        }
    });
    return found;
}

/**
* Fonction buildBoard
* Construit le plateau du jeu dans le DOM
*/
function buildBoard(){
    // on sélectionne l'élément du DOM qui va contenir notre plateau de jeu
    let elementBoard = $('.board');
    //on le "vide" si partie précédente a eu lieu
    elementBoard.html('');
    setCards();
   
    for (let i = 0; i < NB_BOARD_ROWS; i++) {
        elementBoard.append('<div class="row-cards"></div>');
        let rowCards = $('.row-cards');
        for (let j = 0; j < NB_BOARD_COLS; j++) {
            let classCard = (j + (NB_BOARD_COLS * i));
            $(rowCards[i]).append('<div class="col-cards" idx=' + classCard + '></div>');
        }
    }
}

/**
 * Fonction flipCard
 * Fonction appelée quand on clique sur une carte pour la retourner
 * @param event événement du mouseup
 * @param element element cliqué, c'est-à-dire une carte du tableau
 */
function flipCard(event, element){
    //on se prémunit du comportement par défaut du mouseup
    event.preventDefault();
    
    // on récupère l'indice de l'élément (carte) cliqué
    let indexBoard= parseInt($(element).attr('idx'));
    // on crée une variable pour y mettre l'objet (une carte) qui à cet indice dans board_table
    let clickedCard = board_table[indexBoard];
    // on crée une variable pour enregistrer l'incide de sprite de la carte
    let cardIndexSprite = clickedCard.indexSprite;
 
    let position = calculatePositionSprite();
        
    // Affichage de la carte en déplaçant la position de l'image de background (sprite)
    element.style.backgroundPosition = 'center -' + (cardIndexSprite * position) + 'px';
    // Mise en place d'une classe permettant de bloquer les événements sur cet element
    $(element).addClass('flipped');
    
    if(flipped_cards_table[0] == null ){ // si flipped_cards_table[0] == null
        flipped_cards_table[0] = element; // alors c'est la première carte retournée
    } else {
        flipped_cards_table[1] = element; // sinon c'est la deuxième
        
        /* comparaison des deux cartes
        * on va récupérer la première carte retournée
        * car nous sommes dans le "else" donc cardIndexSprite représente le numéro de carte de la deuxième carte retournée
        */
        let elementClickedFirst = flipped_cards_table[0];
        let indexBoardClickedFirst = parseInt($(elementClickedFirst).attr('idx'));
        let cardClickedFirst = board_table[indexBoardClickedFirst];
        
        if(cardIndexSprite == cardClickedFirst.indexSprite) {
            //carte identique
            nb_of_found_pairs++;

            // on met à jour board_game en indiquant true à isMatched sur les cartes concernées
            cardClickedFirst.isMatched = true;
            clickedCard.isMatched = true;
        
            if(nb_of_found_pairs == NB_PAIRS_TO_FIND) {
                //  Youpi !
                //on affiche le message au gagnant
                $('#message-player').html('<p class="winner">' + MESSAGE_WINNER + '</p>');
                // on vide l'élément du DOM
                $('#time-play').html('<p>00:00</p>');
                clearInterval(timer);
                // on calcule le temps du joueur (en ms)
                let playerTime = Date.now() - time_start_game;
                // on enregistre la partie
                registerGame(playerTime);
            }
            //on réinitialise le tableau des cartes retournées
            flipped_cards_table = [null, null];
        } else {
            // on bloque les interactions sur le tableau
            blockBoard(true);
            // il y a erreur, on lance avec un setTimeout, la fonction hasPairError après un seconde pour laisser le temps au joueur de voir les cartes
            timer_if_pair_error = setTimeout(hasPairError,1000);
        }
    } 

    if (time_start_game == 0) {
        // timer lancé dès que la première carte est retournée
        time_start_game = Date.now();
        // Lancement du temps de jeu (minuterie), toutes les 1s
        timer = setInterval(function(){getTimer()},1000);
    }
}

/**
 * calculatePositionSprite
 * function qui calcule la position du fruit sur le sprite
 * en fonction de la taille de l'écran, l'image est réduite
 * la position change donc en conséquence
 * @returns {int} pixels
 */
function calculatePositionSprite() {
    if(window.innerWidth <=490 ) {
        //mobile device
        return 25;
    } else if(window.innerWidth <=768) {
        return 50;
    } else return 100;
}

/**
* Fonction blockBoard
* Fonction appelée pour empêcher les clics sur les cartes
* dès que deux cartes sont sélectionnées
*
* @param {boolean} true si le plateau est non cliquable, false sinon
*/
function blockBoard(blocked){
    if(blocked) {
        $('.board').addClass('blocked');
    } else {
        $('.board').removeClass('blocked');
    }
}

/**
* Fonction hasPairError
* Fonction appelée pour modifier le DOM
* Quand les deux cartes cliquées ne sont pas identiques
* on les retourne, dos de carte face au joueur
*/
function hasPairError(){
    // on stoppe le timer
    if(timer_if_pair_error !=0) {
        clearTimeout(timer_if_pair_error);
        timer_if_pair_error = 0;
    }
    // on retourne les cartes - dos face au joueur
    flipped_cards_table.forEach(card => {
        $(card).css('background-position', '');
        $(card).removeClass('flipped');
    });
    //on débloque le plateau
    blockBoard(false);
    // on ré initialise le tableau flipped_cards_table pour le prochain tour
    flipped_cards_table = [null, null];
}

/**
 * Fonction getTimer
 * Lance le compteur de temps
 */
function getTimer(){
    play_time = Date.now();
    let diff = play_time - time_start_game;
    let minute = Math.floor((diff/1000/60/60)*60);
    let seconds = Math.floor(((diff/1000/60/60 )*60 - minute)*60);

    let formatedMinute = (minute < 10) ? '0'+minute : minute;
    let formatedSeconds =  (seconds < 10) ? '0'+seconds : seconds;
    $('#time-play').html('<p>'+formatedMinute + ':' + formatedSeconds + '</p>');

    if(diff >= GAME_MAX_DURATION_MS) {
        // Snif ! Game over
        if(timer_if_pair_error !=0) {
            clearTimeout(timer_if_pair_error);
        }
        clearInterval(timer);
        blockBoard(true);
        //on affiche le message au perdant
        $('#message-player').html('<p class="loser">' + MESSAGE_LOSER + '</p>');
        registerGame(GAME_MAX_DURATION_MS);
    }
    gameProgressBar(diff);
}

/**
 * Fonction gameProgressBar
 * Gère la barre de progression du jeu
 * @param {int} diff : temps de jeu du joueur (différence entre le temps de début de jeu et maintenant)
 */
function gameProgressBar(diff){
    if(diff < GAME_MAX_DURATION_MS) {        
        let percent = Math.trunc((diff * 100) / GAME_MAX_DURATION_MS);
        let getPercent = (percent / 100);
        // ajustement du pourcentage pour la fin du jeu
        // car il y a des petits décalages parfois
        getPercent = getPercent == 0.99 ? 1 : getPercent;
        let getProgressWrapWidth = $('.progress-wrap').width();        
        // calcul de la position de la barre de progression
        let progressTotal = getPercent * getProgressWrapWidth;
        let animationLength = 2500;
        
        // .stop() pour éviter la "file d'attente" sur l'élément
        // on modifie la position horizontale de l'élément DOM (propriété left) 
        $('.progress-bar').stop().animate({
            left: progressTotal
        }, animationLength);
    } 
}



function transformIntervalInString(interval) {
    let minute = Math.floor((interval/1000/60/60)*60);
    let seconds = Math.floor(((interval/1000/60/60 )*60 - minute)*60);
    return minute + ' minute ' + seconds + ' secondes';
}
/*
*************** REQUETES ***************
* On utilise JQuery : on peut donc faire une requête Ajax
*/
 
/**
* Fonction de récupération des meilleurs temps en base de données
* Utilisation JQuery.ajax() https://api.jquery.com/jquery.ajax/
*/
function getBestScores(){
    $.ajax({
        method: "GET",
        url: "http://localhost/jeu_memory/src/api/api.php",
        data : { action : 'getBestScores', max_duration_game : GAME_MAX_DURATION_MS},
        dataType : "JSON",
        success: function(response) {    
            displayScoresList(response);
        }
    })
}

/*
*************** AFFICHER LISTE SCORES
*/
function displayScoresList(gameData){
    // on sélectionne la liste ul dans le DOM
    let ulScore = $('#list-scores');
    if(gameData.length == 0) {
        ulScore.css('display', 'none');
        $('#list').html('<p>Pas de résultats à afficher! A toi de jouer !</p>');
    } else {
        gameData.forEach((score, index) => {
            let stringTime = transformIntervalInString(score.play_time);
            let contentLi = '<li class="score"><span class="rank">#' + (index + 1) + '</span> ' + stringTime +'</li>';
            ulScore.append(contentLi);
        });
    }
}

/*
*************** ENREGISTRER PARTIE 
*/

function registerGame(playTime){
 
    let idGame = null;
    // on doit enregistrer plusieurs objets
    // un objet Game
    // des objets Cards (on a besoin de l'id Game)
    let errorMessage = '';
    $.ajax({
        method: "POST",
        url: "http://localhost/jeu_memory/src/api/api.php",
        data: { action : 'addGame', playTimeData : playTime, numberOfPairsFound : nb_of_found_pairs },
        dataType : "JSON",
        error: function(error) {
            errorMessage = 'impossible d\'enregistrer la partie';
            $('#error-message').html('<p>' + errorMessage + '</p>')
        },
        success : function(response) {
            idGame = response.idGame;
            $.ajax({
                method: "POST",
                url: "http://localhost/jeu_memory/src/api/api.php",
                data: { action : 'addCards', idGame : idGame, cards : board_table},
                dataType : "JSON"
            })
        }
      })
}


