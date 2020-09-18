<?php
/*
    SUPPRESSION D'UN POST (traitement uniquement, utilisé pour le boutton supprimer dans post/index.php)
*/
use App\{Session, Auth};
use App\Connection;
use App\Helpers\FilesManager;
use App\Models\Post;
use App\Table\PostTable;


// Récup du post 'hydraté' (avec images et logos) via son id
$id = $params['id'];
$pdo = Connection::getPDO();
$postModel = new Post($pdo);
$post = $postModel->hydrate($id); 

$session = new Session();

// PERMISSION QUI Vérif que ceui qui va modifier un post est soit 'admin' soit l'auteur du post (sinon message et redirection)
Auth::permissionUpdatePost($post, $router->url('admin_posts'), "Vous ne possédez pas l'autorisation de modifier cette réalisation.");

// GESTION DE LA SUPPRESSION DES IMAGES DANS LES DOSSIERS (image principale, images collection, et logo collection)
// Suppression de l'image Principale du dossier
$pathImg = 'assets/uploads/img-main/';
FilesManager::remove($post->getPicture(), $pathImg);
// Suppression de la collection d'images
foreach($post->getImageCollection() as $image){
    $pathImages = 'assets/uploads/img-collection/';
    FilesManager::remove($image->getName(), $pathImages);
}
// Suppression de la collection de logos
foreach($post->getLogoCollection() as $logo){
    $pathLogos = 'assets/uploads/logo-collection/';
    FilesManager::remove($logo->getName(), $pathLogos);
}

// Suppression du post via son id (dans la bdd)
$postTable = new PostTable($pdo);
$postTable->delete($post, $params['id']);

// Création d'un message flash
$session->setMessage('flash', 'success', "L'article a bien été supprimé !");

// Redirection vers la pages d'accueil des articles de l'administration (param pour l'affichage de message utilisateurs)
header('Location: ' . $router->url('admin_posts')); 

?>
