<?php
namespace App\Models;

use \DateTime;
use App\Connection;
use App\Models\{Image, Logo, Category, User};
use App\Helpers\Text;
use App\Table\PostTable;

// Représente la table des réalisations
class Post{

    private $id;
    private $picture;
    private $title;
    private $slug;
    private $content;
    private $created_at;
    private $author_id;
    private $likes;
    private $isLiked;

    private $author;
    private $categories = []; // Tableau qui récup les catégories de la réalisation (LIAISON avec la table post_category)
    private $logoCollection = [];  // Tableau d'objets de type Logo
    private $imageCollection = [];  // Tableau d'objets de type Image

    public function __construct()
    {
        $this->logoCollection = [];
        $this->imageCollection = [];
    }

    // Récup (sous forme d'objet) les catégories, la collection d'images et de logos, et l'auteur du post puis retourne le post complet (via son id)
    public function hydrate(int $id):Post
    {
        $pdo = Connection::getPDO();
        $postTable = new PostTable($pdo);
        $post = $postTable->find($id); // Récup du post avec ses infos (avant modification) via l'id passé dans l'url
        
        // Hydratation du post (ajout de la collection de logo, d'images et des catégories)
        $logos = $postTable->findLogoCollection($id);
        // Boucle pour ajouter chaque logo de la collection au post
        foreach($logos as $logo){
            $post->addLogo($logo);
        }
        $images = $postTable->findImageCollection($id);
        // Boucle pour ajouter chaque image de la collection au post
        foreach($images as $image){
            $post->addImage($image);
        }
        $categories = $postTable->findCategories($id);
        // Boucle pour ajouter les catégories du post
        foreach($categories as $category){
            $post->setCategories($category);
        }
        // Ajout de l'auteur (objet) au post
        $authorPost = $postTable->findAuthor($post->getAuthor_id());
        $post->setAuthor($authorPost);

        return $post;
    }



    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPicture(): ?string
    {
        /*
           Une simple chaine de caractères
        */
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        $this->picture = $picture;
        return $this;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(string $title): self // ": self" pour le typage du retour (retourne l'item en cours)
    {
        $this->title = $title;
        return $this; // (retourne l'objet en cours)
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
    public function getSlugFormat(): ?string
    {
        // Formatage du nom du post en slug (titre-de-qualité)
        $title = explode(' ', $this->title);
        $slugTitle = implode("-", $title);
        return strtolower($slugTitle);
    }
    public function setSlug(string $slug): ?string
    {
        $this->slug = $slug;
        return $this->slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    // Retourne le contenu de l'article mais dans une limite ($limit) de lettre (voir Text::excerpt())
    public function getContent_excerpt($limit=120): ?string
    {
        if($this->content === null){
            return null;
        }
        // "nl2br" permet de respecter les sauts de lignes
        return nl2br(Text::excerpt((string)$this->content, $limit)); /****************************************** (string) Corrige??? *************************/
    }
    // Retourne le contenu de l'article avec sauts de lignes et sécurisé par htmlentities()
    public function getFormatedContent(): ?string
    {
        return nl2br(htmlentities($this->content));
    }
    public function setContent(string $content): self // ": self" pour le typage du retour (retourne l'item en cours)
    {
        $this->content = $content;
        return $this; // (retourne l'objet en cours)
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }
    // Retourne la date de création au format FR ('d F Y')
    public function getCreatedAt_fr()
    {
        $timesTamp = $this->getCreatedAt()->getTimestamp();
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR', 'fr_FR.utf8', 'utf8']);
        //setlocale(LC_TIME, ['fr','utf8']);
        //return strftime('%A %d' .'/'. '%m' .'/'. '%Y', $timesTamp); // mercredi 20/10/2020
        //return strftime('%A %d %b %Y', $timesTamp); // mercredi 20 aout 2017
        return strftime('%d' .'/'. '%m' .'/'. '%Y', $timesTamp); // 20/10/2020
    }


    // Modifie la date de création (retourne une chaîne de caractères)
    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getAuthor_id(): ?int
    {
        return $this->author_id;
    }
    public function setAuthor_id($author_id): self
    {
        $this->author_id = $author_id;
        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }
    public function setLikes($likes): self
    {
        $this->likes = $likes;
        return $this;
    }

    public function getIsLiked(): ?bool
    {
        return $this->isLiked;
    }
    public function setIsLiked($isLiked): self
    {
        $this->isLiked = $isLiked;
        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    
    // Récup la liste des catégories (d'un article, post)
    public function getCategories()
    {
        return $this->categories; 
    }
    // Récup les id des catégories du post sous forme d'un tableau
    public function getCategoriesId()
    {
        $tab = [];
        foreach($this->categories as $cat){
            $tab[] = $cat->getId();
        }
        return $tab; 
    }
    
    // Permet d'ajouter des catégories
    public function setCategories(Category $category): void
    {
        $this->categories[] = $category; // et non "$this->categories[]"
        // On sauvegarde le post associé dans la classe Category.php (pas utile pour notre blog, mais permet dans Category.php de récup le post et ses catégories)
        //$category->setPost($this); 
    }
    public function removeCategories()
    {
        $this->categories = [];
    }

    // Ajoute un logo (de type objet) à la collection de logo du post
    public function addLogo(Logo $logo): bool
    {
        // Vérif si le logo est déjà dans la collection (si oui retourne false)
        if(in_array($logo, $this->logoCollection, true)){
            return false;
        }
        $this->logoCollection[] = $logo;
        //$logo->setPost($this); /************************** Ne fonctionne pas encore ************** */
        return true; // retourne true en cas de succès
    }
    // Supprime un logo de la collection de logo (retourne true si le logo est supprimé sinon false)
    public function removeLogo(Logo $logo): bool
    {
        $key = array_search($logo, $this->logoCollection, true);
        if($key === false){
            return false;
        }
        // Suppression du logo de la collection (via $key)
        unset($this->logoCollection[$key]);
        return true; 
    }
    // Supprime la collection de logo
    public function removeCollectionLogo()
    {
        $this->logoCollection = [];
    }
    // Retourne la collection de logos
    public function getLogoCollection()
    {
        return $this->logoCollection;
    }



    // Ajoute une image (de type objet) à la collection de image du post
    public function addImage(Image $image): bool
    {
        //dd($image);
        // Vérif si le image est déjà dans la collection (si oui retourne false)
        if(in_array($image, $this->imageCollection, true)){
            return false;
        }
        $this->imageCollection[] = $image;
        //$image->setPost($this); /************************** Ne fonctionne pas encore ************** */
        return true; // retourne true en cas de succès
    }
    // Supprime une image de la collection de image (retourne true si le image est supprimé sinon false)
    public function removeImage(Image $image): bool
    {
        $key = array_search($image, $this->imageCollection, true);
        if($key === false){
            return false;
        }
        // Suppression d'une image de la collection (via $key)
        unset($this->imageCollection[$key]);
        return true; 
    }
    // Supprime la collection d'images
    public function removeCollectionImage()
    {
        $this->imageCollection = [];
    }
    // Retourne la collection d'images
    public function getImageCollection()
    {
        return $this->imageCollection;
    }
    


}