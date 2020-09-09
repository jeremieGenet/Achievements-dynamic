<?php
namespace App\Table;

use App\Models\User;
use App\Table\Exception\NotFoundException;


// Gère les requêtes de la table "user" (table des utilisateurs)
class UserTable extends Table{

    // Ces 2 propriétés permettent de donner les infos nécessaires à la class Table.php
    protected $table = "user"; // Nom de la table dans la bdd
    protected $class = User::class; // Class qui défini le mode de recherche dans la bdd

    /*
        METHODES DANS LE MODEL Table.php :

        function find()  
        function findAll()
        function exists()  Vérif si un item existe
    */

    // Récup un item (de la bdd) via son id
    public function findByUsername(string $username)
    {
        // Récup de l'utilisateur (via son username passé en param dans l'url)
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        $item = $query->fetch();
        // Condition si l'utilisateur n'existe pas
        if($item === false){
            throw new NotFoundException($this->table, $username);
        }
        // Retourne un article
        return $item ;
    }

    // Récup un item (de la bdd) via son id
    public function findByEmail(string $email)
    {
        // Récup de l'utilisateur (via son email passé en param dans l'url)
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $query->execute(['email' => $email]);
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        $item = $query->fetch();
        /*
        // Condition si l'utilisateur n'existe pas
        if($item === false){
            throw new NotFoundException($this->table, $email);
        }
        */
        // Retourne un item
        return $item ;
    }

    // Insère un user dans la bdd
    public function insert(User $user)
    {
        //dd($user);
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET 
            userName = :userName,
            email = :email,
            password = :password,
            role = :role
        "); 
        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
        $result = $query->execute([ 
            'userName' => $user->getUserName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ]);
        // Si la création de l'utilisateur n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de créer l'utilisateur dans la table {$this->table}");
        }

        //dd($user->getId()); // Retourne "null"
        $user->setId((int)$this->pdo->lastInsertId()); // On récup l'id du user créé (pour l'utiliser comme param de redirection)  
    }
    
    // Modifie un user dans la bdd
    public function update(User $user): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET username = :username, email = :email, password = :password WHERE id = :id");
        $result = $query->execute([ // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]); 
        // Si la Modification n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de modifier l'enregistrement $user->getId() dans la table {$this->table}");
        }
    }

    // Supprime un user en fonction de son id (renvoie une exception si cela n'a pas fonctionné)
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");

        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item (permet de jetter une exception plus bas)
        $result = $query->execute([$id]); 
        
        // Si la suppression n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

}