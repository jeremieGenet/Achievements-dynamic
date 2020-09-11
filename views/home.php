<?php
/*
    PAGE D'ACCUEIL DU SITE (one_page)
*/
use App\HTML\Form;
use App\Session;
use App\Connection;
use App\Table\PostTable;

$title = "Web développeur : Création et refonte de site web, Ajout de fonctionnalité, SEO...";

$session = new Session();
$pdo = Connection::getPDO();

//$posts = (new PostTable($pdo))->findByCategory(1, 3);
$posts = (new PostTable($pdo))->findLatest(6);
//dd($posts);
$errors = [];
// Instanciation du formulaire de contact
$form = new Form($_POST, $errors);
?>


<!--  STD-WEB   LES STANDARD DU WEB AU SERVICE DE VOS PROJETS -->
<div id="std-web" class="std-web">
    <div class="container text-center">
        <h2 class="section-title">Les <strong>standards du web</strong> au service de vos projets</h2>
        <p class="intro">Quelques langages/outils qui vous permettront d'atteindre vos objectifs numériques</p>
        <ul class="logo-web list-inline">
            <li class="list-inline-item"><img src="../assets/icons&logos/one_page/logo-html5.svg" alt="HTML5"></li>
            <li class="list-inline-item"><img src="../assets/icons&logos/one_page/logo-css3.svg" alt="CSS3"></li>
            <li class="list-inline-item"><img src="../assets/icons&logos/one_page/logo-bootstrap.svg" alt="Bootstrap"></li>
            <li class="list-inline-item"><img src="../assets/icons&logos/one_page/PHP_128x128.png" alt="less"></li>
            <li class="list-inline-item"><img src="../assets/icons&logos/one_page/javascript_128x128.png" alt="less"></li>
            
            <hr class="separator"><!---------------------------------------------------------------------------------->
        </ul>

        <!-- Cards 3D (effet 3D) (Attention, CSS particulier pour les 3 Cards = card-3D.css) -->
        <div class="row __cards">

            <div class="col-lg-4 col-md-12 mb-4">
                <h3 class="item-title-main"><strong>Analyse</strong></h3>
                <div class="__card middle">
                    <div class="front">
                        <img src="../assets/images/one_page/figure-1.png" alt="Etude & Réflexion">
                    </div>
                    <div class="back">
                        <div class="back-content middle">
                            <h3 class="item-title">Etude & Réflexion</h3>
                            <div class="item-desc">
                                D'abord réfléchir et analyser le projet pour en déterminer le design et les outils adaptés qui amèneront à sa réalisation. 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <h3 class="item-title-main"><strong>Réalisation</strong></h3>
                <div class="__card middle">
                    <div class="front">
                        <img src="../assets/images/one_page/figure-2.png" alt="Design & développement">
                    </div>
                    <div class="back">
                        <div class="back-content middle">
                            <h3 class="item-title">Design & développement</h3>
                            <div class="item-desc">
                                En accord avec le design déterminé, coder l'application avec les outils déterminées.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <h3 class="item-title-main"><strong>Contrétisation</strong></h3>
                <div class="__card middle">
                    <div class="front">
                        <img src="../assets/images/one_page/figure-3.png" alt="Finition & mise en production">
                    </div>
                    <div class="back">
                        <div class="back-content middle">
                            <h3 class="item-title">Finition & mise en production</h3>
                            <div class="item-desc">
                                Apporter les finitions et corrections, puis mettre l'application en ligne pour enfin concrétiser le projet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- LANGUAGES -->
<div id="languages" class="languages-section"> <!-- class="testimonials-section" -->
    <div class="container">
        <h2 class="section-title text-center  text-dark">Les<strong> principaux langages </strong>du Web </h2>
        <div class="item mx-auto">
            <div class="profile-holder">
                <img class="profile-image" src="../assets/icons&logos/one_page/logo-html5.svg" alt="HTLM5" alt="profile">
            </div>
            <div class="quote-holder">
                <blockquote class="quote">
                    <h3 class="text-center text-dark">HTML 5</h3>
                    <p>
                        Dernière évolution majeur (Hyper Text Language 5), le HTML est un langage d'organisation, ou de 'balisage'. 
                        Ses balises permettent de donner du sens au contenu d'un site, et sont essentielles au fonctionnement des autres langages Web qui lui sont associés.
                        Sans HTML, une page web n'a aucun sens pour les moteurs de recherche.
                    </p>
                    <div class="quote-source">
                        <span class="meta">La base du Web</span>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="item item-reversed mx-auto">
            <div class="profile-holder">
                <img class="profile-image" src="../assets/icons&logos/one_page/logo-css3.svg" alt="CSS3">
            </div>
            <div class="quote-holder">
                <blockquote class="quote">
                    <h3 class="text-center text-dark">CSS 3</h3>
                    <p>
                        Feuilles de style en cascade, le CSS (Cascading Style Sheets) est un langage qui décrit la présentation des document HTML ou XML.
                        Il permet de donner du style (couleurs, dimensions, animations, placements...) aux éléments HTLM d'un site et le rend plus agréable
                        à regarder (ou pas).
                    </p>
                    <div class="quote-source">
                        <span class="meta">Le style du Web</span>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="item mx-auto">
            <div class="profile-holder">
                <img class="profile-image" src="../assets/icons&logos/one_page/javascript_128X128.png" alt="Javascript">
            </div>
            <div class="quote-holder">
                <blockquote class="quote">
                    <h3 class="text-center text-dark">Javascript</h3>
                    <p>
                        Langage de programmation de scripts employé principalement dans les pages web interactives, mais aussi pour les serveurs.
                        Il est orienté objet à prototype et permet de manipuler le HTML très facilement.
                    </p>
                    <div class="quote-source">
                        <span class="meta">L'interactivité du Web</span>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="item item-reversed mx-auto">
            <div class="profile-holder">
                <img class="profile-image" src="../assets/icons&logos/one_page/PHP_128X128.png" alt="PHP">
            </div>
            <div class="quote-holder">
                <blockquote class="quote">
                    <h3 class="text-center text-dark">PHP</h3>
                    <p>
                        Hyper Preprocessor, ou PHP est un langage de programmation libre orienté objet. Principalement utilisé pour produire des pages Web dynamiques
                        via un serveur HTTP, mais peut fonctionner comme n'importe quel langage interprété de façon locale.
                        PHP est considéré comme une des bases de la création de sites web et applications dynamiques.
                    </p>
                        <div class="quote-source">
                        <span class="meta">Le back-end du Web</span>
                    </div>
                </blockquote>
                
            </div>
        </div>
    </div>
</div><!--//languages-->

<!-- REALISATIONS (achievements) -->
<div id="achievements" class="achievements-section">
    <div class="container-fluid">
        <h2 class="section-title text-center text-dark mb-5"><strong>Dernières réalisations</strong></h2>

        <?php require ('_inc/card.php') ?>
        <?php //require ('_inc/card-carousel.php') ?>
        <?php //require ('_inc/card-hover.php') ?>
        <?php //require ('_inc/card-3D.php') ?>

    </div>
</div>

<!-- MES SERVICES -->
<div id="services" class="services-section">
    <div class="container text-center">
        <header class="mb-5">
            <h2 class="services-title">MES <strong>SERVICES</strong></h2>
            <p class="services-intro">Des prestations adaptées à vos besoins</p>
        </header>
        <div class="bg-services">
            <div class="row services">
                <!-- Services (gauche) -->
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="row services-icons-texts-1">
                        <div class="col-md-9">
                            <h4 class="services-titles">Gestion & Conception de projets Web</h4>
                            <p>Site vitrine, corporate, évènementiel, <br> e-commerce, intranet, application mobile.</p>
                        </div>
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-keyboard fa-2x"></i>
                        </div>
                    </div>
                    <div class="row services-icons-texts-2">
                        <div class="col-md-9">
                            <h4 class="services-titles">Intégration Web</h4>
                            <p>Des intégrations HTML & CSS <br> qui respectent les standards du Web.</p>
                        </div>
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-laptop-code fa-2x"></i>
                        </div>
                    </div>
                    <div class="row services-icons-texts-1">
                        <div class="col-md-9">
                            <h4 class="services-titles">Développement Spécifiques</h4>
                            <p>Outils adaptés à votre coeur de métier, <br> application & solutions personnalisées.</p>
                        </div>
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-marker fa-2x"></i>
                        </div>
                    </div>
                    <div class="row services-icons-texts-2">
                        <div class="col-md-9">
                            <h4 class="services-titles">Référencement Naturel</h4>
                            <p>Affichage sémantique des informations <br> pour un référencement optimal.</p>
                        </div>
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-sitemap fa-2x"></i>
                        </div>
                    </div>
                </div>

                <!-- Image au centre des Services -->
                <div class="col-xs-12 col-md-2 d-none d-lg-block">
                    <img class="figure-image img-fluid m3" src="../assets/images/one_page/figure-1.png" alt="image" />
                    <img class="figure-image img-fluid m3" src="../assets/images/one_page/figure-2.png" alt="image" />
                    <img class="figure-image img-fluid m3" src="../assets/images/one_page/figure-3.png" alt="image" />
                </div>

                <!-- Services (droite) -->
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="row services-icons-texts-1">
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-drafting-compass fa-2x"></i>
                        </div>
                        <div class="col-md-9">
                            <h4 class="services-titles">Conception Graphique & WebDesign</h4>
                            <p>Logos, templates Web, plaquettes publicitaires,<br> carte de visite, charte graphique...</p>
                        </div>
                    </div>
                    <div class="row services-icons-texts-2">
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-project-diagram fa-2x"></i>
                        </div>
                        <div class="col-md-9">
                            <h4 class="services-titles">Pages Dynamiques</h4>
                            <p>Des animations de contenu non intrusives<br> pour améliorer vos projets.</p>
                        </div>
                    </div>    
                    <div class="row services-icons-texts-1">
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-database fa-2x"></i>
                        </div>
                        <div class="col-md-9">
                            <h4 class="services-titles">Interface d'administration</h4>
                            <p>Outils spécifiques au bon fonctionnement <br>de votre entreprise.</p>
                        </div>
                    </div>
                    <div class="row services-icons-texts-2">
                        <div class="col-md-3 mt-3 d-none d-lg-block">
                            <i class="services-icon fas fa-tablet-alt fa-2x"></i>
                        </div>
                        <div class="col-md-9">
                            <h4 class="services-titles">Responsive Design</h4>
                            <p>Compatible et adapté tous supports,<br> tablettes, mobiles et ordinateurs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--//container-->
</div><!--//Mes services-->


<!-- CONTACT -->        
<div id="contact" class="contact-section">
    <div class="container-fluid">
        
        <div class="text-center">
            <h2 class="section-title-contact"><strong>Contactez-moi</strong></h2>
            <div class="contact-content">
                <p>
                    Une question ? Un projet ? N'hésitez pas à me contacter. 
                    Préciser bien l'objet de votre demande, je vous ferais une réponse aussi rapide que possible.
                </p>
            </div>
        </div>

        
        <div class="d-flex justify-content-center">
            <div class="contact-form">
                <form>
                    <div>
                        <input type="text" name="" required="">
                        <label>Nom & Prénom</label>
                    </div>
                    <div>
                        <input type="text" name="" required="">
                        <label>Email</label>
                    </div>
                    <div>
                        <input type="text" name="" required="">
                        <label>Téléphone</label>
                    </div>
                    <div>
                        <textarea name="" id="" cols="30" rows="10" required=""></textarea>
                        <label>Message</label>
                    </div>
                    <input type="submit" name="" value="Envoyer">
                </form>
            </div>
        </div>

    </div><!--//container-->
</div><!--//contact-section-->

