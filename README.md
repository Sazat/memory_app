# Projet Full Stack - Jeu de Mémoire - Memory

## Spécifications
Le but est de créer le jeu Memory.
### Fonctionnalités
  - Au commencement du jeu, des cartes sont disposées face cachée à l'écran.
  - Le joueur doit cliquer sur deux cartes. Si celles-ci sont identiques, la paire est validée. Sinon, les cartes sont retournées face cachée, et le joueur doit sélectionner une nouvelle paire de cartes.
  - Une compteur de temps, avec une barre de progression, s’affiche en dessous du plateau.
  - Le joueur gagne s'il arrive à découvrir toutes les paires avant la fin du temps imparti.
  - Chaque temps de partie effectuée doit être sauvegardée en base de données.
    Avant le début du jeu, les meilleurs temps s’affichent à l’écran.

### Résultat attendu
  - Créer le jeu en HTML / CSS / JS.
    La répartition des fruits doit être aléatoire à chaque jeu.
    précisions CSS : SASS ou autre préprocesseur encouragé.
    précisions JS : L’utilisation d’une librairie (au hasard, jQuery) est acceptée, pour faciliter la gestion d'événements et les modifications du DOM.
  - Faire la persistance des données côté back : PHP ou Node.js
    Ton application doit être codée en objet.
  - Cartes à jouer
  https://static.oclock.io/challenges/tests-techniques/cards.png
  - Charte graphique
  Pas de charte graphique imposée. Tu peux partir du design des exemples ci-dessus, ou improviser si tu sens l’inspiration pointer le bout de son nez. Quoi qu’il en  soit, le code CSS doit être compréhensible et abordable.

## Prérequis

### installation Sass
- installation NodeJS https://nodejs.org/en/
- vérifier les versions de NodeJs et npm
- Version NodeJS de ce projet : v16.14.0
- Version npm : 8.5.4
- Installation de Sass sur votre machine
```bash
npm -g install sass
````
- Le fichier package.json est fourni dans le projet : modifier si nécessaire si vous ne reproduisez pas la même structure de dossiers
- Pour modifier et surveiller les changements, mettre dans le package.sjon sous scripts.sass:
```bash
sass --watch ./src/public/sass/main.scss:./src/public/css/style.css
````
- puis 
```bash
npm run sass
````
- pour compiler mettre dans le package.sjon sous scripts.sass
```bash
sass --watch ./public/sass/main.scss:./public/css/style.css --style compressed
````
- Ne pas oublier d'interrompre le script après un changement (ctrl + C) avant relancer un "npm run sass"

### Front-end
- HTML5 et SCSS
- Utilisation de JQuery
- Le fichier script.js contient toutes les fonctions qui servent à créer le jeu et le gérer

### Back-end
- utilisation de WAMP
- Base de données PHPMySQL
- Version PHP : 7.4.26
- Version PHPMySQL : 5.1.1
- Version du serveur : 5.7.36
- Un fichier memory.sql se trouve à la racine du projet, utilisez-le pour créer la base de données et des tables avec quelques données

Le code est orienté objet et permet d'enregistrer une partie (Game) ainsi que les cartes liées à cette partie en base de données
Une mini-architecture MVC a été mise en place
Les fichiers dans Model sont chargés de requêter en base de données
Les fichiers dans Controller appellent les fichiers Model et leur méthode, selon les besoins.

Tout le code est commenté.

## Concepts abordés
- SCSS/CSS : structurer son code
- JS/JQuery
  - manipulation d'objets
  - Ajax
- PHPMySQL
  - include, require, notion de routeur  
  - création de class
  - fonction hydrate
  - getters et setters
  - héritage
  - instanciation d'objets
  - connexion à une base de données avec l'extension PDO
  - insertion d'entrées
  - récupération de données
