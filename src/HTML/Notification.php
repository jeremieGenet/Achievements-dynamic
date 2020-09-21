<?php
namespace App\HTML;

// Affiche un message de notification à l'utilisateur
class Notification{

    // Affiche les notifications réçues en param
    public static function toast($messages)
    {
        //dd($this->session);
        //dd($messages); // null || array["success" => "Vous êtes maintenant connecté !"]
        // Affichage de la liste des messages et en '$key' la class bootstrap (success, danger...)
        if(isset($messages)){
            foreach($messages as $key => $message){
                return  
                <<<HTML
                    <div class="alert alert-dismissible alert-{$key}">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{$message}</strong>
                    </div>
HTML;
            }
        }
        

    }

}