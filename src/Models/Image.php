<?php
namespace App\Models;

use App\Models\Post;

// Représente la table 
class Image{
    
    private $id;
    private $name;
    private $size;
    private $post_id; // Liaison (l'id du post auquel appartient l'image)


    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self // ": self" pour le typage du retour (retourne l'item en cours)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    // Retourne le nom du fichier sans son extension
    public function getNameLessExt()
    {
        return pathinfo($this->name, PATHINFO_FILENAME);
    }
    public function setName(string $name): self /************* retirer le nullable de $name ********************** */
    {
        //dd($name);
        $this->name = $name;
        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }
    public function setSize(string $size): self 
    {
        $this->size = $size;
        return $this;
    }

    public function getPost_id(): int
    {
        return $this->post_id;
    }
    public function setPost_id(int $post_id): self 
    {
        $this->post_id = $post_id;
        return $this;
    }

    
    // Permet de modifier le post (utilisé dans Post.php via sa méthode addImage())
    public function setPost(Post $post){
        $this->post = $post;
    }
    

}