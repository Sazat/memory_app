<?php
/**
 * Class Database
 * Permet d'obtenir une connexion à la base de données.
 * Utilisation de l'extension PDO (PHP Data Object) : nous permet d’accéder à la base de données 
 * depuis PHP. Cette extension est fournie avec PHP.
 */
class Database {
     // propriété $pdo sera une instance de class PDO
     public ?\PDO $pdo = null;

     /**
      * getConnection
      * fonction de connexion à la base de données locale sous WAMP
      */
     protected function getConnection() :\PDO {

          // Pour se connecter à la base de données, on a besoin :
          // de l'hôte
          // du nom de la base de données
          // du nom d'utilisateur
          // du mot de passe lié à l'utilisateur
          // de l'encodage
          // A NOTER : nous travaillons en local et j'utilise donc l'utilisateur root.
          // MAIS il est d'usage de créer un utilisateur en base de données, avec un mot de passe sécurisé
          // cet utilisateur aura tous les droits uniquement dans la base de données "memory" par exemple.
          // contrairement à root, qui peut aller faire ce qu'il veut car c'est un super-user
          //(il a tous les droits, partout, par défaut.)

          $host = 'localhost:3306'; // changer le port (3306) en fonction de votre AMP
          $db   = 'memory'; //mettre le nom de votre base de données
          $user = 'root'; //mettre l'utilisateur, en local, je mets 'root'
          $pass = ''; // mettre le mot de passe, en local, sur Wamp, pas de mot de passe (sur MAMP, mot de passe = 'root')
          $charset = 'utf8mb4';
          
          $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
          // Activation des options (des constants)
          // https://www.php.net/manual/fr/pdo.constants.php
          // format des options "ATTRIBUT" => "MODE"
          $options = [
              PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // gestion des erreurs : https://www.php.net/manual/fr/pdo.error-handling.php
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_EMULATE_PREPARES   => false,
          ];
          
          // si la propriété est null
          if($this->pdo == null) {
               try {
                    $pdo = new PDO($dsn, $user, $pass, $options);
               } catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
               }
          }
          return $pdo;
     }
}

?>