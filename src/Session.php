<?php
namespace App;

// Permet de gérer la session ($_SESSION) les messages flashes, l'enregistrement de nouvelles infos dans la session...
class Session{

    public function __construct()
    {
        // Si le statut de session est null (session_start() non actif) alors on démarre la session
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }


    // Permet de créé un message flash qui sera stocké dans la session globlal ($_SESSION)
    public function setFlash($key, $message){
        $_SESSION['flash'][$key] = $message;
    }

    // Permet de déterminer si il y a ou non des messages flash (true s'il y en a, false si il n'y en a pas)
    public function hasFlashes():bool {
        if(isset($_SESSION['flash'])){
            return true;
        }else{
            return false;
        }
    }

    // Permet de renvoyer tous les messages flash (et sa suppression du flash de la session, après son affichage)
    public function getFlashes($key){
        if(isset($_SESSION[$key])){
            $flash = $_SESSION[$key];
            unset($_SESSION[$key]); // on supprime le flash de la session (pour que son affichage disparaisse dès rafraichissement de la page)
            return $flash;
        }
        
    }

    // Permet d'écrire des informations dans la session (sous forme de tableau associatif clé => valeur)
    public function write($key, $value){
        $_SESSION[$key] = $value;
    }

    // Permet d'écrire des informations dans la session (sous forme de tableau associatif clé => valeur)
    public function writeForUser($key, $value){
        $_SESSION['user'][$key] = $value;
    }

    // Permet de lire les informations de la session
    public function read($key){
        // Si il y a bien une session alors...
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return null;
        }
    }

    // Permet de supprimer les informations de la session
    public function delete($key):void {
        // On supprime de la session
        unset($_SESSION[$key]);
    }

}