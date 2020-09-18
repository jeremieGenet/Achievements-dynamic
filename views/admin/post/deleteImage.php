<?php
/*
    SUPPRESSION D'UNE IMAGE (de la collection) D'UN POST (Traitement uniquement, utilisé sur les bouttons Supprimer des images dans post/edit.php)
*/

use App\{Session, Auth};
use App\Connection;
use App\Table\ImageTable;
use App\Table\PostTable;

$session = new Session();

$imageId = $params['imageId']; // Id de l'image (passé en param d'url)
$postId = $params['postId']; // Id du post (passé en param d'url)

$pdo = Connection::getPDO();
$imageTable = new ImageTable($pdo);
$image = $imageTable->find($imageId); // Récup de l'image via son id


// Récup du post
$postTable = new PostTable($pdo);
$post = $postTable->find($postId);

// PERMISSION QUI Vérif que ceui qui va modifier un post est soit 'admin' soit l'auteur du post (sinon message et redirection)
Auth::permissionUpdatePost($post, $router->url('admin_posts'), "Vous ne possédez pas l'autorisation de supprimer cette image.");

// Suppression d'une image de la bdd (via son id)
$imageTable->delete($imageId);

// Suppression de l'image du dossier
$filePath = 'assets/uploads/img-collection/'. $image->getName();
// Si le fichier existe ...
if ( file_exists($filePath) ) {
    unlink($filePath); // Suppression du fichier
}

// Création d'un message flash
$session->setMessage('flash', 'success', "L'image a bien été supprimée !");

// Redirection vers la pages d'accueil des articles de l'administration (param pour l'affichage de message utilisateurs)
header('Location: ' . $router->url('admin_post', ['id' => $postId])); 