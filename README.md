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
    Choisis le langage qui te permettra le mieux de répondre à l’exercice.
    Ton application doit être codée en objet .  
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
