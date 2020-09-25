<!-- CARDS de la section DERNIERES REALISATIONS (BOOTSTRAP) de la one-page home (CSS PARTICULIER voir card.css) -->

<div class="card-deck">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-4 mb-4 p-0">
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
                <!-- Lien vers la réalisation complète -->
                <a href="<?=  $router->url('achievement', ['slug' => $post->getSlug(), 'id' => $post->getId()]) ?>">Voir plus</a>
            </div>
            <div class="card-footer">
                <small class="text-muted"><?= $post->getCreatedAt_fr() ?></small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>