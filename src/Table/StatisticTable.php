<?php
namespace App\Table;

use PDO;
use App\Models\User;
//use App\Table\PostTable;

// Permet de récup des statistiques sur les tables existantes
class StatisticTable{

    private $pdo;
    //private $postTable;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récup l'ensemble des utilisateur
    public function totalUser()
    {
        $userTable = new UserTable($this->pdo);
        $users = $userTable->findAll();
        return $total = count($users);
    }

    // Récup le nb d'utilisateur (en fonction du role)
    public function totalUserRoleUser()
    {
        $query = $this->pdo->query("SELECT COUNT(id) FROM user WHERE role = 'user'");
        //$query->setFetchMode(\PDO::FETCH_CLASS, User::class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        return (int)$query->fetch(PDO::FETCH_NUM)[0]; // retourne un nombre
    }

    // Récup le nb d'utilisateur (en fonction du role)
    public function totalUserRoleAdmin()
    {
        $query = $this->pdo->query("SELECT COUNT(id) FROM user WHERE role = 'admin'");
        //$query->setFetchMode(\PDO::FETCH_CLASS, User::class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        return (int)$query->fetch(PDO::FETCH_NUM)[0]; // retourne un nombre
    }

    /***************************************************************************************************************** */
    // Récup le nb moyen de réalisation par utilisateur
    public function averageRealizationPerUser()
    {
        $idUsers = [];

        $postTable = new PostTable($this->pdo);
        $posts = $postTable->findAllHydrated();
        //dd($posts);
        foreach($posts as $post){
            $idUsers[] = $post->getId();
        }
        //dd($idUsers);
        /*
        array:11 [▼
            0 => 1
            1 => 2
            2 => 3
            3 => 4
            4 => 5
            5 => 6
            6 => 7
            7 => 8
            8 => 9
            9 => 10
            10 => 11
        ]
        */

        foreach($idUsers as $key => $idUser){

            $nbIds = ['bonjour'];
            $query = $this->pdo->query("SELECT COUNT(id) FROM post WHERE author_id = $idUser");
            //$nbIdPerUser = (int)$query->fetch(PDO::FETCH_NUM)[0]; // Foncitionne mais
            //$query->setFetchMode(\PDO::FETCH_NUM);
            //var_dump($query->fetchAll()[0][0]);


            //dd($nbIds);
            
            //var_dump($nbIds);
            
            
        }
        //die();
        dd($nbIds);


        $query = $this->pdo->query("SELECT COUNT(id) FROM user");
        $nbUsers = (int)$query->fetch(PDO::FETCH_NUM)[0];

        for($i=0; $i<$nbUsers; $i++){
            $query = $this->pdo->query("SELECT id FROM user");
            
        }
        //dd($nbUsers);

        // récup l'id de tout les utilisateurs
        // Faire une boucle sur tout les id des utilisateur ($usersId)
            // Compte des id dans User qui ont un auteur_id similaire
            // COUNT(id) FROM User WHERE auteur_id = $usersId
            // Dans la fin de boucle insérer dans le tableau les résultats
        // Additionner les résultats et les diviser par le nb de user 
        
    }



}