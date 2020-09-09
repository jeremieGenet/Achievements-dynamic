<?php
use App\Auth;

use App\Session;
use App\Connection;
use App\HTML\Notification;
use App\Table\CategoryTable;
/*
    PAGE ADMINISTRATION DES CATEGORIES (Liens vers création / modification)
*/

Auth::check();

$session = new Session();
$messages = $session->getFlashes('flash');

$title = "Gestion des catégories";
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');

$categories = (new CategoryTable($pdo))->findAll();

?>

<!-- LISTE DES CATEGORIES (accueil de l'administation) -->
<div class="container">

    <h2 class="text-center mb-4">Administration des Catégories</h2>

    <!-- AFFICHE LES DIFFERENTES Notifications Utilisateur -->
    <?= Notification::toast($messages) ?>

    <!-- AFFICHAGE MESSAGE UTILISATEUR -->
    <?php if(isset($_GET['delete'])): ?>
        <div class="alert alert-success">
            La catégorie a bien été supprimé !
        </div>
    <?php endif ?>
    <!-- MESSAGE VALIDATION CREATION -->
    <?php if(isset($_GET['created'])): ?>
        <div class="alert alert-success">
            La catégorie a bien été créé !
        </div>
    <?php endif; ?>

    <!-- TABLEAU DES CATEGORIES -->
    <table class="table">
        <thead class="text-dark">
            <th>Id</th>
            <th>Titre</th>
            <th>URL</th>
            <th>
                <!-- BOUTON DE CREATION D'UNE CATEGORIE -->
                <a href="<?= $router->url('admin_category_new') ?>" class="btn btn-dark">Créer une catégorie</a>
            </th>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
                 <td>
                    <!-- ID DES CATEGORIES -->
                    <?= htmlentities($category->getId()) ?>
                </td>
                <td>
                    <a href="<?= $router->url('admin_category', ['id' => $category->getId()]) ?>">
                        <!-- NOM DES CATEGORIE -->
                        <?= htmlentities($category->getName()) ?>
                    </a>
                </td>
                <!-- NOM DES CATEGORIES -->
                <td><?= $category->getSlug() ?></td>
                <td>
                    <!-- BOUTON pour EDITER -->
                    <a href="<?= $router->url('admin_category', ['id' => $category->getId()]) ?>" class="btn btn-info">
                        Modifier la catégorie
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>