<?php

/*
    VARIABLES D'ENVIRONEMENT

    - (cluster027) => new PDO('mysql:host=jeremiegchovh.mysql.db;dbname=jeremiegchovh','jeremiegchovh','1664166433Expor',[...  
    - (cluster026)=> new PDO('mysql:host=jeremiegwy96.mysql.db;dbname=jeremiegwy96','jeremiegwy96','1664166433Expor',[....
*/

// Variable de connexion en PROD (domaine => http://jeremie-genet.fr)
$_ENV['prod']['host'] = 'host=jeremiegwy96.mysql';
$_ENV['prod']['dbname'] = 'jeremiegwy96';
$_ENV['prod']['username'] = 'jeremiegwy96';
$_ENV['prod']['password'] = '1664166433Expor';

// Variable de connexion en local
$_ENV['local']['host'] = 'localhost';
$_ENV['local']['dbname'] = 'portfolio2';
$_ENV['local']['username'] = 'root';
$_ENV['local']['password'] = '';

// Variable d'env de la direction d'envoi du formulaire de contact (nom de domaine de l'hébergeur)
$_ENV['form-contact-email'] = "http://jeremie-genet.fr";