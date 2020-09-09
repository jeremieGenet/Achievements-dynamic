<!-- CARD BOOTSTRAP -->

<div class="card-deck">
    <?php foreach($posts as $post) : ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title text-center mt-3"><?= $post->getTitle() ?></h5>
            </div>
            <img class="img-fluid" src="../assets/uploads/img-main/<?= $post->getPicture() ?>" alt="Card image cap">
            <div class="card-body">
                
                <p class="card-text"><?= $post->getContent_excerpt(150) ?></p>
                <a href="">Voir plus</a>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>