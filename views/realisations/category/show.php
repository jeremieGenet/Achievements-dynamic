<?php
// PAGE QUI LISTE LES REALISATIONS QUI APPARTIENNENT A LA CATEGORIE SELECTIONNEE (sur la page de visu d'un article)

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;

$id = (int)$params['id']; // id en param d'url
$slug = $params['slug']; // slug en param d'url

// Connextion à la bdd
$pdo = Connection::getPDO();

// Récup de la catégorie (via son id passé en param dans l'url)
$category = (new CategoryTable($pdo))->find($id);

// Si le slug de l'article est différent de celui de l'url ($slug défini plus haut grâce à notre router) alors on redirige vers le slug et l'id du post original
if($category->getSlug() !== $slug){
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301); // Notification de redirection d'url permanente
    header('Location: ' .$url); // Redirection vers l'url du post avec son slug et son id original (ceux dans la bdd)
}
//dd($category);
$title = "catégorie : {$category->getName()}";

// On récup les résultats paginnés (avec hydratation des posts (leur attribut "categories[]"))
[$posts, $pagination] = (new PostTable($pdo))->findPaginatedForCategory($id); // On donne les deux variables utiles au fonctionnement du script qui suit ("[$posts, $pagination]" sont les retours de la méthode findPaginated())

$link = $router->url('achievements-category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);

?>
<!-- PAGE QUI LISTE LES ARTICLES QUI APPARTIENNENT A LA CATEGORIE CLIQUEE (sur la page de visu d'un article) -->
<div class="main-wrapper">
    <h1 class="text-center pt-5 heading">REALISATIONS de la <strong><?= htmlentities($title) ?></strong></h1>

    <!-- LISTE DES REALISATIONS -->
    <section class="blog-list px-3 py-5 p-md-5">

        <div class="container">

            <!-- Boucle sur l'ensemble des réalisations -->
            <?php foreach($posts as $k => $post): ?>
                <div class="cards mb-4">
                <!-- Condition pour switcher de card (l'une affiche l'image à droite, l'autre à gauche -->
                <?php $k % 2 === 0 ? require dirname(__DIR__) . '/achievement/inc/card-right-index.php' : require dirname(__DIR__) . '/achievement/inc/card-left-index.php' ?>
                </div>
            <?php endforeach ?>
            
            

            <!-- PAGINATION -->
            <div class="d-flex justify-content-between my-4">
                <!-- LIEN PAGE PRECEDENTE -->
                <?= $pagination->previousLink($link) ?>
                <!-- LIEN PAGE SUIVANTE -->
                <?= $pagination->nextLink($link) ?>
            </div>
            
        </div>
    </section>

</div><!--//main-wrapper-->








