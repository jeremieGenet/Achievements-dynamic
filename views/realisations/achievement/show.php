<?php
/*
    PAGE D'AFFICHAGE D'UNE REALISATION
*/

use App\Auth;
use App\Connection;
use App\Models\Post;
use App\Table\PostTable;

//Auth::check();

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
//dd($id,$post);

// Si le slug de l'article est différent de celui de l'url ($slug défini plus haut grâce à notre router) alors on redirige vers le slug et l'id du post original
if($post->getSlug() !== $slug){
    $url = $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301); // Notification de redirection d'url permanente
    header('Location: ' .$url); // Redirection vers l'url du post avec son slug et son id original (ceux dans la bdd)
}

// Récup des catégories de l'article (via l'id de l'article)
$table = new PostTable($pdo);
$categories = $table->findCategories($post->getId());
//dd($categories);
$title = $post->getTitle();
?>

<!-- AFFICHAGE D'UN ARTICLE (sur toute la page, après sélection de celui-ci) -->
<div class="main-wrapper __main-wrapper">
    <section class="pt-4">
        <div class="container text-center">
            <h1 class="heading"><strong><?= $post->getTitle() ?></strong></h1>
            <p class="text-light"><?= $post->getContent() ?></p>
            
        </div><!--//container-->
    </section>


    <section class="container blog-list px-3 py-2 p-md-5">
        <div class="card mb-3 __card">
            <div class="row no-gutters">

                <div class="col-md-9 __card-image">
                    <a class="" href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">   
                    <!-- IMAGE PRINCIPALE-->
                    <img 
                        src="<?= '../../assets/uploads/img-main/'.$post->getPicture() ?>" 
                        class="card-img h-100" 
                        alt="Image"
                    >
                    </a>
                </div>

                <div class="col-md-3 __card-infos">
                    
                    <div class="__card-categories mt-3">
                        
                        <h3 class=""><strong>Catégories :</strong></h3>
                            <!-- CATEGORIES -->
                            <?php foreach($post->getCategories() as $category): ?>
                                <div class="">
                                    <!-- Lien vers les articles qui ont la même category -->
                                    <a class="badge badge-dark" href="<?= $router->url('achievements-category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>">
                                        <?= $category->getName() ?>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </small>
                    </div>
                    <div class="__card-logos">
                        <hr class="bg-light w-100">
                        <h3 class=""><strong>Technos :</strong></h3>
                        <p class="mt-2">
                            <small class="">
                            <!-- LOGOS -->
                            <?php foreach($post->getLogoCollection() as $logo): ?>
                                <img 
                                    src="<?= '../../assets/uploads/logo-collection/'.$logo->getName() ?>" 
                                    class="img-thumbnail mb-1" 
                                    style="width: 23%;"
                                    alt="<?= $logo->getName() ?>"
                                >
                            <?php endforeach ?>
                            </small>
                        </p>
                        <hr class="bg-light w-100">
                    </div>

                    <!-- CAROUSEL -->
                    <div class="__card-carousel">
                        <div class="container">
                            <div id="carouselExampleFade" class="carousel slide carousel-fade"  style="width: 100%; height: auto;" data-ride="carousel">
                                <div class="carousel-inner">
                                    <!-- IMAGE PRICIPALE -->
                                    <?php foreach($post->getImageCollection() as $index => $image): ?>  
                                    <!-- Condition Ternaire: classe active en fonction de l'index du tableau d'image -->
                                    <div class="carousel-item<?= $index === 0 ? ' active' : '' ?>">
                                        <img 
                                            class="img-fluid"
                                            src="../../assets/uploads/img-collection/<?= $image->getName() ?>" 
                                            alt="<?= $image->getName() ?>"
                                        >
                                    </div>
                                    <?php endforeach; ?>
                                    
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div><!-- Fin de carousel -->
                    
                    <div class="__card-createdAt">
                        <hr class="bg-light w-100">
                        <!-- DATE DE CREATION -->
                        <p class="mb-0"><small class=""><?= $post->getCreatedAt_fr() ?></small></p>
                    </div>
                </div>
                
            </div>
        </div>
        <a href="<?= $router->url('achievements') ?>">
            <button class="btn btn-primary mt-3">Retour</button>
        </a>
    </section>
</div>


