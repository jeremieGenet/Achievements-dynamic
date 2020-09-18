<!-- CAROUSEL (base de carousel bootstrap, NON UTILISE) -->
<div class="__card-carousel">
    <div class="container">
        <div id="carouselExampleFade" class="carousel slide carousel-fade"  style="width: 100%; height: auto;" data-ride="carousel">
            <div class="carousel-inner">
                <!-- IMAGE PRICIPALE -->
                <div class="carousel-item active">
                    <img 
                        class="img-fluid"
                        src="<?= '../assets/uploads/img-main/'.$post->getPicture() ?>" 
                        alt="..."
                    >
                </div> 
                <?php foreach($post->getImageCollection() as $image): ?>        
                <div class="carousel-item">
                    <img 
                        class="img-fluid"
                        src="../../assets/uploads/img-collection/<?= $image->getName() ?>" 
                        alt="..."
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
</div>