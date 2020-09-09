<?php
/*
    PAGE DES REALISATIONS (Liste des réalisations)
*/
use App\Auth;
use App\Connection;
use App\Table\PostTable;

//Auth::check();

$title = 'Réalisations';

$pdo = Connection::getPDO();

// On récup les résultats paginés (avec hydratation des posts (leur attribut "categories[]"))
// On donne les deux variables utiles au fonctionnement du script qui suit ("[$posts, $pagination]" sont les retours de la méthode findPaginated())
[$posts, $pagination] = (new PostTable($pdo))->findPaginated(); 
$link = $router->url('achievements');
//dd($posts);
?>

<div class="main-wrapper">
    <section class="pt-4">
        <div class="container text-center">
            <h1 class="heading"><strong>Quelques Réalisations Personnelles</strong></h1>
            <p class="text-light">Voici quelques réalisations/projets qui m'ont permis de découvrir différentes technologies Web</p>
        </div><!--//container-->
    </section>

    <section class="container blog-list px-3 py-2 p-md-5">

        <!-- Boucle sur l'ensemble des réalisations -->
        <?php foreach($posts as $k => $post): ?>
            <div class="cards mb-4">
            <!-- Condition pour switcher de card (l'une affiche à droite, l'autre à gauche s-->
            <?php $k % 2 === 0 ? require 'card-right.php' : require 'card-left.php' ?>
            </div>
        <?php endforeach ?>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-between my-4">
            <!-- LIEN PAGE PRECEDENTE -->
            <?= $pagination->previousLink($link) ?>
            <!-- LIEN PAGE SUIVANTE -->
            <?= $pagination->nextLink($link) ?>
        </div>
            
    </section>
</div><!--//main-wrapper-->