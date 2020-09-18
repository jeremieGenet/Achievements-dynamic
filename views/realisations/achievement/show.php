<?php
/*
    PAGE D'AFFICHAGE D'UNE REALISATION
*/

use App\Connection;
use App\Models\Post;
use App\Table\PostTable;


$id = (int)$params['id'];
$slug = $params['slug'];

// Connextion à la bdd
$pdo = Connection::getPDO();
$post = new Post();
$post->hydrate($id);

// Création d'un nouveau post
$newPost = new Post();
// Hydratation du post (ajout de la collection d'images, de logos et des catégories)
$post = $newPost->hydrate($id);

// Si le slug de l'article est différent de celui de l'url ($slug défini plus haut grâce à notre router) alors on redirige vers le slug et l'id du post original
if($post->getSlug() !== $slug){
    $url = $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301); // Notification de redirection d'url permanente
    header('Location: ' .$url); // Redirection vers l'url du post avec son slug et son id original (ceux dans la bdd)
}

// Récup des catégories de l'article (via l'id de l'article)
$table = new PostTable($pdo);
$categories = $table->findCategories($post->getId());
$title = $post->getTitle();
?>

<!-- AFFICHAGE D'UN ARTICLE (sur toute la page, après sélection de celui-ci) -->
<div class="main-wrapper __main-wrapper">
    <section class="__title pt-5">
        <div class="text-center">
            <!-- TITRE de la réalisation -->
            <h1 class="heading"><strong><?= $post->getTitle() ?></strong></h1>
        </div>
    </section>

    <section class="__carousel-infos p-5">
        <!-- CARD d'une réalisation (carousel/infos) -->
        <?php require('inc/card-show.php') ?>
    </section>

    <section class="__content">
        <!-- CONTENU (Text) de la réalisation -->
        <p class="text-light"><?= $post->getContent() ?></p>
    </section>

    <div class="p-5">
        <!-- BOUTON DE RETOUR -->
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>">
            <button class="btn btn-primary">Retour</button>
        </a>
    </div>

</div>


