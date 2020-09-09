# Portfolio dynamique (avec multi-layout)

## Technos :
  PHP, Javascript, Bootstrap (administration)

### Description :
  Site qui permet de créer et mettre en avant des réalisations (divers travaux réalisés en développement web, front ou back). 
  Les réalisations sont créées dynamiquement et stockées en base de données, puis mise en avant via divers pages du site. 
  Celles-ci sont administrables avec système de permissions (un utilisateur peut créer des réalisations, 
  et les gérer, mais ne pourra pas intervenir sur les réalisations d'autres utilisateurs), 
  alors que le statut d'admin permettra toute autorisations.

### Objectifs :
  Mettre en pratique et intégrer de nouvelles connaissances (front ou back). 
  Structurer son code pour le rendre évolutif. 
  Eviter les framework et librairie au maximum (hormis bootstrap, particulièrement pour la partie administration du site), pour s'exercer un maximum.

#### Amélioration à prévoir :
Administration:
    ESPACE MEMBRE :
        - Créer un affichage du profil de l'utilisateur
        - Créer un formulaire de modification du profil d'utilisateur, avec ajout d'avatars.

        - Améliorer les messages (feedback) utilisateur avec disparition du message après quelques secondes (sleep()?)
        - Créer la page d'accueil de l'administration avec des stats sur les données du site (Nb d'articles, nb d'utilisateur)


#### Pour lancer le projet (serveur interne PHP) :
php -S localhost:8000 -t public


#### Outils installés :
* altorouter = librairie router
* fzaninotto/faker = fausse donnée pour notre bdd (dev)
* var_dumper = librairie qui permet un affichage propre des tableaux, objets... (dev)
* whoops = librairie d'aide à l'affichage et le débug des erreurs (dev)

