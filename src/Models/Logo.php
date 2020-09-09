<?php
namespace App\Models;

use App\Models\Post;


class Logo{
    
    private $id;
    private $name;
    private $size;
    private $post_id; // Liaison (l'id du post auquel appartient le logo)


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
    public function setName(string $name): self
    {
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

    
    // Permet de modifier le post (utilisé dans Post.php via sa méthode addLogo())
    public function setPost(Post $post){
        $this->post = $post;
    }
    

}