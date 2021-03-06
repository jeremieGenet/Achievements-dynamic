<!-- LAYOUT DE ONE-PAGE -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Affichera "Mon site" si la variable "$title" n'est pas définie -->
    <title>
        <?= $title ?? 'Mon site' ?> 
    </title>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Développement Web, jeremie-genet.fr">
    <meta name="author" content="Jérémie Genet">

    <!-- Icon du site -->
    <link rel="shortcut icon" href="logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="../../assets/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/solid.css" rel="stylesheet">  
    
    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- FontAwesome JS 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" 
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    -->
    <!-- Css Bootstrap -->
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.css">   
    <!-- Css GENERAL One_page -->  
    <link rel="stylesheet" href="../../assets/css/one_page/one_page.css">
    
    <!-- Css Cards 3D (effet 3D des 3 images de la section STD-WEB) -->  
    <link rel="stylesheet" href="../../assets/css/one_page/card-3D.css">
    <!-- Css Cards des réalisations (bootstrap) -->
    <link rel="stylesheet" href="../../assets/css/one_page/card.css">
    <!-- CSS du formulaire de contact -->
    <link rel="stylesheet" href="../../assets/css/one_page/contact-form.css">
    
</head> 

<body>
    <!-- Debug session utilisateur (affichage) -->
    <?php 
        /*
        if(isset($_SESSION)){
            var_dump($_SESSION);
        }
        if(isset($_SESSION['flash'])){
            var_dump($_SESSION['flash']);
        }
        if(isset($_SESSION['infoUser'])){
            var_dump($_SESSION['infoUser']);
        }
        */
    ?>

    <header id="header" class="header">  
        <!-- NAVBAR -->
        <div class="container">       
            <h1 class="logo">
                <!-- LOGO -->
                <span class="logo-icon-wrapper"><img class="logo-icon" src="../../assets/icons&logos/one_page/logo.svg" alt="logo site"></span>
            </h1>
            <nav class="main-nav navbar-expand-md float-right navbar-inverse" role="navigation">
                <!-- TOGGLE NAV -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- NAV BAR-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav mr-5">
                        <li class="nav-item"><a class="active nav-link scrollto" href="#hero">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#languages">Web</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#achievements">Réalisations</a></li>
                        <li class="nav-item"><a class="nav-link scrollto" href="#services">Services</a></li>                        
                        <li class="nav-item"><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        <li class="nav-item ml-5"><a class="nav-link" target="_blank" href="/realisations">Blog</a></li>
                    </ul>
                </div>
            </nav>                    
        </div>
    </header>
    
    <!-- CAROUSSEL -->
    <div id="hero" class="hero-section">
        <div id="hero-carousel" class="hero-carousel carousel carousel-fade slide" data-ride="carousel" data-interval="10000">
            <div class="figure-holder-wrapper">
        		<div class="container d-none d-lg-block">
            		<div class="row justify-content-end">
                		<div class="figure-holder">
                            <!-- IMAGE IMAC -->
                            <a href="<?= $router->url('cv') ?>">
                                <img class="figure-image img-fluid" src="../../assets/images/one_page/imac3.png" alt="image" />
                            </a>
                        </div>
            		</div>
        		</div>
    		</div>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#hero-carousel"></li>
				<li data-slide-to="1" data-target="#hero-carousel"></li>
				<li data-slide-to="2" data-target="#hero-carousel"></li>
			</ol>
			<!-- Wrapper des items du caroussel -->
			<div class="carousel-inner">
                <!-- ELEMENT 1 caroussel -->
				<div class="carousel-item item-1 active">
					<div class="item-content container">
    					<div class="item-content-inner">
				            <h2 class="heading">Créer un site ou <br class="d-none d-md-block">une application Web ?</h2>
				            <p class="intro">Vous avez une idée de site ou d'application Web et vous désirez la concrétiser...</p>
                            <a class="btn btn-primary btn-cta scrollto" href="#services" >
                                Voir mes services
                            </a>
    					</div>
					</div>
				</div>
				<!-- ELEMENT 2 caroussel -->
				<div class="carousel-item item-2">
					<div class="item-content container">
						<div class="item-content-inner">
    				        
				            <h2 class="heading">Votre site ou application Web a besoin d'être modifié, rénové ou plus visible ?</h2>
				            <p class="intro">Ajouter des fonctionnalités, perfectionner le design ou l'expérience utilisateur, améliorer sa visibilité (SEO).</p>
                            <a class="btn btn-primary btn-cta scrollto" href="#services" >
                                Voir mes services
                            </a>
    					</div>
					</div>
				</div>
				<!-- ELEMENT 3 caroussel -->
				<div class="carousel-item item-3">
					<div class="item-content container">
						<div class="item-content-inner">
				            <h2 class="heading">Besoin de conseils sur les technos à employer pour vos projets Web ?</h2>
				            <p class="intro">Déterminer en amont les langages de programmation à utiliser, et surtout les outils qui permettront un développement en raccord avec vos objectif.</p>
                            <a class="btn btn-primary btn-cta scrollto" href="#services">
                                Voir mes services
                            </a>

    					</div>
					</div>
				</div>
			</div>
		</div>
    </div><!-- Fin du Caroussel-->

    <!-- CONTENU DU SITE -->
    <main class="">
        <?= $content ?>
    </main>
    
    <!-- Footer -->
    <footer class="footer text-center">
        <?php require('inc/footer.php') ?>
    </footer>
    
    
     
    <!-- JAVASCRIPT -->  
    <!-- Jquery v3.3.1 (utile au fonctionnement de bootstrap, et de jquery.scrollTo) -->        
    <script type="text/javascript" src="../../assets/plugins/jquery-3.3.1.min.js"></script>
    <!-- Javascript utile au fonctionnement de Bootstrap -->
    <script type="text/javascript" src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Utile au fonctionnement du scroll de jquery.scrollTo.js -->
    <script type="text/javascript" src="../../assets/plugins/jquery-scrollTo/jquery.scrollTo.js"></script>
    <!-- Gestion du scroll de la page en jquery (class 'scrollto') -->
    <script type="text/javascript" src="../../assets/js/common/scroll-navigation.js"></script>
     
       
</body>
</html> 

