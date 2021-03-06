<?php
/*
    PAGE DE CONNEXION
        => Rédirection vers cette page si on est pas connecté (et que l'on veut accéder à une page qui posséde Auth::check())
*/

use App\Session;
use App\HTML\Form;
use App\Connection;
use App\Models\User;
use App\Table\UserTable;
use App\HTML\Notification;


$session = new Session();
$messages = $session->getMessage('flash');

$user = new User();
$errors = [];

if(!empty($_POST)){
    $user->setEmail($_POST['email']); // pour que le nom de l'utilisateur reste en cas d'erreurs

    // Si les champs email et password ne sont pas vide (différents de vide)
    if(!empty($_POST['email']) || !empty($_POST['password'])){
        $pdo = Connection::getPDO();
        $userTable = new UserTable($pdo);
        // Récup de l'utilisateur ("$u") via son email
        $u = $userTable->findByEmail($_POST['email']);
        // Si l'adresse email n'existe pas dans la bdd...
        if($u === false){
            $session->setMessage('flash', 'danger', "Adresse email invalide !!!");
            header('Location: ' . $router->url('login')); // Redirection
            exit();
        }
        
        // Si le password posté est le même que celui dans la bdd (retournera true si c'est le cas, sinon false)...
        if(password_verify($_POST['password'], $u->getPassword()) === true){

            // ON PARAM LA SESSION (1 Message flash + l'id, le nom et le role de l'utilisateur stockés)
            $session->setMessage('flash', 'success', "Vous êtes maintenant connecté !");
            $session->writeForUser('id', $u->getId());
            $session->writeForUser('username', $u->getUsername());
            $session->writeForUser('role', $u->getRole());


            header('Location: ' . $router->url('admin_home')); // Redirection
            exit(); // On stop le script après la redirection

        }else{

            $errors['password'] = 'Identifiant ou mot de passe incorrect !!!'; // si le test vaut false alors erreur
        }
        
        
    }
    
}
$form = new Form($user, $errors);
?>


<div class="container">

    <h1>Se connecter</h1>

    <!-- Notification Utilisateur -->
    <?= Notification::toast($messages) ?>

    <!-- FORMULAIRE -->
    <!-- On met en action du formulaire une redirection vers cette même page (pour que le "forbidden" disparaisse de l'url si l'utilisateur à été redirigé) -->
    <form action="<?= $router->url('login') ?>" method="POST">

        <?= $form->input('email', 'email', 'Adresse email'); ?>
        <?= $form->input('password', 'password', 'Password'); ?>

        <button type="submit" class="btn btn-success">Se connecter</button>
    </form>

</div>

