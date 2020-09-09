<?php
/*
    SUPPRESSION D'UNE IMAGE (de la collection) D'UN POST (Traitement uniquement, utilisé sur les bouttons Supprimer des images dans post/edit.php)
*/

use App\Session;
use App\Connection;
use App\Table\ImageTable;

$session = new Session();

$imageId = $params['imageId']; // Id de l'image (passé en param d'url)
$postId = $params['postId']; // Id du post (passé en param d'url)

$pdo = Connection::getPDO();
$imageTable = new ImageTable($pdo);
$image = $imageTable->find($imageId); // Récup de l'image via son id

// Suppression d'une image de la bdd (via son id)
$imageTable->delete($imageId);

// Suppression de l'image du dossier
$filePath = 'assets/uploads/img-collection/'. $image->getName();
// Si le fichier existe ...
if ( file_exists($filePath) ) {
    unlink($filePath); // Suppression du fichier
}

// Création d'un message flash
$session->setFlash('success', "L'image a bien été supprimée !");

// Redirection vers la pages d'accueil des articles de l'administration (param pour l'affichage de message utilisateurs)
header('Location: ' . $router->url('admin_post', ['id' => $postId])); 