<?php
/*
    SUPPRESSION DU LOGO (de la collection) D'UN POST (Traitement uniquement, utilisé sur les bouttons Supprimer des logo dans post/edit.php)
*/

use App\{Session, Auth};
use App\Connection;
use App\Table\LogoTable;
use App\Table\PostTable;


$session = new Session();

$logoId = $params['logoId']; // Id du logo (passé en param d'url)
$postId = $params['postId']; // Id du post (passé en param d'url)

$pdo = Connection::getPDO();
$logoTable = new LogoTable($pdo);
$logo = $logoTable->find($logoId); // Récup du logo via son id

// Récup du post
$postTable = new PostTable($pdo);
$post = $postTable->find($postId);

// PERMISSION QUI Vérif que ceui qui va modifier un post est soit 'admin' soit l'auteur du post (sinon message et redirection)
Auth::permissionUpdatePost($post, $router->url('admin_posts'), "Vous ne possédez pas l'autorisation de supprimer ce logo.");

// Suppression d'un logo de la bdd (via son id)
$logoTable->delete($logoId);

// Suppression du logo du dossier
$filePath = 'assets/uploads/logo-collection/'. $logo->getName();
// Si le fichier existe ...
if ( file_exists($filePath) ) {
    unlink($filePath); // Suppression du fichier
}

// Création d'un message flash
$session->setMessage('flash', 'success', "Le logo a bien été supprimé !");

// Redirection vers la pages d'accueil des articles de l'administration (param pour l'affichage de message utilisateurs)
header('Location: ' . $router->url('admin_post', ['id' => $postId])); 

