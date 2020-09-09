<?php
namespace App\Table;

use App\Models\Category;
use PDO;

// Gère les requêtes en relation avec la table "Category" (la table des catégories)
class CategoryTable extends Table{

    // Ces 2 propriétés permettent de donner les infos nécessaires à la class Table.php
    protected $table = "category"; // Nom de la table dans la bdd
    protected $class = Category::class; // Class qui défini le mode de recherche dans la bdd


    /* OBSOLETE ???
    public function hydratePosts(array $posts): void
    {
        // Création d'un tableau de post indexés par leur propre id
        $postsById = [];
        foreach($posts as $post){
            $postsById[$post->getId()] = $post;
        }

        // Récup des catégories. Récup de l'ensemble des champs de la table category + le champ "post_id" de la table post_category (JOINTURE)
        // (Catégories qui ont un category_id similaire à un des id passés dans le tableau "$postsById")
        $categories = $this->pdo->query(
            'SELECT bc.*, bpc.post_id
            FROM post_category bpc
            JOIN category bc ON bc.id = bpc.category_id
            WHERE bpc.post_id IN (' . implode(',', array_keys($postsById)) . ')' // array_keys() pour ne rechercher que sur des entiers (les index du tableau) sinon Erreur
        )->fetchAll(PDO::FETCH_CLASS, Category::class);
        // On rempli (l'attribut "categories[]") des posts
        foreach($categories as $category){
            // On push dans le tableau "categories[]" (propriété de jointure de la classe Categorie.php) via la méthode addCategories() (méthode de Model/Post.php) ... 
            // ... les posts qui ont un id qui correspondent à la catégorie (posts de la page, indexés par leur propre id)
            $postsById[$category->getPostId()]->setCategories($category);
        }
    }
    */

    /* OBSOLETE???
    // Récup les id et noms de la table category (tableau associatif avec pour index l'id de la catégorie et pour valeur son nom) EXCELLENT
    public function findById()
    {
        $query = $this->pdo->query('
            SELECT id, name FROM ' . $this->table
        );
        $query->setFetchMode(\PDO::FETCH_KEY_PAIR);
        return $query->fetchAll(); // RETOURNE : ["1" => 'JeuxVideo', "3" => 'Console de jeux', "4" => "goodies",...]
    }
    */

    // Insère une catégorie dans la bdd
    public function insert(Category $category)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET 
        name = :name,
        slug = :slug
        "); 
        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
        $result = $query->execute([ 
            'name' => $category->getName(),
            'slug' => $category->getSlug()
        ]);
        // Si la création de l'article n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de créer la catégorie dans la table {$this->table}");
        }
        //dd($post->getId()); // Retourne "null"
        $category->setId((int)$this->pdo->lastInsertId()); // On récup l'id de la catégorie créée (pour l'utiliser comme param de redirection)
        
    }

    // Modifie une catégorie dans la bdd
    public function update(Category $category): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, slug = :slug WHERE id = :id");
        $result = $query->execute([ // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            
        ]); 
        // Si la Modification n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de modifier l'enregistrement $category->getId() dans la table {$this->table}");
        }
    }

    // Supprime une categorie en fonction de son id (renvoie une exception si cela n'a pas fonctionné)
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