<?php
namespace App\Helpers;

use Exception;

class URL{

    // Permet de vérif si le param d'url est bien un entier
    public static function getInt(string $name, ?int $default = null): ?int
    {
        // S'il n'y a pas de param d'url, on retourne null (param par défaut)
        if(!isset($_GET[$name])) return $default;
        // Si le param d'url vaut 0 (sous forme de chaîne de caractère) on retourne 0
        if($_GET[$name] === '0') return 0;
        // Si le param d'url n'est pas un entier on renvoi une exception
        if(!filter_var($_GET[$name], FILTER_VALIDATE_INT)){
            throw new Exception("Le paramètre d'url : $name, n'est pas un entier!!!");
        }
        return (int)$_GET[$name]; // Sinon on retourne le param d'url
    }

    // Permet de vérif si la param d'url est bien un entier Positif
    public static function getPositiveInt(string $name, ?int $default = null): ?int
    {
        $paramUrl = self::getInt($name, $default);
        if($paramUrl !== null && $paramUrl <= 0){
            throw new Exception("Le paramètre d'url : $name, n'est pas un entier Positif!!!");
        }
        return $paramUrl;
    }

}