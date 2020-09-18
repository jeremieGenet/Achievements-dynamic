<!-- LAYOUT ADMINISTRATION -->
<!DOCTYPE html>
<!-- class "h-100" pour height 100% (et permettre de mettre le footer tout en bas)-->
<html lang="fr" class="h-100"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Affichera "Mon site" si la variable "$title" n'est pas définie -->
        <title>
            <?= $title ?? 'Mon site' ?> 
        </title>

        <!-- Style Bootstrap -->
        <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap_cyborg.css">

        <!-- Script ckeditor (éditeur de text) (basic/standard/standard-all/full) -->
        <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
    </head>

    <!-- class "d-flex h-100" pour height 100% (et permettre de mettre le footer tout en bas) -->
    <body class="d-flex flex-column h-100"> 
        <!-- HEADER DU SITE -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                <a class="navbar-brand" href="<?= $router->url('home') ?>">
                    <span class="logo-icon-wrapper"><img class="logo-icon" style="width: 20px;" src="../../assets/icons&logos/one_page/logo.svg" alt="logo site"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <!-- LIEN VERS LE BLOG -->
                            <a class="nav-link" href="<?= $router->url('achievements') ?>">Réalisations</a>
                        </li>
                        <li class="nav-item">
                            <!-- LIEN VERS L'intro du blog (page avec les images) -->
                            <a class="nav-link" href="<?= $router->url('admin_home') ?>">Administration</a>
                        </li>
                        <li class="nav-item">
                            <!-- LIEN VERS LA GESTION DES ARTICLES (édition/suppréssion) -->
                            <a class="nav-link" href="<?= $router->url('admin_posts') ?>">Articles</a>
                        </li>
                        <li class="nav-item">
                            <!-- LIEN VERS LA GESTION DES CATEGORIES (édition/suppréssion) -->
                            <a class="nav-link" href="<?= $router->url('admin_categories') ?>">Catégories</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                            
                        <?php if(isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <!-- MON PROFIL -->
                                <a class="btn btn-light btn-sm mr-2" href="<?= $router->url('account', ['idUser' => $_SESSION['user']['id']]) ?>">
                                    <?=$_SESSION['user']['username']?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- DECONNEXION (formulaire pour éviter que qqun puisse envoyer le lien et déconnecter l'utilisateur de force) -->
                                <form action="<?= $router->url('logout') ?>" method="POST" class="nav-item">
                                    <button type="submit" class="btn btn-warning btn-sm">Se déconnecter</button>
                                </form>
                            </li>
                        <?php elseif(empty($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <!-- S'INSCRIRE -->
                                <a class="btn btn-light mr-2" href="<?= $router->url('register') ?>">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <!-- SE CONNECTER -->
                                <a class="btn btn-primary" href="<?= $router->url('login') ?>">Se connecter</a>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </div>
            </nav>
            
            <!-- Debug session utilisateur (affichage) -->
            <?php 
                
                if(isset($_SESSION)){
                    var_dump($_SESSION);
                }
                if(isset($_SESSION['flash'])){
                    var_dump($_SESSION['flash']);
                }
                if(isset($_SESSION['infoUser'])){
                    var_dump($_SESSION['infoUser']);
                }

                //var_dump($_SERVER);
                //var_dump($_SERVER['HTTP_REFERER']); // Dernière url absolue visitée

            ?>
        </header>

        
        <!-- CONTENU DU SITE -->
        <div class="container-fluid my-4">
            <?= $content ?>
        </div> <!-- Fin de div container --> 


        <!-- FOOTER DE L'ENSEMBLE DES PAGES DE L'ESPACE MEMBRES -->
        <!-- "mt auto permet de caller le footer en bas de l'écran (il faut 'h-100' sur le body et le html-->
        <footer class="py-5 text-center text-dark mt-auto bg-secondary"> 
            <p>© 2025 by me. BLOG Proudly created with by my fingers</p>
            <!--Calcul du délai d'affichage de la page (DEBUG_TIME est un timestamp en mili-secondes) -->
            <p>Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms</p> 
        </footer>

        <!-- Les 2 scripts suivants servent au fonctionnement de bootstrap -->
        <script src="../../assets/plugins/jquery-3.3.1.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>

    </body>

</html>