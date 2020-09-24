<?php
/*
    FORMULAIRE HTML (qui sert à la création et à l'édition d'un article)
*/
use App\HTML\Form;

// Instanciation du formulaire de création d'un article
$form = new Form($post, $errors);
?>


<form method="POST" enctype="multipart/form-data">

    <!-- INPUT TITLE -->
    <?= $form->input('text', 'title', 'Titre'); ?>

    <hr class="bg-light my-2"><!---------------------------------------------------------------------------------->

    <!-- INPUTS CHECK-BOX (pour les catégories) Retournera le ou les id des catégories à la validation du formulaire: [0 => "1", 1 => "2", ...]  -->
    <div class="form-group">
        <label for="">Categories</label>
        <div class="form-check">

            <!-- Params: l'id de la catégorie, le nom de la catégorie, le nom du champ (qui doit correspondre au nom de la table Category), et l'attribut "checked" -->
            <?php foreach($categories as $category): ?>
                <?php  //dd($post->getCategoriesId(), $category->getId()); ?>
                <?php echo $form->inputCheckBox(
                    $category->getId(),
                    $category->getName(),
                    'category',
                    // Condition TERNAIRE pour rendre les checkbox 'checked' si la la catégorie appartient bien au post actuel
                    in_array($category->getId(), $post->getCategoriesId()) ?  $checked = "checked" : '');
                ?>
            <?php endforeach;?>

            <div class="invalid-feedback">
                <?php if(isset($errors['category'])): ?> 
                    <?= $errors['category'] ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr class="bg-light my-2"><!---------------------------------------------------------------------------------->

    <!-- INPUT PICTURE (Image Principale) -->
    <?php echo $form->inputFile(
            'picture', 
            "Image principale : ".$post->getPicture(), 
            "Choisissez une image représentative de votre réalisation (Image Principale)."
        ); 
    ?>

    <!-- AFFICHAGE DE L'IMAGE PRINCIPALE ET DES IMAGES-COLLECTION DU POST (si le post existe) -->
    <?php if($post->getId() !== null) : ?>
    <div class="row my-3">
        <!-- IMAGE PRINCIPALE DU POST -->
        <div class="col-md-3">
            <p><strong>Image Principale</strong></p>
            <img src="../../assets/uploads/img-main/<?= $post->getPicture() ?>"
                style="width: 300px; height: 160px; background-color: rgba(100,0,255,0.2);"
                class="rounded float-left img-thumbnail img-fluid"
                name="<?= $post->getPicture() ?>"
                alt="<?= $post->getPicture() ?? "Pas d'illustration !" ?>"
            >
        </div>
        <!-- AFFICHAGE DES IMAGES DE LA COLLECTION -->
        <div class="col-md-9 col-xs-12">
            <p><strong>Collection d'image :</strong></p>
            <div class="row">
            <?php //dd($post); ?>
                <?php foreach($post->getImageCollection() as $image): ?>
                    <?php //dd($image->getName()); ?>
                    <div class="col-md-2 col-xs-12">
                        <img src="../../assets/uploads/img-collection/<?= $image->getName() ?>"
                            style="width: 82px; height: 60px;"
                            class="rounded float-left img-thumbnail img-fluid mb-2"
                            name="<?= $image->getNameLessExt() ?>"
                            alt="<?= $image->getNameLessExt() ?? "Pas d'illustration !" ?>"
                        >
                        <!-- Lien/bouton de suppression de l'image (en param d'url l'id du post et l'id de l'image) -->
                        <a href="<?= $router->url('admin_post_image_delete', ['postId' => $post->getId(), 'imageId' => $image->getId()]) ?>" 
                            class="btn btn-danger btn-xs mb-2" 
                            role="button">Remove
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>         
    </div>
    <?php endif ?>

    <!-- INPUTS IMAGES (COLLECTION voir script JS) -->
    <div id="divImages" class="form-group pl-0 pb-3">
        <label for="image_0" class="inline-block">Collection d'images:</label>
            <input type="file" multiple 
            id="input_image_0" 
            class="form-control-file"
            name="image-collection[]"  
            is="drop-files" label="Insérer / Ajouter vos images ici" help="Collection d'images (Images secondaires)"
            >
            <input type="hidden" name="image-collection[]" class="form-control<?= $isInvalidImages ?>">
            <small id="fileHelpImage" class="form-text text-muted">Images qui permettent d'illustrer la réalisation</small>
        <!-- Affichage de l'erreur de l'image dans une div class="invalid-feedback"-->
        <div class="invalid-feedback">
            <?php if(isset($errors['image-collection'])): ?>  
                <?= $errors['image-collection'] ?>
            <?php endif; ?>
        </div>
    </div>
    
    <hr class="bg-light my-2"><!---------------------------------------------------------------------------------->

    <!-- INPUT CONTENT ('content')-->
    <?= $form->textarea('content', 'Contenu'); ?>

    <hr class="bg-light my-2"><!---------------------------------------------------------------------------------->

    <!-- LOGOS -->
    <div class="logos row">
        <!-- INPUTS LOGOS (COLLECTION voir script JS) -->
        <div class="col-md-4">
            <div id="divLogos" class="form-group pl-0 pb-3">
                <label for="logo_0" class="inline-block">Ajouter des logos:</label>
                    <input type="file" multiple 
                    id="input_logo_0" 
                    class="form-control-file"
                    name="logo-collection[]"  
                    is="drop-files" label="Insérer / Ajouter vos logos ici" help="plusieurs logos possibles"
                    >
                    <input type="hidden" name="logo-collection[]" class="form-control<?= $isInvalidLogos ?>">
                    <small id="fileHelpLogo" class="form-text text-muted">Logos qui permettent d'illustrer la réalisation</small>
                <!-- Affichage de l'erreur LOGO dans une div class="invalid-feedback"-->
                <div class="invalid-feedback">
                    <?php if(isset($errors['logo-collection'])): ?>  
                        <?= $errors['logo-collection'] ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- AFFICHAGE DES LOGOS (avec boutton suppression) -->                
        <div class="col-md-8">
            <p><strong>Logos actuels :</strong></p>
            <div class="row">
                <?php foreach($post->getLogoCollection() as $logo): ?>
                    <div class="col-md-2 col-xs-12">
                        <img src="../../assets/uploads/logo-collection/<?= $logo->getName() ?>"
                            style="width: 80px; height: 80px;"
                            class="rounded float-left img-thumbnail img-fluid mb-2"
                            name="<?= $logo->getNameLessExt() ?>"
                            alt="<?= $logo->getNameLessExt() ?? "Pas d'illustration !" ?>"
                        >
                        <!-- Lien/bouton de suppression de logo (en param d'url l'id du post et l'id du logo) -->
                        <a href="<?= $router->url('admin_post_logo_delete', ['postId' => $post->getId(), 'logoId' => $logo->getId()]) ?>" 
                            class="btn btn-danger btn-xs" 
                            role="button">Remove
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <hr class="bg-light my-2"><!---------------------------------------------------------------------------------->

    <!-- INPUT DATE (si le post est déja crée) -->               
    <?php if($post->getId() !== null) : ?>
        <?= $form->input('date', 'createdAt', 'Date de création'); ?>
    <?php endif ?>

    <hr class="bg-primary my-4"><!---------------------------------------------------------------------------------->

    <!-- BUTTON SOUMISSION FORMULAIRE (modification / création) -->
    <div class="d-flex justify-content-between mb-5">
        <!-- BOUTON MODIFIER/CREER -->
        <!-- Modification dynamique de l'intitulé du Bouton (Modification ou Création) -->
        <button class="btn btn-success">
            <!-- Si l'article à un id qui n'est pas null (donc l'article existe) alors... -->
            <?php if($post->getId() !== null) : ?>
                Modification
            <!-- Sinon l'article n'existe pas alors ... -->
            <?php else: ?>
                Création
            <?php endif ?>
        </button>
        <!-- BOUTON DE RETOUR -->
        <a href="<?= $router->url('admin_posts') ?>" class="btn btn-primary ml-auto">Retour &raquo;</a>
    </div>
    
</form>

<!-- Script drop-file (module JS qui permet d'importer des images dans une zone dédiée) -->
<script type="module" src="../../../assets/js/admin/drop-files.js"></script>
<!-- Script ckeditor (éditeur de text) -->
<script>
    CKEDITOR.replace( 'content' );
</script>




