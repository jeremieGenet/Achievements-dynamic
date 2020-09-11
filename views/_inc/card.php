<!-- CARD BOOTSTRAP -->

<div class="card-deck">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-3 mb-4 p-0">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title text-center"><?= $post->getTitle() ?></h5>
            </div>
            <div class="card-body">
                <div class="img-container rounded">
                    <!-- Lien vers la réalisation complète -->
                    <a href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">
                        <!-- IMAGE PRINCIPALE -->
                        <img class="img-fluid rounded" src="../assets/uploads/img-main/<?= $post->getPicture() ?>" alt="Card image cap">
                    </a>
                </div>
                <p class="card-text pt-2"><?= $post->getContent_excerpt(150) ?></p>
                <!-- Lien vers la réalisation complète -->
                <a href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">Voir plus</a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>