<?php
/*
    PAGE D'INSCRIPTION D'UN NOUVEAU USER (Création de compte)
*/

use App\Session;
use App\HTML\Form;
use App\Connection;
use App\Models\User;
use App\Table\UserTable;
use App\Validators\UserValidator;

$pdo = Connection::getPDO();
$session = new Session();
$userTable = new UserTable($pdo);
$user = new User();
$errors = [];


if(!empty($_POST)){

    $data = $_POST;
    $user->setUsername($_POST['username']); // Pour que le champs username reste rempli même si il y a une erreur
    
    $validate = new UserValidator($data);

    $errors = $validate->fieldEmpty(['username', 'password', 'email']);
    $errors = $validate->fieldLength(['username'], 2, 20); // entre 2 et 20 caractères minimum pour le mot de passe
    $errors = $validate->fieldLength(['password'], 4, 30); // entre 4 et 30 caractères minimum pour le mot de passe
    $errors = $validate->samePassword($_POST['password'], $_POST['passwordConfirm']); // Vérif si le password et le passwordConfirm sont les mêmes
    $errors = $validate->passwordVulnerability($_POST['password']); // Permet de Sécurisé le mot de passe (param 2 à null par défaut, mais peu $être : 'max', "middle", "mini")

    if(empty($errors)){
        // Ajout des données (dans l'objet 'user')
        $user->setUsername(htmlentities($_POST['username']));
        $user->setEmail(htmlentities($_POST['email']));
        $user->setPassword(password_hash(($_POST['password']), PASSWORD_BCRYPT));
        $user->setRole('user');

        // ENREGISTREMENT DES DONNEES DANS LA BDD
        $userTable->insert($user);
        
        
        // REDIRECTION ET MESSAGE FEEDBACK UTILISATEUR
        $session->setMessage('flash', 'success', "Vous êtes maintenant enregistrer, connectez vous !");
        header('Location: ' . $router->url('login'));
    }
    
}

$form = new Form($user, $errors);
?> 


<div class="container">

    <h1>S'inscrire</h1>

    <!-- FORMULAIRE -->
    <form action="" method="POST">
    
        <?= $form->input('text', 'username', 'Nom d\'utilisateur'); ?>
        <?= $form->input('email', 'email', 'Email'); ?>
        <?= $form->input('password', 'password', 'password'); ?>
        <?= $form->inputPasswordConfirm('passwordConfirm', 'Confirmation de mot de passe'); ?>
        
        <button type="submit" class="btn btn-success">S'enregister</button>
        
    </form>

</div>

