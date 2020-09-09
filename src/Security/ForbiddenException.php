<?php
/*
    Classe qui gére les exceptions liées à la sécurité
        On pourrait stocker par exemple ici les url qu'un utilisateur non autorisé a tenté d'atteindre
*/
namespace App\Security;

use Exception;


class ForbiddenException extends Exception{

    

}