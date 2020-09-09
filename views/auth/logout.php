<?php

// Démarrage de la session, pour ensuite la détruire
session_start();
session_destroy();

// Redirection vers la page de connexion
header('Location: ' . $router->url('login')); // Redirection vers la page de connexion
exit(); // Pour quitter la page