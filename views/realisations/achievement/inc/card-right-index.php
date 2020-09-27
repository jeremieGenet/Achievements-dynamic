<!-- AFFICHAGE D'UNE REALISATION Image à droite (de la page index qui liste toutes les réalisations) -->

<div class="card mb-3 __card">
    <div class="row no-gutters">

        <div class="col-md-3 __card-infos">
            <div class="__card-header">
                <a class="" href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">
                    <!-- TITRE -->
                    <h3 class=""><strong><?= $post->getTitle() ?></strong></h3>
                </a>
                <hr class="bg-light w-100">
            </div>
            <div class="__card-categories">
                
                <small class=""><strong>Catégories :</strong></small>
                    <!-- CATEGORIES -->
                    <?php foreach($post->getCategories() as $category): ?>
                        <div class="badge">
                            <!-- Lien vers les articles qui ont la même category -->
                            <a 
                                class="badge badge-pill badge-dark" 
                                href="<?= $router->url('achievements-category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>"
                            >
                                <?= $category->getName() ?>
                            </a>
                        </div>
                    <?php endforeach ?>
                </small>
            </div>
            <div class="__card-logos">
                <hr class="bg-light mt-2 mb-2 w-100">
                <small class=""><strong>Technos :</strong></small>
                <p class="mt-2">
                    <small class="">
                    <!-- LOGOS -->
                    <?php foreach($post->getLogoCollection() as $logo): ?>
                        <img 
                            src="<?= '../../assets/uploads/logo-collection/'.$logo->getName() ?>" 
                            class="img-thumbnail"
                            style="width: 30%;"
                            alt="<?= $logo->getName() ?>"
                        >
                    <?php endforeach ?>
                    </small>
                </p>
            </div>

            <hr class="bg-light w-75">
            
            <div class="__card-createdAt">
                <!-- DATE DE CREATION -->
                <p class="mb-0"><small class=""><?= $post->getCreatedAt_fr() ?></small></p>
            </div>
        </div>

        <div class="col-md-9 __card-image">
            <a class="" href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">   
                <!-- IMAGE -->
                <img 
                    src="<?= '../../assets/uploads/img-main/'.$post->getPicture() ?>" 
                    class="card-img h-100" 
                    alt="Image"
                >
            </a>
        </div>
        
    </div>
</div>
