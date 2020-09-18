<?php
/*
    PAGE QUI GERE LES URLS qui n'existent pas (non définis dans la page index.php)
    (Voir Router.php)
*/

// On signifie aux navigateurs que cette page est une redirection de type 404 (permet aux navigateur de ne pas indexer cette page)
//http_response_code(404);

//$message = $params['message']; // id du post en cours de modification
$code = $params['codeError'];
$message="";
$description="";
//dd($message);
if($code === 400){
    $message = 'Bad Request';
    $description = 'La syntaxe de la requête est erronée.';
}

switch($code){
    case 400 : 
        $message = 'Bad Request';
        $description = 'La syntaxe de la requête est erronée.';
    break;
    case 401 :
        $message = 'Unauthorized';
        $description = 'Une authentification est nécessaire pour accéder à cette ressource.';
    break;
    case 403 :
        $message = 'Forbidden';
        $description = 'Droits d\'accès refusés pour cette ressource.';
    break;
    case 404 :
        $message = 'Not Found';
        $description = 'Ressource non trouvée.';
    break;
    default : 
        $message = 'Not Found';
        $description = 'Ressource non trouvée. Cette page n\'existe pas.';
        //throw new \Exception ("La page n'existe pas.");
}


?>


<div class="container">

    <h1 class="text-center p-4"><strong>Page introuvable</strong> => erreur <?=$code?></h1>
    <p class="text-center"><strong><?= $message ?></strong></p>
    <p class="text-center"><strong><?= $description ?></strong></p>
    

</div>

