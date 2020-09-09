<?php
namespace App\Table;

use App\Models\Image;
use PDO;

// Gère les requêtes en relation avec la table "image" (la table des images)
class ImageTable extends Table{

    // Ces 2 propriétés permettent de donner les infos nécessaires à la class Table.php
    protected $table = "images"; // Nom de la table dans la bdd
    protected $class = Image::class; // Class qui défini le mode de recherche dans la bdd


    // Insère une image dans la bdd
    public function insert(Image $image)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET 
            name = :name,
            size = :size,
            post_id = :post_id
        "); 
        // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
        $result = $query->execute([ 
            'name' => $image->getName(),
            'size' => $image->getSize(),
            'post_id' => $image->getPost_id()
        ]);
        // Si la création de l'article n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible d'insérer l'image dans la table {$this->table}");
        }
        //dd($post->getId()); // Retourne "null"
        $image->setId((int)$this->pdo->lastInsertId()); // On récup l'id de l'image nouvellement créée (pour l'utilisée comme param de redirection)
    }

    // Modifie une image dans la bdd
    public function update(Image $image): void
    {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, slug = :slug WHERE id = :id");
        $result = $query->execute([ // $result vaudra "true" ou "false" en fonction de la réussite ou non de la suppression de l'item
            'id' => $image->getId(),
            'name' => $image->getName(),
            'size' => $image->getSize(),
            'post_id' => $image->getPost_id()
        ]); 
        // Si la Modification n'a pas fonctionnée alors...
        if($result === false){
            throw new \Exception("Impossible de modifier l'enregistrement $image->getId() dans la table {$this->table}");
        }
    }

    // Supprime une image en fonction de son id (renvoie une exception si cela n'a pas fonctionné)
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

    /**
     * Vérif si une image existe dans la bdd (en fonction de son nom)
     * Signature : $imageTable->existsimage($name); 
     *
     * @param mixed $value Valeur du champ
     * @param int $except Permet d'exclure un id de la recherche, null par défaut (permet de ne pas chercher sur l'id du post en cours de création)
     * @return boolean
     */
    public function existsImage($name, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE name = ?";
        //dd($sql);
        // Si "$except" est différent de null (donc il est défini lors de l'utilisation de la méthode exists()) alors...
        if($except !== null){
            $sql .= " AND id != $except"; // On ajoute à notre requête que la recherche s'applique uniquement sur les id différents de celui passé en paramètre ($except)
        }
        $query = $this->pdo->prepare($sql);
        $query->execute([$name]);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0; // si le nb d'enregistrement est supérieur à 0 (c'est qu'il y a bien un enregistrement) retourne true
    }


}