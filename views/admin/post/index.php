<?php
use App\{Auth, Session, Connection};
use App\Table\PostTable;
use App\HTML\Notification;
/*
    PAGE ADMINISTRATION DES ARTICLES (Liens vers Création / Modification / Suppression)
*/

Auth::check();

$session = new Session();
$messages = $session->getFlashes('flash');

$title = "Administration des articles";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');

[$posts, $pagination] = (new PostTable($pdo))->findPaginated(5);
//dd($posts);
foreach($posts as $post){
    //dd($post);

}

?>

<!-- LISTE DES ARTICLES (accueil de l'administation) -->
<div class="container">

    <h2 class="text-center mb-4">Administration des articles</h2>

    <!-- AFFICHE LES DIFFERENTES Notifications Utilisateur -->
    <?= Notification::toast($messages) ?>


    <!-- TABLEAU DES POSTS (articles) -->
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Titre</th>
            <th>Utilisateur (rôle)</th>
            <th>Categories</th>
            <th>Aperçu</th>
            <th>
                <!-- BOUTON DE CREATION D'UN ARTICLE -->
                <a href="<?= $router->url('admin_post_new') ?>" class="btn btn-dark">Créer un article</a>
            </th>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
                <?php //dd($post); ?>
            <tr>
                 <td>
                    <!-- ID DES ARTICLE -->
                    <?= htmlentities($post->getId()) ?>
                </td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getId()]) ?>">
                        <!-- TITRE DES ARTICLE -->
                        <?= htmlentities($post->getTitle()) ?>
                    </a>
                </td>
                <td>
                    <!-- NOM  ET ROLE DE L'UTILISATEUR -->
                    <?= $post->getAuthor()->getUsername() . ' <br> ' . '('  . $post->getAuthor()->getRole() .')' ?>
                </td>
                <td>
                    <!-- CATEGORIES DE L'ARTICLE -->
                    <?php foreach($post->getCategories() as $category): ?>
                        <li class='list-group'><small><?= $category->getName() ?></small></li>
                    <?php endforeach ?>
                </td>
                <td>
                    <!-- IMAGE (aperçu)  -->
                    <img src="../../assets/uploads/img-main/<?= $post->getPicture() ?>"
                        class="rounded float-left img-thumbnail img-fluid"
                        style="width: 120px; height: 70px; background-color: rgba(100,0,255,0.2);"
                        name="<?= $post->getPicture() ?>"
                        alt="<?= $post->getPicture() ?? "Pas d'illustration !" ?>"
                    >
                </td>
                <td>
                    <!-- BOUTON EDITER -->
                    <a href="<?= $router->url('admin_post', ['id' => $post->getId()]) ?>" class="btn btn-info">
                        Editer
                    </a>
                    <!-- FORMULAIRE pour SUPPRIMER (dans un 'form' pour éviter les problèmes de réduction d'url, car méthode 'POST' pour valider l'action) -->
                    <form action="<?= $router->url('admin_post_delete', ['id' => $post->getId()]) ?>" method="POST" style="display:inline"
                        onsubmit="return confirm('Voulez-vous vraiment effectuer la suppression ?')">
                        <!-- BOUTON SUPPRIMER -->
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr class="bg-primary my-4">

    <!-- PAGINATION -->
    <div class="d-flex justify-content-between my-4">
        <!-- LIEN PAGE PRECEDENTE -->
        <?= $pagination->previousLink($link) ?>
        <!-- LIEN PAGE SUIVANTE -->
        <?= $pagination->nextLink($link) ?>
    </div>

</div>