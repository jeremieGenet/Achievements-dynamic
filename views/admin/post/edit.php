<?php
/* 
    PAGE DE MODIFICATION D'UN ARTILCE (post)
*/
use App\Helpers\FilesManager;
use App\HTML\Notification;
use App\Validators\PostValidator;
use App\{Auth, Session, Connection};
use App\Models\{Image, Post, Logo};
use App\Table\{PostTable, CategoryTable, LogoTable, ImageTable};

$pdo = Connection::getPDO();

Auth::check();

$session = new Session();
$messages = $session->getMessage('flash');
$id = $params['id']; // id du post en cours de modification

// Tableaux erreurs de formulaire ('$errors' regroupera les 4 autres tableaux après traitement)
$errors = []; 
$errorsPost = [];
$errorsFilePicture = [];
$errorsFileImages = [];
$errorsFileLogos = [];

// Variable utile au formulaire de collection d'images et de logos (ajoutera ou non la classe ' is-invalid' de bootstrap)
$isInvalidLogos = "";
$isInvalidImages = "";

// Création, puis hydratation du post à modifier avec ses catégories sa collection d'images et de logo (via son id)
$newPost = new Post();
$post = $newPost->hydrate($id);
//dd($post, $post->getCategories(), $post->getLogoCollection()); // Post hydraté !

// Récup de l'ensemble des catégories de la table Category (pour l'affichage dans le formulaire)
$category = new CategoryTable($pdo);
$categories = $category->findAll();

// Si le formulaire est validé...
if(!empty($_POST)){

    // PERMISSION QUI Vérif que ceui qui va modifier un post est soit 'admin' soit l'auteur du post (sinon message et redirection)
    Auth::permissionUpdatePost($post, $router->url('admin_posts'),  "Vous ne possédez pas l'autorisation de modifier cette réalisation.");

    // Pour que le nom, et contenu persistent en cas d'erreurs formulaire
    $post->setTitle($_POST['title']); 
    $post->setContent($_POST['content']); 

    // VERIFICATION DES DONNEES (hors image-collection et logo-collection)
    $validate = new PostValidator($_POST, $post->getId());

    $errorsPost = $validate->fieldEmpty(['title', 'content']);
    $errorsPost = $validate->fieldLength(3, 50, ['title']);
    $errorsPost = $validate->fieldLength(5, 10000, ['content']);

    // VERIFICATION DE L'IMAGE PRINCIPALE ET DE LA COLLECTION DE LOGOS ($_FILES)
    $filesManager = new FilesManager($_FILES);
    // Si un image principale est postée... (s'il y en a une, cette condition rend l'ajout de l'image principale optionnel)
    if($_FILES['picture']['error'] !== 4){ // (error 4 = vide)
        // Vérif de l'image principale ('valid()' retourne un tableau d'erreur ou un tableau vide)
        $errorsFilePicture = $filesManager->valid('picture'); 
    }

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

    // MODIFICATION DES DONNEES DE L'ARTICLE (par les données postées dans le formulaire)
    // S'il n'y a pas d'erreurs...
    if(empty($errors)){
        $post->setTitle(htmlentities($_POST['title']));

        // Gestion de la modification des catégories
        // Si les catégories postées ne sont pas vide ...
        if(!empty($_POST['category'])){ // Choix de Catégories non obligatoire lors de l'édition d'un post
            // Récup des catégories sous forme d'objet via leur id
            $postTable = new PostTable($pdo);
            $cats = $postTable->findCategoriesByid($_POST['category']);
            // On retire les categories présentes dans le post (dans le but d'en ajouter de nouvellles)
            $post->removeCategories();
            // Ajout des nouvelles catégories reçues (via le formulaire)
            foreach($cats as $cat){
                $post->setCategories($cat);
            }
        }

        // ENREGISTREMENT DE LA COLLECTION D'IMAGES DANS LA BDD
        // Récup des images postées
        $imageCollection = $_FILES['image-collection'];

        if($imageCollection['error'][0] !== 4){ // Si la collection d'image n'est pas vide
            $pathImage = 'assets/uploads/img-collection/';
            // Upload (et rename si l'un d'entre eux existe déjà) de la collection de logo dans le dossier dédié (retourne les noms des fichiers) 
            //(et rename si l'un d'entre eux existe déjà) de la collection de logo dans le dossier dédié (retourne les noms des fichiers)
            $uploadImages = $filesManager->upload('image-collection', $pathImage, $post->getId());

            // Si l'upload de logo n'a pas fonctionné...
            if($uploadImages === false){
                // On crée un message flash
                $session->setMessage('flash', 'danger', "L'upload d'images n'a pas fonctionné (Problème encore inconnu."); 
                header('Location: ' . $router->url('admin_post', ['id' => $id]));
                exit();     
            }

            // Récup du nb d'images dans la collection postée
            $countImages = count($imageCollection['name']);
            for($i=0; $i<$countImages; $i++){
                // On vide la collection de images
                $post->removeCollectionImage();

                // Transformation des images reçus en objets image
                $image = new Image();
                $image->setName($uploadImages['name'][$i]);
                $image->setSize($uploadImages['size'][$i]);
                $image->setPost_id($post->getId()); // On récup l'id du post nouvellement créé

                // Ajout des images dans le post
                $post->addImage($image); // Ne sert à rien(si pas utilisé sur cette page), puisque les images ne persitent pas dans un post 
                // Insertion des images dans la bdd
                $imageTable = new ImageTable($pdo);
                $imageTable->insert($image);
            }
        }

        // ENREGISTREMENT DE LA COLLECTION DE LOGO DANS LA BDD
        // Récup des logos postés
        $logoCollection = $_FILES['logo-collection'];
        //dd($logoCollection); // Ok

        if($logoCollection['error'][0] !== 4){ // Si la collection de logo n'est pas vide
            $pathLogo = 'assets/uploads/logo-collection/';
            // Upload (et rename si l'un d'entre eux existe déjà) de la collection de logo dans le dossier dédié (retourne les noms des fichiers) 
            // (et rename si l'un d'entre eux existe déjà) de la collection de logo dans le dossier dédié (retourne les noms des fichiers)
            $uploadLogos = $filesManager->upload('logo-collection', $pathLogo, $post->getId());
            
            // Si l'upload de logo n'a pas fonctionné...
            if($uploadLogos === false){
                // On crée un message flash
                $session->setMessage('flash', 'danger', "L'upload de logo n'a pas fonctionné, (Problème encore inconnu."); 
                header('Location: ' . $router->url('admin_post', ['id' => $id]));
                exit();     
            }

            // Récup du nb de logos dans la collection postée
            $countLogos = count($logoCollection['name']);
            //dd($countLogos); // Ok
            for($i=0; $i<$countLogos; $i++){
                // On vide la collection de logos
                $post->removeCollectionLogo();

                // Transformation des logos reçus en objets Logo
                $logo = new Logo();
                $logo->setName($uploadLogos['name'][$i]);
                $logo->setSize($uploadLogos['size'][$i]);
                $logo->setPost_id($post->getId()); // On récup l'id du post nouvellement créé

                // Ajout des logos dans le post
                $post->addlogo($logo); // Ne sert à rien(si pas utilisé sur cette page), puisque les logos ne persitent pas dans un post 
                // Insertion des logos dans la bdd
                $logoTable = new LogoTable($pdo);
                //dd($logo);
                $logoTable->insert($logo);
            }
        }

        // Modification du contenu
        $post->setContent($_POST['content']);  

        // TRAITEMENT DE L'IMAGE PRINCIPALE (upload, et suppression de l'ancienne puis enregistrement dans le post)
        // Si l'image actuelle du post est différente de l'image postée et que l'image postée est différente de vide ("") alors...
        if(($post->getPicture() !== $_FILES['picture']['name']) && ($_FILES['picture']['name']) !== ""){
            // Dossier dans lequel on dirige l'image postée
            $pathImage = 'assets/uploads/img-main/'; 
            // Upload (et rename si elle existe déjà) de l'image principale dans le dossier (retourne le nom du fichier)
            $fileName = $filesManager->upload('picture', $pathImage, $post->getId());
            // Si l'upload de logo n'a pas fonctionné...
            if($fileName === false){
                // On crée un message flash
                $session->setMessage('flash', 'danger', "L'upload de l'image principale n'a pas fonctionné, Problème encore inconnu."); 
                header('Location: ' . $router->url('admin_post', ['id' => $id]));
                exit();     
            }
            // On supprime le fichier (ex : 'assets/img/haru.jpg') du post actuel s'il existe (puisqu'on vient d'en ajouter de nouveaux)
            $filesManager->remove($post->getPicture(), $pathImage);
            
            // Modif de l'image du post
            $post->setPicture($fileName);
            
        }
        // MODIFICATION DU POST DANS LA BDD , puis message flash et redirection
        $postTable = new PostTable($pdo);
        $postTable->update($post, $id); // $id = "$params['id']" qui est l'id du post à modifier (récup via les param altorouter)
        // Param du message flash de SESSION, puis redirection
        $session->setMessage('flash', 'success', "Modification réussie !!!!");
        header('Location: ' . $router->url('admin_posts'));
        exit();
    }
    
}
?>

<!-- EDITION D'UN ARTICLE (post)-->
<div class="container">
    <h3 class="text-center">Edition de l'article : <strong><?= htmlentities($post->getTitle()) ?></strong></h3>

    <!-- Notification Utilisateur (messages flash) -->
    <?= Notification::toast($messages) ?>

    <hr class="bg-primary my-4">

    <!-- FORMULAIRE D'EDITION DE L'ARTICLE (via notre classe Form.php) -->
    <?php require ('_form.php') ?>
</div>