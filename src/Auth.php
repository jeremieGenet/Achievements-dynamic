<?php
namespace App;

use App\Security\ForbiddenException;
use App\Security\OnlyAdminException;

class Auth{

    // Auth::check(['admin', 'user'])
    // Vérifie si l'utilisateur est connecté (s'il n'y est pas envoie d'une exception)
    public static function check($role="")
    {
        
        // Si le statut de session est null (session_start() non actif) alors on démarre la session
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        
        // Si personne n'est connecté...
        // S'il n'y a pas dans "$_SESSION" un 'user' ("user" est inclu dans $_SESSION dans la page login.php lors de la connexion)
        if(!isset($_SESSION['user'])){
            throw new ForbiddenException(); // (on jette une Exception) => Exception récupérér et gérée dans la classe Router (Router.php)
        }
        

        // Condition Si le rôle est défini (pas vide) et qu'il est différent du param alors...
        if($role !== ""){
            //dd($_SESSION['user']['role']);
            if( $_SESSION['user']['role'] !== $role ){
                throw new OnlyAdminException(); // (on jette une Exception) => Exception récupérér et gérée dans la classe Router (Router.php)
            }

        }
        
        
        
        
        

        
    }

}