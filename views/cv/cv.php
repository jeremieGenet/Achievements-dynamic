<?php

$title = "cv";

?>

<div class="container-fluid __cv" id="page-top">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <span class="d-block d-lg-none">Jérémie Genet</span>
            <span class="d-none d-lg-block mb-5">
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="../../assets/images/blog/maPhoto.jpg" alt="photo d'identité">
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div id="navbar-collapse" class="navbar-collapse collapse">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link scrollto" href="#about">PRÉSENTATION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scrollto" href="#experience-web">EXPÉRIENCES WEB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scrollto" href="#experience">EXPÉRIENCES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scrollto" href="#education">DIPLÔME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scrollto" href="#skills">COMPÉTENCES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scrollto" href="#interests">CENTRES D'INTÉRÊTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="../../assets/images/cv/Cv2.jpg">CV (téléchargeable)</a>
                </li>
                <!-- BOUTON DE RETOUR -->
                <li class="nav-item">
                    <a class="btn btn-primary mt-5" href="<?= $router->url('home') ?>">Home</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container p-0">

        <!-- PRÉSENTATION -->
        <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
            <div class="w-100">
                <h1 class="section-title mb-0">Jérémie
                    <span class="text-primary">GENET</span>
                </h1>
                <div class="subheading mb-5">5 rue de la fontaine 52310 Oudincourt
                    <a href="mailto:jeremiesamuel.genet@gmail.com">jeremiesamuel.genet@gmail.com</a>
                </div>
                <p class="lead mb-5">
                    <span id="__white">Motivé et dynamique</span>, je suis <span id="__white">curieux</span> de comprendre ce qui m'entoure.<br>
                    Je sais travailler seul, mais travailler en équipe est plus enrichissant, plus stimulant et j'ai 
                    <span id="__white">l'esprit d'équipe</span>.<br>
                    Les <span id="__white">responsabilités</span> ne sont pas un problème pour moi, et j'aime aller au bout des choses lorsque c'est possible. <br>
                    Jusqu'ici j'ai pu travailler dans des secteurs d'activités très variés (menuiserie, livraison, commerce, e-commerce et Web), en équipe ou en solo.<br>
                    Ces différentes expériences m'ont rendu <span id="__white">polyvalent</span> et m'ont permis de prendre du recul sur le monde du travail en général.
                </p>
                <div class="social-icons">
                    <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </section>

        <hr class="m-0 bg-white">

        <!-- EXPERIENCES WEB -->
        <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience-web">
            <div class="w-100">
                <h2 class="section-title mb-5">MES DERNIÈRES EXPÉRIENCES WEB</h2>

                <!-- ZOO D'AMNEVILLE -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            DEVELOPPEUR BACK & FRONT-END 
                            <span class="job_location">&nbsp;Zoo d'Amnéville</span>
                        </p>

                        <div class="subheading">
                            <span class="text-white">TECHNOS : &nbsp;</span>
                                <li class="list-inline-item">
                                    <i class="fab fa-html5"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-css3-alt"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-js"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-php"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-node"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-react"></i>
                                </li>
                        </div>
                        <p></p>
                        <p>
                            <span class="text-white pt-4">Description :</span>
                        </p>
                        
                        <ul>
                            <li>
                                Création en Back, d'une <span id="__white">API REST</span> en php et <span id="__white">MYSQL</span> 
                                qui permet d'ajouter/supprimer/modifier <span id="__white">(CRUD)</span> des animaux dans une base de donnée.<br>
                                L'objectif de cette API est de pouvoir communiquer avec le site principal, mais aussi avec l'application 
                                <span id="__white">REACT</span> qui sera la technologie choisis pour le futur site.<br>
                                La structure est en <span id="__white">MVC</span> et la <span id="__white">programmation orientée objet</span>.
                            </li>
                            <li>
                                Les animaux sont différenciés par Classe (vertébrés, mollusques, annélide...), Sous-classe (osseux, insectes...), Espèce, et Race.<br>
                                Avec autant de relations dans la base de donnée. L'API est '<span id="__white">RESTFul</span>' et communique en <span id="__white">JSON</span>. 
                            </li>
                            <li>
                                Création en Front, d'un prototype d'application <span id="__white">REACT</span> qui permet à différents employés, d'afficher et filter les informations reçus par l'API.<br>
                                Un espace de connexion et un système de permission permet d'avoir accès à divers informations.<br>
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Février 2020 à Juillet 2020</span>
                    </div>
                </div>

                <!-- THEMELIO -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            DEVELOPPEUR BACK & FRONT-END 
                            <span class="job_location">&nbsp;St Dizier</span>
                        </p>

                        <div class="subheading">
                            <span class="text-white">TECHNOS : &nbsp;</span>
                                <li class="list-inline-item">
                                    <i class="fab fa-html5"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-css3-alt"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-js"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-php"></i>
                                </li>
                        </div>
                        <p></p>
                        <p>
                            <span class="text-white pt-4">Description :</span>
                        </p>
                        
                        <ul>
                            <li>
                                A partir d'un site de gestion locative existant, ajout de plusieurs fonctionnalités sur l'application.
                            </li>
                            <li>
                                L'application en <span id="__white">PHP</span> vanilla et <span id="__white">MYSQL</span> pour la gestion de la base de donnée, 
                                permet de mettre en relation un propriétaire et un locataire, et de gèrer leurs différents échanges.<br>
                            </li>
                            <li>
                                Ajout de la recherche d'artisants pour un locataire en fonction de sa position géographique et d'un annuaire d'artisants.<br> 
                            </li>
                            <li>
                                Remise en place d'une architecture pour l'application.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Octobre 2019 à Décembre 2019</span>
                    </div>
                </div>

                <!-- SYMPHONY SYMBNB -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            DEVELOPPEUR BACK & FRONT-END 
                            <span class="job_location">&nbsp;Lyon (Bussa Immobilier)</span>
                        </p>

                        <div class="subheading">
                            <span class="text-white">TECHNOS : &nbsp;</span>
                                <li class="list-inline-item">
                                    <i class="fab fa-html5"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-css3-alt"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-js"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-php"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-symfony"></i>
                                </li>
                        </div>
                        <p></p>
                        <p>
                            <span class="text-white pt-4">Description :</span>
                        </p>
                        
                        <ul>
                            <li>
                                Création d'une application pour une agence immobilière qui permet à un utilisateur de mettre un bien en location
                                (comme airbnb) mais sous contrôle de l'agence.
                            </li>
                            <li>
                                L'application créée avec le framework <span id="__white">Symfony</span>, possède un espace de connexion, inscription, gestion de profil.<br>
                                Sa fonction principale est la possiblité d'enregistrer des biens et le les mettre à disposition à la location.
                            </li>
                            <li>
                                Le bien enregistré est lié à son utilisateur (qui à créé un compte), et il peut le modifier (sauf si le bien est réservé).<br>
                                Un calendrier des disponibilités du bien est mis à disposition des visiteurs.<br>
                                Le locataire peut noter et commenter le bien (une fois la location terminée). La note et commentaire sont affichés dynamiquement
                                sur le site et visible pour les futures locations.<br>
                                Les biens les mieux notés (moyenne des note du bien) sont mise en avant sur une page particulière de site.
                            </li>
                            <li>
                                Une administration permet à l'agence de gérer (<span id="__white">CRUD</span>), et modérer les biens, commentaires, utilisateurs et locataires.<br>
                                Un page de statistiques permet à l'administrateur de connaître les biens les plus loués, les mieux notés, le nombre de location par bien...
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Février 2019 à Mai 2019</span>
                    </div>
                </div>

                <!-- SITE PERSO -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            DEVELOPPEUR FRONT-END 
                            <span class="job_location">&nbsp;Chaumont</span>
                        </p>

                        <div class="subheading">
                            <span class="text-white">TECHNOS : &nbsp;</span>
                                <li class="list-inline-item">
                                    <i class="fab fa-html5"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-css3-alt"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fab fa-js"></i>
                                </li>
                        </div>
                        <p></p>
                        <p>
                            <span class="text-white pt-4">Description :</span>
                        </p>
                        
                        <ul>
                            <li>
                                Site static de présentation d'activité en <span id="__white">HTML</span>, <span id="__white">CSS</span>, et <span id="__white">Javascript</span>.
                            </li>
                            <li>
                                Le site est un one-page qui permet de présenter le client et son activité. Le Design du site est créé par un
                                designer professionnel.<br>
                                Le formulaire de contact et la gestion des email se fait en <span id="__white">PHP</span>.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Janvier 2019</span>
                    </div>
                </div>
                

            </div>
        </section>

        <hr class="m-0 bg-white">

        <!-- EXPÉRIENCES (hors web) -->
        <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience">
            <div class="w-100">
                <h2 class="section-title mb-5">MES EXPÉRIENCES (hors web)</h2>

                <!-- RESPONSABLE MULTI-RAYONS -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            RESPONSABLE MULTI-RAYONS
                            <span class="job_location">&nbsp;à Leclerc Chaumont</span>
                        </p>

                        <div class="subheading">
                            Rayons : <span class="rayons">&nbsp;Informatique, Téléphonie, Jeux vidéo, électroménager(PEM, GEM), Tv et Son</span>
                        </div>
                        <p></p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Management d'un équipe de 12 personnes (élargie en période de grande influence).
                            </li>
                            <li>
                                Gestion de l'approvisionnement, des stocks et de la rentabilité.
                            </li>
                            <li>
                                Formation des collaborateurs.
                            </li>
                            <li>
                                Participation aux réunions d'achats de la centrale d'achats (ScapAlsaces) et <br>
                                participation à la création de la centrale d'achat multimédia (particulièrement son site).
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Mai 2014 à Juillet 2017</span>
                    </div>
                </div>
                <!-- RESPONSABLE RAYONS -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">   
                    <div class="resume-content">
                        <p class="job">
                            RESPONSABLE RAYONS
                            <span class="job_location">&nbsp;à Leclerc Chaumont</span>
                        </p>

                        <div class="subheading">
                            Rayons : <span class="rayons">&nbsp;Informatique, Jeux vidéo, électroménager(PEM, GEM), Tv et Son</span>
                        </div>
                        <p></p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Management d'un équipe de 9 personnes (élargie en période de grande influence).
                            </li>
                            <li>
                                Gestion de l'approvisionnement et des stocks.
                            </li>
                            <li>
                                Formation des nouveaux collaborateurs.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Avril 2010 à Mai 2014</span>
                    </div>
                </div>
                <!-- ADJOINT RESPONSABLE DE RAYONS -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            ADJOINT RESPONSABLE RAYONS
                            <span class="job_location">&nbsp;à Leclerc Chaumont</span>
                        </p>

                        <div class="subheading">
                            Rayons : <span class="rayons">&nbsp;Informatique, Jeux vidéo, Tv et Son</span>
                        </div>
                        <p></p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Management d'un équipe de 4 personnes.
                            </li>
                            <li>
                                Gestion de l'approvisionnement, et des stocks.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Septembre 2008 à Avril 2010</span>
                    </div>
                </div>
                <!-- EMPLOYE COMMERCIAL -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            Employé COMMERCIAL
                            <span class="job_location">&nbsp;à Leclerc Chaumont</span>
                        </p>

                        <div class="subheading">
                            Rayons : <span class="rayons">&nbsp;Bazar Permanent et Saisonnier, puis Bazar Technique</span>
                        </div>
                        <p></p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Remplissage rayon, s'assurer des prix, traitement des arrivages, rangement des réserves...
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Mars 2005 à Septembre 2008</span>
                    </div>
                </div>
                <!-- LIVREUR ADA-->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            LIVREUR
                            <span class="job_location">&nbsp;pour ADA à Chaumont</span>
                        </p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Livraison des garages affiliés pour leur approvisionnement rapide de pièces détachées.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Février 2004 à Mars 2005</span>
                    </div>
                </div>
                <!-- MENUISIER-->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            MENUISIER
                            <span class="job_location">&nbsp;pour Matfor à Rimaucourt</span>
                        </p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Fabrication d'huisseries et portes en aluminium.
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Juillet 1999 à Février 2004</span>
                    </div>
                </div>



            </div>
        </section>

        <hr class="m-0 bg-white">

        <!-- SECTION DIPLOME -->
        <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="education">
            <div class="w-100">
                <h2 class="section-title mb-5">DIPLÔME</h2>

                <!-- FORMATION WEB -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            Bac + 2 WEBDESIGNER/WEBMASTER
                            <span class="job_location">&nbsp;Formation 31</span>
                        </p>
                        <p>Description :</p>
                        <ul>
                            <li>
                                Formation Diplômante de 4 mois (400 heures de cours + 200 heures stage)
                            </li>
                            <li>
                                Diplôme de Niv III (bac+2) certifié par le ministère du travail, obtenu en Mai 2018
                            </li>
                            <li>
                                Stage fait à Reims et le projet était l'aide à la restructuration du site de l'association bénévole "Papillons Blancs en Champagne"
                            </li>
                        </ul>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">Septembre 2017 à fin Décembre 2017</span>
                    </div>
                </div>
                <!-- BAC PRO CAB -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            Bac Pro CAB (Construction et Aménagement du Batiment)
                            <span class="job_location">&nbsp;à Chaumont</span>
                        </p>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">1997-1999</span>
                    </div>
                </div>
                <!-- BEP CAP -->
                <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="resume-content">
                        <p class="job">
                            BEP et CAP Menuiserie
                            <span class="job_location">&nbsp;à Romilly sur Seine</span>
                        </p>
                    </div>
                    <div class="resume-date text-md-right">
                        <span class="text-primary">1995-1997</span>
                    </div>
                </div>

            </div>
        </section>

        <hr class="m-0 bg-white">

        <!-- SECTION COMPETENCE -->
        <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="skills">
            <div class="w-100">
                <h2 class="section-title mb-5">COMPÉTENCES</h2>

                <div class="subheading mb-3">
                    Informatique :
                </div>
                <p class="competences_explication">
                    J'ai de bonnes connaissances sur la suite de <strong>Office de Microsoft</strong>.
                </p>
                <ul class="list-inline dev-icons">
                    <li class="list-inline-item">
                        <i class="fas fa-file-excel"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-file-word"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fas fa-file-powerpoint"></i>
                    </li>
                </ul>

                <div class="subheading mb-3">
                    Langages de Programation &amp; outils/technos :
                </div>
                <li>
                    <p class="competences_explication">
                        En langages front pour le web je connais évidemment bien <span id="__white">HTML, CSS et Javascript</span> (indispensables).<br>
                        <span id="__white">Bootstrap</span> est le framework que je privilègie lorsque que je dois prototyper une application, ou tester une nouvelle techno,
                        mais <span id="__white">Bluma</span> est une bonne alternative que j'utilise parfois. 
                        Lorsque je fais du style en front, j'utilise exclusivement <span id="__white">SASS</span> comme pré-processeur.<br>
                        Coté Back en web j'ai une préférence pour le <span id="__white">PHP</span> qui est à mon avis le langage le plus "mûr" coté serveur.
                        Mais en Back, j'aime aussi beaucoup codé en <span id="__white">Javascript</span> à l'aide de <span id="__white">NodeJs</span>, 
                        la possiblité d'asyncrone des requêtes HTTP rend l'expérience utilisateur plus fluide.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="competences_explication">
                        Concernant les <span id="__white">Framework/Librairies</span>, en PHP j'ai pu tester <span id="__white">Laravel</span> rapidement, 
                        mais c'est avec <span id="__white">Symfony</span> que je me sens le plus à l'aise.<br>
                        Sa flexibilité, sa documentation, et sa communauté font que c'est pour moi le framework ultime pour le moment.
                        Et j'ai surtout l'expérience de plusieurs gros projets sur ce framework.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="competences_explication">
                        Pour les les <span id="__white">Framework/Librairies</span>, en <span id="__white">Javascript</span> 
                        (sans parler de <span id="__white">NodeJs</span> qui est indispensable et permet à lui seul de faire de petites applications),
                        <span id="__white">React</span> est pour moi le Framework/Librairie le plus intéressant d'un point de vue expérience utilisateur.<br>
                        J'ai découvert récemment (sur un petit projet perso) <span id="__white">Vue.Js</span> que je trouve très intéressant, léger et très facile à mettre en place.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="competences_explication">
                        En dehors du Web, j'ai de bonne notions en <span id="__white">C</span>, un langage bas niveau qui se perd un peu mais très intéressant pour comprendre
                        un peu mieux la gestion de mémoire avec le typage des variables, mais surtout les notions de pointeurs.<br>
                        Je sais aussi codé en <span id="__white">LUA</span>, un langage de script très facile à apprendre. Et avec <span id="__white">LOVE</span> 
                        (Librairie LUA) il peut permettre de créer jeux vidéo plutôt facilement.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="competences_explication">
                        Beaucoup d'autres outils me sont utiles lors de mes développements, en vrac: <span id="__white">Faker</span> 
                        (librairie d'infos fake), <span id="__white">Material-ui</span> (librairiede composant React ou Vue.js), 
                        <span id="__white">Formik</span> (permet la vérification et validation rapide de formulaire avec REACT).
                        <span id="__white">PHPMailer, var_dumper, whoops</span>...
                    </p>
                </li>
                
                <ul class="list-inline dev-icons p-4">
                    <li class="list-inline-item">
                        <i class="fab fa-html5"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-css3-alt"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-php"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-symfony"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-js-square"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-react"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-node"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-sass"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-wordpress"></i>
                    </li>
                    <li class="list-inline-item">
                        <i class="fab fa-npm"></i>
                    </li>
                </ul>

                <div class="subheading mb-3">Autre</div>
                <ul class="fa-ul mb-0">
                    <li class="mb-1">
                        <i class="fa-li fa fa-check"></i>
                        Expériences et connaissance en management.
                    </li>
                    <li class="mb-1">
                        <i class="fa-li fa fa-check"></i>
                        Connaissances en gestion de stock et d'approvisionnement.
                    </li>
                    <li class="mb-1">
                        <i class="fa-li fa fa-check"></i>
                        Connaissance générales en e-commerce et marketing.
                    </li>
                </ul>
            </div>
        </section>

        <hr class="m-0 bg-white">

        <!-- SECTION CENTRES D'INTERÊT -->
        <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="interests">
            <div class="w-100">
                <h2 class="section-title mb-5">CENTRES D'INTÉRÊTS</h2>
                <li>
                    <p class="mb-1">
                        Le sport en général.<br>
                        J'ai joué au football plus de dix ans en compétition à un niveau local certe, mais un niveau qui permet de s'amuser.<br>
                        Le VTT, la natation et la pétanque (lol) sont aussi des sports que je pratique toujours.
                        Mais au dela du sport, c'est la compétition que m'attirais le plus.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="mb-1">
                        La culture asiatique m'a toujours rendu curieux. Particulièrement la Corée, le Japon et la Chine.<br>
                        La <span id="__white">Corée</span> probablement parce qu'une telle différence culturelle entre le Nord et le Sud est frappante, et fait réfléchir.
                        Le <span id="__white">Japon</span>, un des pays les plus isolé au monde et pourtant technologiquement pionnié. Et culturellement plein de paradoxes.
                        La <span id="__white">Chine</span>, parce qu'il savent faire les meilleurs nouilles au monde!!!
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="mb-1">
                        Cuisiner et déguster. Plus que la cuisine, c'est le partage qui me plaît le plus, faire un bon repas avec les personnes qu'on aime.<br>
                        <span id="__white">Cuisiner c'est aimer.</span> Un dicton que j'aime beaucoup.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="mb-1">
                        La culture web et geekerie en tout genre. J'aime le cinéma, les série TV (THE BOYS!!!!), la litérature,
                        le sport électronique et les jeux vidéo.<br>
                        Je m'intéresse très facilement de façon générale.
                    </p>
                </li>
                <p></p>
                <li>
                    <p class="mb-1">
                        J'ai été community manager du site <span id="__white">Hedge.fr</span> pendant cinq ans, et j'ai développé 
                        le forum de <span id="__white">puissance-zelda.com</span> dans sa version 2.<br>
                        Mon intérêt pour la licence Zelda m'a aussi permis de développer un wiki Zelda qui n'est plus en ligne aujourd'hui.
                    </p>
                </li>
            </div>
        </section>

        <hr class="m-0">

    </div>

</div>