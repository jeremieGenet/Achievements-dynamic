<!--
    CARD d'une réalisation (Partie carousel/infos)
-->
<div class="card mb-3 __card">
    <div class="row no-gutters">

        <div class="col-md-9 __card-image h-100">
            <!-- CAROUSEL (de la collection d'image) -->
            <div class="__card-carousel p-0">
                <div class="container p-0">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- COLLECTION D'IMAGES -->
                            <?php foreach($post->getImageCollection() as $index => $image): ?>  
                            <!-- Condition Ternaire: classe active en fonction de l'index du tableau d'image -->
                            <div class="carousel-item<?= $index === 0 ? ' active' : '' ?>">
                                <img 
                                    class="card-img h-100"
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
        </div>

        <div class="col-md-3 __card-infos">
            
            <div class="__card-categories mt-2">
                <h3 class=""><strong>Catégories :</strong></h3>
                    <p>
                    <!-- CATEGORIES -->
                    <?php foreach($post->getCategories() as $category): ?>
                        <!-- Lien vers les articles qui ont la même category -->
                        <a class="badge badge-dark" href="<?= $router->url('achievements-category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>">
                            <?= $category->getName() ?>
                        </a>
                    <?php endforeach ?>
                    </p>
                
            </div>

            <hr class="bg-light"><!------------------------------------------------------------------------------------------->

            <div class="__card-logos">
                
                <h3 class=" mt-2"><strong>Technos :</strong></h3>
                <p class="">
                    
                    <!-- LOGOS -->
                    <?php foreach($post->getLogoCollection() as $logo): ?>
                        <img 
                            src="<?= '../../assets/uploads/logo-collection/'.$logo->getName() ?>" 
                            class="img-thumbnail" 
                            style="width: 20%;"
                            alt="<?= $logo->getName() ?>"
                        >
                    <?php endforeach ?>
                    
                </p>
                
            </div>

            <hr class="bg-light"><!------------------------------------------------------------------------------------------->

            <!-- IMAGE PRINCIPALE-->
            <img 
                src="<?= '../../assets/uploads/img-main/'.$post->getPicture() ?>" 
                class="card-img p-3" 
                alt="Image"
            >    
            
            <hr class="bg-light"><!------------------------------------------------------------------------------------------->

            <div class="__card-createdAt">
                <!-- DATE DE CREATION -->
                <p class="mb-0"><small class=""><?= $post->getCreatedAt_fr() ?></small></p>
            </div>
        </div>

    </div>
</div>