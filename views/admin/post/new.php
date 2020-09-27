<?php
/* 
    PAGE DE CREATION D'UN ARTILCE (post)
*/
use App\Helpers\FilesManager;
use App\HTML\Notification;
use App\Models\{Post, Logo, Image};
use App\Validators\PostValidator;
use App\{Auth, Session, Connection};
use App\Table\{PostTable, LogoTable, ImageTable, CategoryTable};

$pdo = Connection::getPDO();
Auth::check();

$postTable = new PostTable($pdo);
$id = $postTable->getNextId(); // Récup de l'id du post qui va être crée
//dd($id);

$session = new Session();
$messages = $session->getMessage('flash');

// Tableaux erreurs de formulaire ($errors regroupera les 4 autres tableaux après traitement)
$errors = []; 
$errorsPost = [];
$errorsFilePicture = [];
$errorsFileImages = [];
$errorsFileLogos = [];

// Variable utile au formulaire de collection d'images et de logos (ajoutera ou non la classe ' is-invalid' de bootstrap)
$isInvalidLogos = "";
$isInvalidImages = "";

// Récup de l'ensemble des catégories de la table Category (pour l'affichage dans le formulaire)
$category = new CategoryTable($pdo);
$categories = $category->findAll();

$post = new Post(); // Création d'un objet vide (qui contiendra le nouveau post sous forme d'objet)

// Si le formulaire est posté...
if(!empty($_POST)){
    // Pour que le nom, contenu et l'image persistent en cas d'erreurs dans le formulaire
    $post->setTitle($_POST['title']); 
    $post->setContent($_POST['content']); 
    $post->setPicture($_FILES['picture']['name']); 
    
    // VERIFICATION DES DONNEES (hors image-collection et logo-collection)
    $validate = new PostValidator($_POST, $post->getId());

    $errorsPost = $validate->fieldEmpty(['category', 'title', 'content']);
    $errorsPost = $validate->fieldLength(3, 150, ['title']);
    $errorsPost = $validate->fieldLength(5, 10000, ['content']);
    $errorsPost = $validate->fieldExist(['title']);


    // VERIFICATION DE L'IMAGE PRINCIPALE ET DE LA COLLECTION DE LOGOS ($_FILES)
    $filesManager = new FilesManager($_FILES);

    // Vérif de l'image principale ('valid()' retourne un tableau d'erreur ou un tableau vide)
    $errorsFilePicture = $filesManager->valid('picture'); 

    // Si une collection d'image est postée... (s'il y en a, cette condition rend l'ajout d'image optionnel)
    if($_FILES['image-collection']['error'][0] !== 4){ // (error 4 = vide)
        // Vérif collection d'images ('valid()' retourne un tableau d'erreur ou un tableau vide)
        $errorsFileImages = $filesManager->valid('image-collection'); 
        // Condition si il y a une erreur lors de l'édition des images (on donne la classe bootstrap " is-invalid")
        if($errorsFileImages !== []){
            $isInvalidImages = ' is-invalid';
        }
    }

    // Si une collection de logo est postée... (s'il y en a, cette condition rend l'ajout de logos optionnel)
    if($_FILES['logo-collection']['error'][0] !== 4){ // (error 4 = vide)
        // Vérif collection de logos ('valid()' retourne un tableau d'erreur ou un tableau vide)
        $errorsFileLogos = $filesManager->valid('logo-collection'); 
        // Condition si il y a une erreur lors de l'édition des logos (on donne la classe bootstrap " is-invalid")
        if($errorsFileLogos !== []){
            $isInvalidLogos = ' is-invalid';
        }
    }

    // On regroupe dans un même tableau les erreurs de post ($_POST, hors $_FILES) et les erreur des fichiers ($_FILES)
    $errors = array_merge($errorsPost, $errorsFilePicture, $errorsFileImages, $errorsFileLogos);

    // ON PARAM LE MESSAGE FLASH DE LA SESSION (s'il y a des erreurs)
    if(!empty($errors)){
        $session->setMessage('flash', 'danger', "Il faut corriger vos erreurs !"); // On crée un message flash
        $messages = $session->getMessage('flash'); // On l'affiche
    }
    
    // S'il n'y a pas d'erreurs...
    if(empty($errors)){  
        // ENREGISTREMENT DES DONNEES DE L'ARTICLE (par les données postées dans le formulaire)
        $post->setTitle(htmlentities($_POST['title']));

        // GESTION DES CATEGORIES
        // Récup des catégories sous forme d'objet via leurs id (passés via le formulaire)
        $cats = $postTable->findCategoriesByid($_POST['category']); 
        foreach($cats as $cat){
            $post->setCategories($cat);
        }

        $post->setContent($_POST['content']);
        $post->setAuthor_id($_SESSION['user']['id']);
        $post->setLikes('0');
        $post->setIsLiked('0');

        // GESTION DE L'IMAGE PRINCIPALE
        // Upload (et rename si elle existe déjà) de l'image principale dans le dossier (retourne le nom du fichier)
        $uploadImage = $filesManager->upload('picture', 'assets/uploads/img-main/');
        // Modif de l'image du post (avec le nom de fichier traité via la méthode "upload()")
        // Si l'upload de logo n'a pas fonctionné...
        if($uploadImage === false){
            // On crée un message flash
            $session->setMessage('flash', 'danger', "L'upload de l'image principale n'a pas fonctionné (Extension en Majuscules?)."); 
            header('Location: ' . $router->url('admin_post', ['id' => $id]));
            exit();     
        }
        $post->setPicture($uploadImage);

        // ENREGISTREMENT DU POST DANS LA BDD (avant la collection d'images et de logo pour récup l'id du post dans les objets logo)
        $postTable->insert($post);

        // GESTION DES IMAGES (collection)
        // Récup des images postées
        $imageCollection = $_FILES['image-collection'];
        // Si la collection d'image n'est pas vide
        if($imageCollection['error'][0] !== 4){
            // Upload (et rename si l'un d'entre eux existe déjà) de la collection d'image dans le dossier dédié (retourne les noms des fichiers)
            $uploadImages = $filesManager->upload('image-collection', 'assets/uploads/img-collection/');
            
            //dd($uploadImages); // Retourn false /********************************************* */

            // Si l'upload de logo n'a pas fonctionné...
            if($uploadImages === false){
                // On crée un message flash
                $session->setMessage('flash', 'danger', "L'upload des Images de la collection n'a pas fonctionné (Extension en Majuscules?)."); 
                header('Location: ' . $router->url('admin_post', ['id' => $id]));
                exit();     
            }

            // ENREGISTREMENT DE LA COLLECTION D'IMAGE DANS LA BDD
            // Récup du nb d'image dans la collection postée
            $countImages = count($imageCollection['name']);
            for($i=0; $i<$countImages; $i++){
                // Transformation des Images reçus en objets Image
                $newImage = new Image();
                $newImage->setName($uploadImages['name'][$i]);/************** reçoit null ???*****************/
                $newImage->setSize($uploadImages['size'][$i]);
                $newImage->setPost_id($post->getId()); // On récup l'id du post nouvellement créé

                // Ajout des images dans le post  
                $post->addImage($newImage); // Ne sert à rien(si pas utilisé sur cette page), puisque les images ne persitent pas dans un post 
                // Insertion des images dans la bdd
                $imageTable = new ImageTable($pdo);
                $imageTable->insert($newImage);
            }
        }

        // GESTION DES LOGOS (collection)
        // Récup des logos postés
        $logoCollection = $_FILES['logo-collection'];
        // Si la collection de logo n'est pas vide
        if($logoCollection['error'][0] !== 4){
            // Upload (et rename si l'un d'entre eux existe déjà) de la collection de logo dans le dossier dédié (retourne les noms des fichiers, ou false)
            $uploadLogos = $filesManager->upload('logo-collection', 'assets/uploads/logo-collection/');

            // Si l'upload de logo n'a pas fonctionné...
            if($uploadLogos === false){
                // On crée un message flash
                $session->setMessage('flash', 'danger', "L'upload des logos n'a pas fonctionné (Extension en Majuscules?)."); 
                header('Location: ' . $router->url('admin_post', ['id' => $id]));
                exit();     
            }

            // ENREGISTREMENT DE LA COLLECTION DE LOGO DANS LA BDD
            // Récup du nb de logos dans la collection postée
            $countLogos = count($logoCollection['name']);
            for($i=0; $i<$countLogos; $i++){
                // Transformation des logos reçus en objets Logo
                $logo = new Logo();
                $logo->setName($uploadLogos['name'][$i]);
                $logo->setSize($uploadLogos['size'][$i]);
                $logo->setPost_id($post->getId()); // On récup l'id du post nouvellement créé

                // Ajout des logos dans le post
                $post->addLogo($logo); // Ne sert à rien(si pas utilisé sur cette page), puisque les logos ne persitent pas dans un post 
                // Insertion des logos dans la bdd
                $logoTable = new LogoTable($pdo);
                $logoTable->insert($logo);
            }
        }

        // Param du message flash de SESSION, puis redirection
        $session->setMessage('flash', 'success', "L'article est crée !");
        header('Location: ' . $router->url('admin_posts'));
    }

}
?>

<!-- CREATION D'UN ARTICLE (post)-->
<div class="container">

    <!-- Notification Utilisateur -->
    <?= Notification::toast($messages) ?>

    <h3 class="text-center mb-4">Création d'une Réalisation</h3>
    <hr class="bg-primary my-4">

    <!-- FORMULAIRE DE CREATION D'UN ARTICLE (via notre classe Form.php) -->
    <?php require ('_form.php') ?>

</div>