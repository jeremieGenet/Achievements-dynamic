<?php
namespace App\Helpers;

class Text{

    // Permet de limiter une chaîne de caractère en fonction de $limit (et de ne pas couper le dernier mot)
    public static function excerpt(string $content, int $limit = 50)
    {
        // mb_strlen() retourne la taille d'une chaîne de caractères
        if(mb_strlen($content) <= $limit){
            return $content;
        }
        // On défini ou se trouve le dernier espace à partir de "$limit" (pour ne pas coupé dernier mot à la limite défini)
        $lastSpace = mb_strpos($content, ' ', $limit);
        // "subst" retourne un segment de chaîne de caractère (ici entre 0 et le dernier espace à partir de "$limit")
        return mb_substr($content, 0, $lastSpace) . '...';
    }

}