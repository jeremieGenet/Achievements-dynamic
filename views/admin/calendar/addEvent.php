<?php

use App\Router;
use App\Session;
use App\Calendar\Event;
use App\Calendar\Events;
use App\Calendar\EventValidator;


$session = new Session();

// On donne à notre tableau de donnée la date du jour J (dans le but de pré-remplir l'attribut de l'input date dans le formulaire)
$data = [
    // Date du jour ou null
    'date' =>date('Y-m-d') ?? null
];
// Récup de la date de l'évenement via l'url (pour la passer à la value de l'input date du formulaire de création d'un event)
$dayEvent = $params['dayEvent'] ?? null;

$errors = [];

// Si une méthode (reçue par le serveur) est 'POST' alors...
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = $_POST; // données postées

    // VALIDATION DES DONNEES (via la class EventValidator())
    $validator = new EventValidator();
    // On passe les infos postées à notre méthode validates() (retournera 'true' ou une $errors si il y en a une)
    $errors = $validator->valid($_POST); // On récup les erreurs produites dans $errors

    //dump($errors);
    //dump($validator);
    //dump($validator->validates($_POST));
    //dump($errors['name']);
    
    // S'il n'y a pas d'erreur (on peut enregistrer les données)...
    if(empty($errors)){
        // INITIALISATION DES CHAMPS
        $events = new Events(); 
        $event = $events->hydrate(new Event(), $data);

        // INSERTION DE L'EVENEMENT DANS LA BDD
        $events->create($event);

        // Message Flash
        $session->setMessage('flash', 'success', "Ajout de l'évènement '<strong class='text-info'>{$event->getName()}</strong>' réussi!");

        // REDIRECTION
        header('Location: ' . $router->url('calendar'));
        exit();
    }
    
}

$title = 'Ajouter un évènement';
?>

<div class="container">
    <h1 class="my-4">Ajouter un évènement</h1>

    <!-- MESSAGE D'ERREUR -->
    <?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        <p>Merci de corriger vos erreurs</p>
    </div>
    <?php endif;?>

    <!-- FORMULAIRE DE CREATION D'UN EVENEMENT -->
    <form action="<?= $router->url('addEvent_post') ?>" method="POST" class="form">
        
        <!-- On inclu la base du formulaire + les variables utiles -->
        <?php Router::render('admin/calendar/_form.php', [
            'data' => $data, 
            'errors' => $errors, 
            'dayEvent' => $dayEvent]); 
        ?>

        <div class="row">
            <div class="col-sm-6 form-group">
                <button class="btn btn-success">Ajouter l'évènement</button>
            </div>
            <div class="col-sm-6 form-group">
                <a class="btn__right btn btn-info" href="<?= $router->url('calendar') ?>">Retour au calendrier</a>
            </div>
        </div>
    </form>

    
</div>