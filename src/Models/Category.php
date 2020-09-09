<?php
namespace App\Models;

use App\Models\Post;

class Category{
    
    private $id;
    private $slug;
    private $name;

    private $post_id; // Correspond au champs de la table post_category (utile pour les liaisons entre tables)
    private $post; // permet de récup un post avec toute ses catégories

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self // ": self" pour le typage du retour (retourne l'item en cours)
    {
        $this->id = $id;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): self 
    {
        $this->slug = $slug;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    // Récup l'id d'un post qui appartient à la catégorie (utile dans hydratePosts() de la classe CategoryTable() pour la pagination)
    public function getPostId(): ?int
    {
        return $this->post_id;
    }
    // Fonction qui récup le post (avec ses catégorie, voir Post.php)
    // Permet de modifier l'article (utilisé dans Post.php via sa méthode setCategories())
    public function setPost(Post $post){
        $this->post = $post;
    }
    

}