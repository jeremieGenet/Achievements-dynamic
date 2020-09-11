<?php
/*
    FORMULAIRE HTML (qui sert à la création et à l'édition d'une catégorie)
*/
use App\HTML\Form;
// Instanciation du formulaire de création d'une catégorie
$form = new Form($category, $errors);
//$form::$class = "essai";


?>

<form action="" method="POST">

    <?= $form->input('text', 'name', 'Titre'); ?>
    <?= $form->input('text', 'slug', 'URL'); ?>

    <div class="d-flex justify-content-between mb-4">
        <!-- BOUTON MODIFIER/CREER -->
        <!-- Modification dynamique de l'intitulé du Bouton (Modification ou création) -->
        <button class="btn btn-success">
            <!-- Si la catégorie à un id qui n'est pas null (donc la catégorie existe) alors... -->
            <?php if($category->getId() !== null) : ?>
                Modifier
            <!-- Sinon la catégorie n'existe pas alors ... -->
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
        <!-- BOUTON DE RETOUR -->
        <a href="<?= $router->url('admin_categories') ?>" class="btn btn-primary ml-auto">Retour &raquo;</a>
    </div>
    
</form>