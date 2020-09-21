<?php
namespace App;

use App\Exception\AuthException;
use App\Exception\AuthRoleException;
//use App\Models\Post;

class Auth{

    // Auth::check(['admin', 'user'])
    // PERMISSION QUI Vérifie si l'utilisateur est connecté (s'il n'y est pas envoie d'une exception)
    public static function check($role="")
    {
        // Si le statut de session est null (session_start() non actif) alors on démarre la session
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        
        // Si personne n'est connecté...
        // S'il n'y a pas dans "$_SESSION" un 'user' ("user" est inclu dans $_SESSION dans la page login.php lors de la connexion)
        if(!isset($_SESSION['user'])){
            throw new AuthException('L\'utilisateur doit être connecté !', 401); // (on jette une Exception) => Exception récupérée et gérée dans la classe Router (Router.php)
        }
        // Condition Si le rôle est défini (pas vide) et qu'il est différent du param alors...
        if($role !== ""){
            //dd($_SESSION['user']['role']);
            if( $_SESSION['user']['role'] !== $role ){
                throw new AuthRoleException("Le rôle de l'utilisateur ne permet pas cette action !", 403); // (on jette une Exception) => Exception récupérée et gérée dans la classe Router (Router.php)
            }
        } 
    }

    // PERMISSION QUI Vérif que ceui qui va modifié un post est soit 'admin' soit l'auteur du post
    // Param1= Post (objet) qui va être modifié, Param2= url de redirection (altorouter), Param3= message d'erreur si le post ne doit pas être modifié
    public static function permissionUpdatePost(object $post, string $redirection, string $messageError){

        // PERMISSION: Si l'utilisateur n'est pas 'admin' et n'est pas l'auteur du post alors... (redirection, et message erreur)
        // Si l'utilisateur n'a pas le rôle 'admin'...
        if($_SESSION['user']['role'] !== "admin"){
            // Vérif si l'id de l'auteur du post est le même que l'id de l'utilisateur en cours (session)
            if($post->getAuthor_id() !== $_SESSION['user']['id']){
                // Param du message flash de SESSION, puis redirection
                $session = new Session();
                $session->setMessage('flash', 'danger', $messageError);
                header('Location: ' . $redirection);
                exit();
            }
        }

    }

}