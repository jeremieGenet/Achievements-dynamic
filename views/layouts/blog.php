<?php

use App\Connection;
use App\Table\CategoryTable;

$pdo = Connection::getPDO();
$tableCategories = new CategoryTable($pdo);
$categories = $tableCategories->findAll();
?>

<!-- LAYOUT DU BLOG -->
<!DOCTYPE html>
<html lang="fr" class="h-100"> 
<head>
    <title>
        <?= $title ?? 'Mon site' ?> 
    </title>
    <!-- Meta -->
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog qui regoupe mes réalisations">
	<meta name="author" content="Jérémie Genet">    
	<!-- Icon du site -->
	<link rel="shortcut icon" href="../../logo.png">

	<!-- Fontawesome -->
    <link href="../../assets/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../../assets/plugins/fontawesome/css/solid.css" rel="stylesheet"> 
	 
    <!-- Theme CSS -->  
	<link id="theme-style" rel="stylesheet" href="../../assets/css/blog/themes/theme-7_purple2-1.css">
	<!-- CSS perso --> 
	<link rel="stylesheet" href="../../assets/css/blog/index.css">
	<link rel="stylesheet" href="../../assets/css/blog/show.css">
</head> 

<body class="d-flex flex-column h-100">

	<header class="header text-center">	 
		  
		<h1 class="blog-name pt-4">
			<a href="<?= $router->url('home') ?>">
				<span class="logo-icon-wrapper"><img class="logo-icon" style="width: 20px;" src="../../assets/icons&logos/one_page/logo.svg" alt="logo site"></span> 
			</a>
			<strong>Blog de Jérémie</strong>
		</h1>
		
		<nav class="navbar navbar-expand-lg navbar-dark pt-0" >
			<button 
				class="navbar-toggler" 
				type="button" 
				data-toggle="collapse" 
				data-target="#navigation" 
				aria-controls="navigation" 
				aria-expanded="false" 
				aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >
				<div class="profile-section pt-3 pt-lg-0">
					<a href="<?= $router->url('cv') ?>">
						<img class="profile-image mb-3 rounded-circle mx-auto" src="../../assets/images/blog/maPhoto.jpg" alt="Ma photo" >			
					</a>
					<div class="bio mb-3">
						Hi, mon nom est Jeremie Genet. Passionné du web depuis de nombreuses années.
						<br><a class="__link-about-me" href="<?= $router->url('cv') ?>">En savoir plus sur moi</a>
					</div><!--//bio-->
					<ul class="social-list list-inline py-3 mx-auto">
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-github-alt fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li>
					</ul><!--//social-list-->
					<hr> 
				</div><!--//profile-section-->
				
				<ul class="navbar-nav flex-column text-left">
					<li class="nav-item active">
						<a class="nav-link" href='<?= $router->url('achievements') ?>'>
							<i class="fas fa-keyboard mr-2"></i>
							<strong>Voir mes réalisations</strong>
						</a>
					</li>
					<?php foreach($categories as $categorie): ?>
						<li class="nav-item">
							<!-- Lien vers les articles qui ont la même category -->
							<a class="nav-link" href="<?= $router->url('achievements-category', ['slug' => $categorie->getSlug(), 'id' => $categorie->getId()]) ?>">
								<i class="fas fa-arrow-circle-right"></i>
								<small class="ml-1"><span class="text-black">Réalisations '</span><strong><?= $categorie->getName() ?></strong>'</small>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				
				<div class="my-2 my-md-3">
					<!-- REDIRECTION vers la page contact (du one-page) -->
					<a class="btn btn-primary" href="<?= $router->url('home#contact') ?>" target="_blank">Get in Touch</a>
				</div>
			</div>
		</nav>
	</header>
	
	<!-- CONTENU DU SITE -->
	<main>
	<?php //dd($category); ?>
		<?= $content ?>	
	</main>
	
	<footer class="footer text-center mt-auto py-4 bg-primary">
		<?php require('inc/footer.php') ?>
	</footer>
    
    <!-- Javascript (jQuery, bootstrap) -->          
    <script src="../../assets/plugins/jquery-3.3.1.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script> 
    
</body>
</html> 

