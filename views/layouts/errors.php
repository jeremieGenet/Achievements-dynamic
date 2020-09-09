<!-- LAYOUT DE LA PAGE D'ERREURS -->
<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <!-- Affichera "Mon site" si la variable "$title" n'est pas définie -->
    <title>
        <?= $title ?? 'erreur' ?> 
    </title>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rapide aperçu de quelques projets perso, et présentation rapide">
    <meta name="author" content="Jeremie Genet">    

    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Css Bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css">   
    <!-- Css One_page -->  
    <link rel="stylesheet" href="../../assets/css/one_page/one_page.css">
    
</head> 

<body class="d-flex flex-column h-100">
    <header id="header" class="header">  
        
    </header>
    
    <!-- CAROUSSEL -->
    <div id="hero" class="hero-section">
        <div id="hero-carousel" class="hero-carousel carousel carousel-fade slide" data-ride="carousel" data-interval="10000">
            
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
                        
                        <!-- Affichage Erreur -->
                        <div class="container-fluid mt-5">
                            <?= $content ?>
                        </div>

    					<div class="item-content-inner">
                            <!-- VIDE -->
                        </div>
                        
					</div>
				</div>
				<!-- ELEMENT 2 caroussel -->
				<div class="carousel-item item-2">
					<div class="item-content container">

                        <!-- Affichage Erreur -->
                        <div class="container-fluid mt-5">
                            <?= $content ?>
                        </div>

						<div class="item-content-inner">
    				        <!-- VIDE -->
                        </div>
                        
					</div>
				</div>
				<!-- ELEMENT 3 caroussel -->
				<div class="carousel-item item-3">
					<div class="item-content container">
                        <!-- Affichage Erreur -->
                        <div class="container-fluid mt-5">
                            <?= $content ?>
                        </div>
						<div class="item-content-inner">
                            <!-- VIDE -->
                        </div>
                        
					</div>
				</div>
			</div>

		</div>
    </div><!-- Fin du Caroussel-->
    
    <!-- CONTENU DU SITE -->
    <a class="btn btn-primary btn-lg" href="<?= $router->url('home') ?>" >
        Retour
    </a>
    <div class="container-fluid my-4">
        <?= $content ?>
    </div>
    


    <footer class="footer text-center mt-auto">
        <div class="container">
            <small class="copyright">
                <p>© 2018 - 2020. <strong>Proudly</strong> created with by my fingers <i class="fas fa-heart"></i></p> 
                <p>Page générée en <a href=""><strong><?= round(1000 * (microtime(true) - DEBUG_TIME)) ?></strong> millisecondes</a></p>
            </small>
        </div>
    </footer>
     
    <!-- JAVASCRIPT -->  
    <!-- Jquery v3.3.1 (utile au fonctionnement de bootstrap) -->        
    <script type="text/javascript" src="../assets/plugins/jquery-3.3.1.min.js"></script>
    <!-- Javascript utile au fonctionnement de Bootstrap -->
    <script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

       
</body>
</html> 

