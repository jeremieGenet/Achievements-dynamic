<?php
namespace App;

use PDO;

// Retourne une connexion à la bdd (une instance)
class Connection{
    
    private static $instance = null; // Design Patern SINGLETON
    

    public static function getPDO(?string $env="local"): ?PDO
    {
        // self::$instance = new PDO('mysql:host=localhost;dbname=portfolio2', 'root', '',[
        if(self::$instance === null){
            //self::$instance = new PDO('mysql:host=localhost;dbname=portfolio2', 'root', '',[
            self::$instance = new PDO(
                    "mysql:host={$_ENV[$env]['host']};
                    dbname={$_ENV[$env]['dbname']}", 
                    $_ENV[$env]['username'], 
                    $_ENV[$env]['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        }
        return self::$instance;
        
    }

}
