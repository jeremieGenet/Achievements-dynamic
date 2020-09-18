<?php
/*
    TRAITEMENT DE L'ENVOI DU FORMULAIRE DE CONTACT (honeyPot, sécurisation des champs réçus, et envoi du formulaire de contact)
*/
use App\Session;


$session = new Session();

//dd($_SERVER['HTTP_ORIGIN']) = "http://jeremie-genet.ovh"
// PREMIERE COUCHE DU POT DE MIEL
// Vérif que le visiteur vient de bien de notre site ($_SERVER['HTTP_ORIGIN'] permet de voir d'ou vient le visiteur, et s'il ne vient pas de notre site cette superGlobale n'existe pas)
if(isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] == "http://jeremie-genet.ovh"){ // EN PRODUCTION mettre : http://jeremie-genet.ovh  au lieu de /  http://localhost:8000

    // Vérif si le formulaire est envoyé en méthode POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        /* Vérification des champs */
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);
        // Vérif si l'adresse email est à un format valide
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $session->setMessage('flash', 'danger', "L'adresse email n'est pas valide.");
        }

        // DEUXIEME COUCHE DU POT DE MIEL
        // Vérif que le champ "Pot de miel" existe mais qu'il est bien vide (input piège pour les bots)
        if(isset($_POST['raison']) && empty($_POST['raison'])){
    
            // Vérif si tous les champs sont présents et remplis
            if(
                isset($name) && !empty($name) &&
                isset($email) && !empty($email) &&
                isset($subject) && !empty($subject) &&
                isset($message) && !empty($message)
            ){
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                // En-têtes additionnels
                //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>'; // Liste affichée des réceptionnaire du mail
                $headers[] = 'From: Contact Site'.$name.' <'.$email.'>'; // Affichage de l'intitulé du mail (Anniversaire) dans la boite de réception du
                //$headers[] = 'Cc: anniversaire_archive@example.com'; // Boîte de dialogue pour répondre
                //$headers[] = 'Bcc: anniversaire_verif@example.com';

                // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap() (norme CRLF)
                $message = wordwrap($message, 70, "\r\n");

                $messageFormated='
                <html>
                    <body>
                        <div align="center">
                            <hr>
                            <br />'
                            .$message.
                            '<br />
                            <hr>
                        </div>
                    </body>
                </html>
                ';

                //$headers = 'FROM: site@local.dev';
                // Vérif si l'email à bien été envoyé
                // Param1= Destinataire, Param2= sujet du mail, Param3= Contenu du message, Param4= les paramètres du header (mail() retourne 'true' si le mail est parti)
                if(mail('jamyjam82377@gmail.com', $subject, $messageFormated, implode("\r\n", $headers)) === true){
                    $session->setMessage('flash', 'success', "Formulaire bien envoyé !");
                    header('Location: '.$router->url('home'));
                }else{
                    //mail('jamyjam82377@gmail.com', $subject, $messageFormated, $headers);
                    $session->setMessage('flash', 'danger', "Le Formulaire n'a pas été envoyé !!!!");
                    header('Location: '.$router->url('home'));
                }
                

            }else{
                $session->setMessage('flash', 'danger', "Le formulaire n'est pas complet.");
            }
    
        }else{
            $session->setMessage('flash', 'danger', "Tu es un robot, vas t'en !!!");
        }
    
    }else{
        http_response_code(405);
        $session->setMessage('flash', 'danger', "Méthode non autorisée");
    }

}else{
    $session->setMessage('flash', 'danger', "tu es un bot, tu ne viens pas de mon site !");
}
