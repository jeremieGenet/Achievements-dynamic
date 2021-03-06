# Portfolio dynamique V2.6-local (avec multi-layout)

## Technos :
  PHP, Javascript, Bootstrap (administration)

### Description :
    Site qui permet de créer et mettre en avant des réalisations (divers travaux réalisés en développement web, front ou back). 
  La page principale présente l'activité sous forme d'un site one-page avec présentation des dernières réalisations réalisées et
  lien vers le blog qui présente lui, l'ensemble des réalisations avec classement par catégorie, et le détail de celles-ci.
    L'administration du site permet de créer les réalisations dynamiquement et de les stocker en base de données (CRUD)
  Celles-ci sont administrables avec système de permissions (un utilisateur peut créer des réalisations, 
  et les gérer, mais ne pourra pas intervenir sur les réalisations d'autres utilisateurs), 
  alors que le statut d'admin permettra toute autorisations.

  #### Features :
  - espace membre (inscription, connexion)
  - Upload d'images et gestion de différentes collections d'images pour une réalisation (upload de fichier et fichier multiple)
  - Redimensionnement d'images/collections (pour avoir un affichage calibré lors de la présentation des réalisations)
  - Gestion de layout multiple.
  - Permissions d'administration
  
  #### URLS (principales):
  - https://jeremie-genet.fr
  - https://jeremie-genet.fr/cv
  - https://jeremie-genet.fr/realisations
  - https://jeremie-genet.fr/admin

### Objectifs :
  Mettre en pratique et intégrer de nouvelles connaissances (front ou back). 
  Structurer son code pour le rendre évolutif. 
  Eviter les framework et librairie au maximum (hormis bootstrap, particulièrement pour la partie administration du site), pour s'exercer un maximum.

#### Amélioration à prévoir :
Administration:
    ROUTER:
        - Gerer les Exceptions finales
        
    ESPACE MEMBRE :
        - Créer un formulaire de modification du profil d'utilisateur, avec ajout d'avatars.
        - Améliorer la page d'accueil de l'administration avec des stats sur les données du site (Nb d'articles, nb d'utilisateur)
        - Ajouter Une table 'categories' et mettre les catégories actuelles comme sous-catégories (Grosse Mise à jour à prévoir, et modif de la bdd et des relations)


#### Pour lancer le projet (serveur interne PHP sur le dossier "public") :
php -S localhost:8000 -t public


#### Outils installés :
* altorouter = librairie router
* PHPMailer = librairie d'envoi d'email (composer require phpmailer/phpmailer)
* fzaninotto/faker = fausse donnée pour notre bdd (dev)
* var_dumper = librairie qui permet un affichage propre des tableaux, objets... (dev)
* whoops = librairie d'aide à l'affichage et le débug des erreurs (dev)

