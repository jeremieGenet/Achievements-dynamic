<?php
/*
    Affichage du profil de l'utilisateur
*/
use App\Connection;
use App\Table\UserTable;

$id = $params['idUser'];

$pdo = Connection::getPDO();
$userTable = new UserTable($pdo);
$user = $userTable->find($id);

?>
<div class="container">
    <h1 class="text-center p-4">Votre profil</h1>

    <div class="jumbotron">

        <h1 class="display-3">Hello, <?= $user->getUsername() ?>!</h1>
        <hr class="my-4">
        <p class="lead">
            Votre nom d'utilisateur est : <strong class="text-info"><?= $user->getUsername() ?></strong>
        </p>
        <p class="lead">
            Votre adresse email est :<strong class="text-info"><?= $user->getEmail() ?></strong>
        </p>
        <p>
            Vous avez le rôle : <strong class="text-info"><?= $user->getRole() ?></strong>
        </p>
        <hr class="my-4">
        
        <a class="btn btn-primary btn-lg" href="<?= $_SERVER['HTTP_REFERER'] ?>" role="button">Retour</a>

    </div>
</div>