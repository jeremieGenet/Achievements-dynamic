<?php
/* 
    PAGE DE CREATION D'UNE CATEGORIE
*/
use App\Auth;

use App\Session;
use App\Connection;
use App\Models\Category;
use App\HTML\Notification;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

Auth::check('admin');

$session = new Session();
$messages = $session->getFlashes('flash');

$pdo = Connection::getPDO();
$categoryTable = new CategoryTable($pdo);
$errors = [];
$category = new Category(); // Création d'un objet vide (qui contiendra les données de notre new category)

// Si le formulaire est validé...
if(!empty($_POST)){
    
    // DONNEES DU FORMULAIRE ($_POST + $_FILES)
    $data = array_merge($_POST, $_FILES);
    //dd($data);
    /*
    $data = [
        "name" => "Ann la panthere",
        "slug" => "qsdfqsdf"
    ];
    */
    
    // VERIFICATION DES DONNEES (chaque vérification "soulève" une erreur s'il y en a une)
    // On instancie notre CategoryValidator (avec les données)
    $validate = new CategoryValidator($data);

    $errors = $validate->fieldEmpty(['name','slug']);
    $errors = $validate->fieldLength(3, 150, ['name', 'slug']);
    $errors = $validate->fieldExist(['name']);

    // ON PARAM LE MESSAGE FLASH DE LA SESSION (s'il y a des erreurs)
    if(!empty($errors)){
        $session->setFlash('danger', "Il faut corriger vos erreurs !"); // On crée un message flash
        $messages = $session->getFlashes('flash'); // On l'affiche
    }

    // S'il n'y a pas d'erreurs...
    if(empty($errors)){
        // MODIFICATION DES DONNEES de la catégorie par les données postées dans le formulaire (de modification de la catégorie)
        $category->setName(htmlentities($_POST['name']));
        $category->setSlug(htmlentities($_POST['slug']));

        // ENREGISTREMENT DES DONNEES DANS LA BDD
        $categoryTable->insert($category);
        // Param du message flash de SESSION, puis redirection
        $session->setFlash('success', "La nouvelle catégorie est crée !");
        header('Location: ' . $router->url('admin_categories'));
    }

}
//var_dump($errors);

?>

<!-- EDITION D'UNE CATEGORIE -->
<div class="container">

    <h1 class="text-center mb-4">Création d'une catégorie</h1>

    <!-- Notification Utilisateur -->
    <?= Notification::toast($messages) ?>

    <!-- FORMULAIRE DE CREATION D'UNE CATEGORIE (via notre classe Form.php) -->
    <?php require ('_form.php') ?>

</div>