<?php
/*
    SUPPRESSION DU LOGO (de la collection) D'UN POST (Traitement uniquement, utilisé sur les bouttons Supprimer des logo dans post/edit.php)
*/

use App\Session;
use App\Connection;
use App\Table\LogoTable;


$session = new Session();

$logoId = $params['logoId']; // Id du logo (passé en param d'url)
$postId = $params['postId']; // Id du post (passé en param d'url)

$pdo = Connection::getPDO();
$logoTable = new LogoTable($pdo);
$logo = $logoTable->find($logoId); // Récup du logo via son id

// Suppression d'un logo de la bdd (via son id)
$logoTable->delete($logoId);

// Suppression du logo du dossier
$filePath = 'assets/uploads/logo-collection/'. $logo->getName();
// Si le fichier existe ...
if ( file_exists($filePath) ) {
    unlink($filePath); // Suppression du fichier
}

// Création d'un message flash
$session->setFlash('success', "Le logo a bien été supprimé !");

// Redirection vers la pages d'accueil des articles de l'administration (param pour l'affichage de message utilisateurs)
header('Location: ' . $router->url('admin_post', ['id' => $postId])); 

