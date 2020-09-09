<?php
/*
    PAGE D'ACCUEIL DE L'ADMINISTRATION
*/
use App\Table\PostTable;
use App\Table\UserTable;
use App\HTML\Notification;
use App\Table\StatisticTable;
use App\{Auth, Session, Connection};


// Vérif si l'utilisateur est autorisé à accéder à cette page
Auth::check();

$title = "Administration des articles";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');


//$postTable = new PostTable($pdo);
//$posts = $postTable->findAll();

$postTable = new PostTable($pdo);
$posts = $postTable->statistics();

$statisticTable = new StatisticTable($pdo);
$nbUser = $statisticTable->totalUser();
$nbUserRoleUser = $statisticTable->totalUserRoleUser();
$nbUserRoleAdmin = $statisticTable->totalUserRoleAdmin();

//$nb = $statisticTable->averageRealizationPerUser();
//dd($nb);

/*


*/

$session = new Session();
$messages = $session->getFlashes('flash');

//dd($messages);
//dd($posts);
?>

<div class="container-fluid">

    <!-- Notifications Utilisateur -->
    <?= Notification::toast($messages) ?>
  

    <div class="jumbotron">
        <h1 class="display-2 text-center">Statistiques du site</h1>
    </div>
    
    <div class="jumbotron">

        <h1 class="display-5">Utilisateurs</h1>
        <p class="lead">Statistiques regroupant les chiffres importants concernant les utilisateurs du site.</p>

        <hr class="my-4">

        <div class="alert alert-dismissible alert-secondary">
            <div class="row">
                <div class="col-md-6">
                    <strong><h5>Nombre total d'utilisateurs (user, admin)</h5> </strong> <a href="#" class="alert-link">Liste de tout les utilisateurs</a>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill float-right btn-lg"><?= $nbUser ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-dismissible alert-dark ">
            <div class="row"> 
                <div class="col-md-6">
                    <strong><h5>Nombre d'utilisateur qui ont le role 'user'</h5> </strong> <a href="#" class="alert-link">Liste des utilisateur qui ont le rôle 'user'</a>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill float-right btn-lg"><?= $nbUserRoleUser ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-dismissible alert-primary">
        <div class="row">
                <div class="col-md-6">
                    <strong><h5>Nombre d'utilisateur qui ont le role 'admin'</h5> </strong> <a href="#" class="alert-link">Liste des utilisateur qui ont le rôle 'admin'</a>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill float-right btn-lg"><?= $nbUserRoleAdmin ?></button>
                </div>
            </div>
        </div>
        <div class="alert alert-dismissible alert-secondary">
            <div class="row">
                <div class="col-md-6">
                    <strong><h5>Nombre moyen de réalisation par utilisateur (user, admin)</h5> </strong>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill float-right btn-lg">141</button>
                </div>
            </div>
        </div>
            
        
    </div>

  
   


    <div class="jumbotron">

        <h1 class="display-5">Réalisations</h1>
        <p class="lead">Statistiques regroupant les chiffres importants concernant les réalisations du site.</p>

        <hr class="my-4">

        <div class="alert alert-dismissible alert-secondary">
            <div class="row">
                <div class="col-md-6">
                    <strong><h5>Nombre total de réalisations </h5> </strong> <a href="#" class="alert-link">Liste des réalisations</a>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill float-right btn-lg">141</button>
                </div>
            </div>
        </div>
        <div class="alert alert-dismissible alert-dark ">
            <div class="row">
                <div class="col-md-6">
                    <strong><h5>Nombre de réalisations par catégorie</h5> </strong> <a href="#" class="alert-link">Liste des réalisations par catégorie</a>
                </div>
                <div class="col-md-6">
                    <button class="badge-info badge-pill btn-lg">Catégorie</button>
                    <button class="badge-pill btn-lg">141</button>
                    <button class="badge-info badge-pill btn-lg">Catégorie</button>
                    <button class="badge-pill btn-lg">141</button>
                </div>
            </div>
        </div>
        <div class="alert alert-dismissible alert-primary">
            <div class="row">
                <div class="col-md-6">
                    <strong><h5>Liste des réalisation par utilisateur</h5> </strong> <a href="#" class="alert-link">Voir la liste</a>
                </div>
            </div>
        </div>

    </div>


</div>


