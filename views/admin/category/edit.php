<?php
/* 
    PAGE DE MODIFICATION D'UNE CATEGORIE
*/
use App\Auth;

use App\Session;
use App\Connection;
use App\HTML\Notification;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

//Auth::check();
Auth::check('admin'); // Seul le rôle admin est autorisé

$session = new Session();
$messages = $session->getMessage('flash');

$id = $params['id'];
$pdo = Connection::getPDO();
$categoryTable = new CategoryTable($pdo);
$category = $categoryTable->find($id); // Récup de la catégorie avec ses infos (avant modification) via l'id passé dans l'url
$success = false;
$errors = []; // erreurs de formulaire



if(!empty($_POST)){
    
    // DONNEE DU FORMULAIRE ($_POST + $_FILES)
    $data = array_merge($_POST, $_FILES);

    // VERIFICATION DES DONNEES
    // On instancie notre CategoryValidator (qui contient la librairie Valitron/Validator),
    // ...avec les données du formulaire et l'id de la categorie en cours
    $validate = new CategoryValidator($data, $category->getId());

    $errors = $validate->fieldEmpty(['name','slug']);
    $errors = $validate->fieldLength(3, 150, ['name', 'slug']);
    $errors = $validate->fieldExist(['name', 'slug']);

    // MODIFICATION DES DONNEES de la catégorie par les données postées dans le formulaire (de modification de la catégorie)
    $category->setName($_POST['name']);
    $category->setSlug($_POST['slug']);

    // ON PARAM LE MESSAGE FLASH DE LA SESSION (s'il y a des erreurs)
    if(!empty($errors)){
        $session->setMessage('flash', 'danger', "Il faut corriger vos erreurs !"); // On crée un message flash
        $messages = $session->getMessage('flash'); // On l'affiche
    }
    
    // s'il ny a pas d'erreur de validation (CategoryValidator.php)...
    if(empty($errors)){
        // MODIFICATION DE LA BDD 
        $categoryTable->update($category);
        $session->setMessage('flash', 'success', "Modification réussie !!!!");

        header('Location: ' . $router->url('admin_categories'));
    }

}
?>

<!-- EDITION D'UNE CATEGORY -->
<div class="container">

    <h1 class="text-center mb-4">Edition de la catégorie <?= htmlentities($category->getName()) ?></h1>

    <!-- Notification Utilisateur -->
    <?= Notification::toast($messages) ?>

    <!-- FORMULAIRE D'EDITION DE LA CATEGORIE (via notre classe Form.php) -->
    <?php require ('_form.php') ?>

</div>