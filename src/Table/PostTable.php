<?php
namespace App\Table;

use App\Models\{Post, Logo, Image, Category, User};
use App\Helpers\PaginatedQuery;


// Gère les requêtes de la table "Post" (table des articles)
class PostTable extends Table{

    // Ces 2 propriétés permettent de donner les infos nécessaires à la class Table.php
    protected $table = "post"; // Nom de la table dans la bdd
    protected $class = Post::class; // Class qui défini le mode de recherche dans la bdd

    /*
        METHODES DANS LE MODEL Table.php :

        function find()  
        function findAll()
        function exists()  Vérif si un item existe
    */

    // Récup le prochain id de la table (l'id qui sera nouvellement créé) (utilisé x2 dans FilesManager.php)
    public function getNextId()
    {
        // PARAM D'ENVIRONNEMENT SUR LE NOM DE LA BASE DE DONNEE ($_ENV['local']['dbname'] = nom de la base de donnée)
        $req = $this->pdo->query("SHOW TABLE STATUS FROM {$_ENV['local']['dbname']} LIKE '{$this->table}'");/*************A MODIFIER EN PRODUCTION******************************************** */
        $donnees = $req->fetch();
        return $donnees['Auto_increment'];
    }

    // Insère un post dans la bdd (et insére l'id et post et l'id de la catégorie du post dans la table post_category)
    public function insert(Post $post): void
    {
        // INSERTION DU POST
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET 
            title = :title,
            picture = :picture,
            slug = :slug, 
            content = :content, 
            created_at = :createdAt,
            author_id = :author_id,
            likes = :likes,
            isLiked = :isLiked
        "); 
        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
        $result = $query->execute([ 
            'title' => $post->getTitle(),
            'picture' => $post->getPicture(),
            'slug' => $post->getSlugFormat(),
            'content' => $post->getContent(),
            'createdAt' => $post->getCreatedAt()->format('Y-m-d H:i:s'), // Formatage au format admit par MySQL
            'author_id' => $post->getAuthor_id(),
            'likes' => $post->getLikes(),
            'isLiked' => $post->getIsLiked()
        ]);
        // Si la création de l'article n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de créer l'article dans la table {$this->table}");
        }
        // On récup l'id du post créé (pour l'utiliser comme param de redirection)
        $post->setId((int)$this->pdo->lastInsertId());
        
        // INSERTION TABLE LIAISON (post_category)
        // Boucle pour insérer la ou les catégories (reçues par les check-box du formulaire) (un post peu avoir plusieurs catégories)
        foreach($post->getCategories() as $category){ // ici "$category" est un objet Category (qui comporte id, slu, name, post_id, et post comme propriétés)
            $category_id = (int)$category->getId(); // id des catégories postées (1 id si une catégorie postée, sinon plusieurs)
            //dd($category_id);
            // INSERER LA OU LES NOUVELLES CATEGORIES RECUE DANS LA TABLE post_category (besoin post_id et category_id)
            $query2 = $this->pdo->prepare("INSERT INTO post_category SET
            post_id = :post_id,
            category_id = :category_id
            ");
            $result2 = $query2->execute([
                'post_id' => $post->getId(),
                'category_id' => $category_id
            ]);

            if($result2 === false){
                throw new \Exception("Impossible de modifier la table post_category ! ");
            }
        }
        

    }
    
    // Modifie un post dans la bdd (et modifie l'id de la catégorie dans la table post_category)
    public function update(Post $post, int $id): void
    {
        //dd($post, $post->getCategories());
        //dd($post->getPicture(), $post->getCategories());
        // UPDATE DU POST
        $query = $this->pdo->prepare("UPDATE {$this->table} SET 
            title = :title, 
            picture = :picture, 
            slug = :slug, 
            content = :content, 
            created_at = :createdAt,
            author_id = :author_id
        WHERE id = {$id}
        ");
        $result = $query->execute([ // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
            'title' => $post->getTitle(),
            'picture' => $post->getPicture(),
            'slug' => $post->getSlugFormat(),
            'content' => $post->getContent(),
            'createdAt' => $post->getCreatedAt()->format('Y-m-d H:i:s'), // Formatage au format admit par MySQL
            'author_id' => $post->getAuthor_id()
        ]); 
        //dd($result);
        // Si la Modification n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de modifier l'enregistrement $post->getId() dans la table {$this->table}");
        }

        // Si la propriété 'categories' n'est pas vide... (on fait l'update de la table de liaison post_category)
        if($post->getCategories() !== []){

            //dd($post->getCategories());
            /*
            array:2 [▼
                0 => Category {#26 ▼
                    -id: "1"
                    -slug: "slug-php"
                    -name: "PHP"
                    -post_id: null
                    -post: null
                }
                1 => Category {#25 ▶}
            ]
            */

            
            // SUPPRESSION PUIS INSERTION DE LA OU LES CATEGORIES DANS LA BDD (liaison post_category)
            $query = $this->pdo->prepare("DELETE FROM post_category WHERE post_id = ?");
            // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item (permet de jetter une exception plus bas)
            $result = $query->execute([$post->getId()]);
            
            // BOUCLE POUR INCLURE LE OU LES ID DES CATEGORIES (reçu par les check-box du formulaire) (un post peu avoir plusieurs catégorie)
            foreach($post->getCategories() as $category){ // ici "$category" est un objet Category (qui comporte id, slu, name, post_id, et post comme propriétés)

                // INSERER LA OU LES NOUVELLES CATEGORIES RECUE DANS LA TABLE post_category (besoin post_id et category_id)
                $query2 = $this->pdo->prepare("INSERT INTO post_category SET
                post_id = :post_id,
                category_id = :category_id
                ");
                $result2 = $query2->execute([
                    'post_id' => $post->getId(),
                    'category_id' => $category->getId()
                ]);
                if($result2 === false){
                    throw new \Exception("Impossible de modifier la table post_category ! ");
                }

            }

                /*
                // Ne fonctionne pas
                // UPDATE DE LA OU LES NOUVELLES CATEGORIES RECUES DANS LA TABLE post_category (besoin post_id et category_id)
                $query = $this->pdo->prepare("UPDATE post_category SET
                    post_id = :post_id,
                    category_id = :category_id
                WHERE post_id = {$id} 
                ");
                $result = $query->execute([
                    'post_id' => $post->getId(),
                    'category_id' => $category->getId() // 1
                ]);
                if($result === false){
                    throw new \Exception("Impossible de modifier la table post_category ! ");
                }
                */
                
        }
        

    }

    // Supprime un post en fonction de son id (renvoie une exception si cela n'a pas fonctionné)
    public function delete(Post $post, int $id): void
    {
        
        // SUPPRESSION de l'image dans le dossier de stockage (si il y en a une)
        if($post->getPicture()){
            //dd($post->getPicture());
            // Si le fichier existe alors on supprime le fichier du dossier
            if(file_exists('assets/uploads/img/' . $post->getPicture())){
                unlink('assets/uploads/img/' . $post->getPicture());
            }
        }

        // SUPPRESSION DES LOGOS DU DOSSIER
        // Récup des logos sous forme d'objet
        $logos = $this->findLogoCollection($id);
        //dd($logos);
        // Suppression des logos dans le dossier
        foreach($logos as $logo){
            // Si le fichier existe alors on supprime le fichier du dossier
            
            if(file_exists('assets/uploads/logo/' . $logo->getName())){
                unlink('assets/uploads/logo/' . $logo->getName());
            }
        }
        

        // SUPPRESSION DU POST
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item (permet de jetter une exception plus bas)
        $result = $query->execute([$id]);
        // Si la suppression n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }

    }

    // Récup l'ensemble des post hydratés (avec user, catégories, collection d'image et logos)
    public function findAllHydrated(): array
    {
        $query = $this->pdo->query('
            SELECT * FROM ' . $this->table
        );
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        $posts = $query->fetchAll();

        $postsHydrated = [];
        foreach($posts as $post){
            $postsHydrated[] = $post->hydrate($post->getId());
        }

        return $postsHydrated;
    }

    // Récup les post en fonction leur catégorie (Param1= id de la catégorie, Param2= nombre de post à récup)
    public function findByCategory(int $categoryId, int $limit): array
    {
        //SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC LIMIT ' . $limit
        $query = $this->pdo->query(
        "SELECT * 
        FROM {$this->table} p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = {$categoryId}
        ORDER BY created_at DESC
        LIMIT {$limit}"
        );
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        $posts = $query->fetchAll();

        $postsHydrated = [];
        foreach($posts as $post){
            $postsHydrated[] = $post->hydrate($post->getId());
        }

        return $postsHydrated;
    }

    // Récup les dernier post (en fonction de la limite)
    public function findLatest(int $limit): array
    {
        $query = $this->pdo->query(
        "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT {$limit}"
        );
        $query->setFetchMode(\PDO::FETCH_CLASS, $this->class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        $posts = $query->fetchAll();

        $postsHydrated = [];
        foreach($posts as $post){
            $postsHydrated[] = $post->hydrate($post->getId());
        }

        return $postsHydrated;
    }

    // Récup les résultats paginés des posts et hydratés (utilisé pour l'affichage de l'ensemble des articles dans post/index.php)
    public function findPaginated(int $nbElementsPerPage=4)
    {
        /**
         * Instanciation de notre Classe PaginatedQuery()
         * 
         * Param 1 : Requête qui permet de récup les items (articles ici)
         * Param 2 : Requête qui compte les items
         * Param 3 : connection à la bdd
         * Param 4 : le nb d'élément par page (pour la paginationn), 8 par défaut
         */
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC", 
            "SELECT COUNT(id) FROM {$this->table}",
            $this->pdo,
            $nbElementsPerPage
        );
        // Récup des articles (en param la classe sur laquelle on veut récup les items)
        $posts = $paginatedQuery->getItems(Post::class);

        // Hydratations des posts (ajout des catégories, collection de logos et auteur sous forme d'objet)
        $postsHydrated = [];
        foreach($posts as $post){
            $postsHydrated[] = $post->hydrate($post->getId());
        }
        
        // Retourne la liste des articles (hydratés) et la liste des articles paginés
        return [$postsHydrated, $paginatedQuery];
    }

    // Récup les résultats paginés des posts (utilisé pour l'affichage de l'ensemble des articles qui appartiennent à la catégorie selectionnée dans category/show.php)
    public function findPaginatedForCategory(int $categoryId, int $nbElementsPerPage=4)
    {
        /**
         * Instanciation de notre Classe PaginatedQuery()
         * 
         * Param 1 : Requête qui permet de récup les items (catégories ici)
         * Param 2 : Requête qui compte les items
         * Param 3 et 4 optionels (inutiles ici)
         */
        $paginatedQuery = new PaginatedQuery(
            "SELECT * 
            FROM {$this->table} p
            JOIN post_category pc ON pc.post_id = p.id
            WHERE pc.category_id = {$categoryId}
            ORDER BY created_at DESC",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$categoryId}",
            $this->pdo,
            $nbElementsPerPage
        );
        // Récup des articles (en param la classe sur laquelle on veut récup les items)
        $posts = $paginatedQuery->getItems(Post::class);

        // Hydratations des posts (ajout des catégories, collection de logos et auteur sous forme d'objet)
        $postsHydrated = [];
        foreach($posts as $post){
            $postsHydrated[] = $post->hydrate($post->getId());
        }

        // Retourne la liste des articles (hydratés) et la liste des articles paginés
        return [$postsHydrated, $paginatedQuery];
    }

    // Récup des catégories de l'article (via l'id de l'article)
    public function findCategories(int $idPost)
    {
        $query = $this->pdo->prepare('
            SELECT category.id, category.name, category.slug
            FROM post_category pc 
            JOIN category ON pc.category_id = category.id 
            WHERE pc.post_id = :id
        ');
        $query->execute(['id' => $idPost]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Category::class); // On change le mode de recherche (Fetch)
        
        return $query->fetchAll();
    }

    // Récup les catégories via leurs noms (utile lors de la création d'un post pour récup les catégories postées dans le formulaire "new.php")
    public function findCategoriesById(array $ids)
    {
        foreach($ids as $id){
            $query = $this->pdo->query("SELECT * FROM category WHERE id = {$id}");
            $query->setFetchMode(\PDO::FETCH_CLASS, Category::class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
            $categories[] = $query->fetch();
        }
        return $categories;
    }

    // Récup la collection de logos appartenant à un post (via son id)
    public function findLogoCollection(int $id)
    {
        $query = $this->pdo->query("SELECT * FROM logo WHERE post_id = {$id}");
        $query->setFetchMode(\PDO::FETCH_CLASS, Logo::class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        return $query->fetchAll();
    }

    // Récup la collection d'images appartenant à un post (via son id)
    public function findImageCollection(int $id)
    {
        $query = $this->pdo->query("SELECT * FROM images WHERE post_id = {$id}");
        $query->setFetchMode(\PDO::FETCH_CLASS, Image::class); // On change le mode de recherche (Fetch) et on signifie que l'on va rechercher par classe
        return $query->fetchAll();
    }

    // Récup l'auteur d'un post (via l'id de l'auteur)
    public function findAuthor(int $id): User
    {
        $query = $this->pdo->query("SELECT * FROM user WHERE id = {$id}");

        $query->setFetchMode(\PDO::FETCH_CLASS, User::class); // On change le mode de recherche (Fetch) et on signifie que l'on va utiliser par classe
        return $query->fetch();
    }

    // Statistiques sur la table post
    public function statistics()
    {
        $data = $this->findAll();
        //dd($data);
        return $data;
        
    }

    

}