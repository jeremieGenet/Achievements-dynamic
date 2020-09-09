<div class="__content-card">
    <div class="__box">
        <?php foreach($posts as $post) : ?>
        <div class="__card">
            <div class="__imgBx">
                <img class="" src="../assets/uploads/img-main/<?= $post->getPicture() ?>" alt="Card image cap">
            </div>
            <div class="__details">
                <h2><?= $post->getTitle() ?><br><span>Director</span></h2>
            </div>
        </div>
        <?php endforeach; ?>

        
        

    </div>
</div>