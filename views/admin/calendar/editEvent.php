<?php

use App\Session;
use App\Router;
use App\Calendar\Events;
use App\Calendar\EventValidator;


$session = new Session();

$errors = [];

// RECUP DE L'EVENEMENT A MODIFIER (dans le but de l'afficher, et de pré-remplir les champs du formulaire)
$events = new Events();
// On récup l'évènement via son id
$event = $events->find($match['params']['id']);
//dump($event);

// Permettra d'avoir les champs du formulaire pré-remplis (avec les données de l'évènement à modifier)
$data = [
    'name' => $event->getName(),
    'date' =>$event->getStart()->format('Y-m-d'),
    'start' => $event->getStart()->format('H:i'),
    'end' => $event->getEnd()->format('H:i'),
    'description' => $event->getDescription()
];



// Si une méthode (reçue par le serveur) est 'POST' alors...
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['delete'])){
        
        

        // Message Flash
        $session->setMessage('flash', 'success', "Suppression de l'évènement '<strong class='text-info'>{$event->getName()}</strong>' réussie");

        // SUPPRESSION L'EVENEMENT DE LA BDD
        $events->delete($event);

        // REDIRECTION
        header('Location: ' . $router->url('calendar'));
        exit();
    }
    
    // On stock les données postées dans la variable $data
    $data = $_POST; 

    // VALIDATION DES DONNEES (via la class EventValidator())
    $validator = new EventValidator();
    // On passe les infos postées à notre méthode validates() (retournera 'true' ou une $errors si il y en a une)
    $errors = $validator->valid($_POST); // On récup les erreurs produites dans $errors

    // S'il n'y a pas d'erreur (on peut enregistrer les données)...
    if(empty($errors)){
        
        // MODIFICATION DES CHAMPS
        $events->hydrate($event, $data);
        //dump($event);

        // INSERTION DE L'EVENEMENT DANS LA BDD
        $events->update($event);

        // Message Flash
        $session->setMessage('flash', 'success', "Modification de l'évènement '<strong class='text-info'>{$event->getName()}</strong>' réussie");

        // REDIRECTION
        header('Location: ' . $router->url('calendar'));
        exit();
    }

    
}


$title = 'Modifier un évènement';
?>
<div class="container">
<!-- AFFICHAGE DE L'EVENEMENT -->

<div class="container card text-white bg-secondary my-5" style="max-width: 25rem;">
    <div class="card-header text-center">
        <div class="card-title">
            <h2><?= $event->getName(); ?></h2>
        </div>
        
    </div>
    <div class="card-body">
        <h5 class="card-text text-center">
            <?= $event->getDescription(); ?>
        </h5>
        <p class="card-text text-center">
            Crénaux de l'évènement : 
            <?= $event->getStart()->format('H:i') ?> - 
            <?= $event->getEnd()->format('H:i') ?>
        </p>
    </div>
    <div class="card-header text-center">
        <a class="btn btn-info" href="<?= $router->url('calendar', ['id' => $event->getID() ]) ?>">Retour au calendrier</a>
    </div>
</div>

<!-- FORMULAIRE DE MODIFICATION/SUPPRESSION D'UN EVENEMENT -->

    <h1 class="text-center my-5">Formulaire de modification</h1>

    <!-- MESSAGE D'ERREUR GENERIQUE DU FORMULAIRE -->
    <?php if(!empty($errors)): ?>
    <div class="alert alert-warning">
        <p>Merci de corriger vos erreurs</p>
    </div>
    <?php endif;?>

    <!-- FORMULAIRE DE MODIFICATION ET SUPPRESSION D'UN EVENEMENT -->
    <form action="<?= $router->url('editEvent_post', ['id' => $event->getID() ] ) ?>" method="POST" class="form">
        <!-- On inclu la base du formulaire + les variables utiles (pour le pré-remplissage du formulaire) -->
        <?php Router::render('admin/calendar/_form.php', ['data' => $data, 'errors' => $errors]); ?>

        <div class="row">
            <div class="col-sm-6 form-group">
                <button class="btn btn-success">Modifier l'évènement</button>
            </div>
            <div class="col-sm-6 form-group">
                <button type="submit" name="delete" class="btn__right btn btn-danger">Supprimer l'évènement</button>
            </div>
        </div>
    </form>

</div>