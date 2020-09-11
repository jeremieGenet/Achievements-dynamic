<?php
namespace App;

use App\Security\ForbiddenException;
use App\Security\OnlyAdminException;
use App\Session;
use Exception;

class Router{

    private $viewPath; // chemin vers le dossier "views"
    public $layout = "layouts/home.php"; // layout par défaut (mais possibilité de l'écrasé en redéfinissant la route d'un nouveau layout)

    /**
     * @var Altorouter
     */
    private $router;
    private $session;

    // Signature ex : $router = new App\Router(dirname(__DIR__) . '/views');
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath; // Chemin vers le dossier "views"
        $this->router = new \AltoRouter(); // Instance de AltoRouter (notre librairie)
        $this->session = new Session();
    }

    // Permet de Mapper une url avec la méthode "get"
    // Param "$name" peut être une string ou être null (et par défaut on lui donne la valeur null), le "self" signifie que la fonction retourne la classe (Router)
    public function get(string $url, string $view, ?string $name = null): self  
    {
        $this->router->map('GET', $url, $view, $name);

        return $this; // Renvoie l'objet en cours (la classe Router)
    }

    // Permet de Mapper une url avec la méthode "post" (soumission d'un formulaire)
    // Param "$name" peut être une string ou être null (et par défaut on lui donne la valeur null), le "self" signifie que la fonction retourne la classe (Router)
    public function post(string $url, string $view, ?string $name = null): self  
    {
        $this->router->map('POST', $url, $view, $name);

        return $this; // Renvoie l'objet en cours (la classe Router)
    }

    // Permet de Mapper une url avec la méthode "post" ou "get" (soumission d'un formulaire, ou via l'url)
    // Param "$name" peut être une string ou être null (et par défaut on lui donne la valeur null), le "self" signifie que la fonction retourne la classe (Router)
    public function match(string $url, string $view, ?string $name = null): self  
    {
        $this->router->map('POST|GET', $url, $view, $name);

        return $this; // Renvoie l'objet en cours (la classe Router)
    }

    // Permet d'utiliser pour les liens la fonction "url()" plutôt que "$router->generate"
    public function url(string $name, array $params = []){
        return $this->router->generate($name, $params);
    }

    // Lance l'affichage en fonction du layout
    public function run(): self
    {
        $match = $this->router->match(); // renvoie un tableau associatif des routes qui correspondent (qui match)
        $view = $match['target']; // Récup du chemin du fichier du template désiré
        $params = $match['params']; // Permet de récup les params d'url (id, slug...)
        $router = $this;

        // CHANGEMENT DE LAYOUT
        // SI ADMINISTRATION ('admin/' dans l'url) ALORS NOUVEAU LAYOUT, sinon layout par défaut
        $admin = strpos($view, "admin/") !== false; // Si il y a la chaine "admin/" dans '$view' Alors retournera true, sinon false

        $blog = strpos($view, "realisations/") !== false;
        $auth = strpos($view, "auth/") !== false;
        //dd($view);

        
        // Condition lorsque l'url est différente des urls définis dans le fichier index.php alors "$view" prend la valeur "null"
        // par exemple si on tape localhost:8000/adminmlqkjsdmf alors $view vaudra null
        if($view === null){
            $view = 'e.404.php'; // alors on donne la valeur "e404.php" pour diriger vers la page e404.php qui affiche 'page introuvable'.
            //$layout = 'layouts/admin.php';
        }
        //dd($view);

        if($blog){
            $layout = 'layouts/blog.php';
        }elseif($admin){
            $layout = 'layouts/admin.php';
        }elseif($auth){
            $layout = 'layouts/admin.php';
        }elseif($view === 'e.404.php'){
            $layout = 'layouts/errors.php';
        }else{
            $layout = 'layouts/home.php';
        }
        //dd($layout);


        try{
            // Système de bufferisation (mise en mémoire)
            ob_start();
            require $this->viewPath . DIRECTORY_SEPARATOR . $view; // Chemin complet de notre template
            //require $this->viewPath . DIRECTORY_SEPARATOR . $view . 'php'; // Chemin complet de notre template
            $content = ob_get_clean();
            // Affichage de la vue (qui contient la variable $content qui est bufferisée)
            require $this->viewPath . DIRECTORY_SEPARATOR . $layout; // le layout pourra être modifié à l'instanciation de la cette classe $Router()
        // Erreur de type ForbiddenException jetté (si l'url n'est pas authorisée)  
        }catch(ForbiddenException $e){
            //dd($e);
            // Redirection vers la page login.php (page de connexion)
            $this->session->setFlash('warning', "Vous ne pouvez pas accéder à cette page, il vous faut d'abord vous connecter !");
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }
        catch(OnlyAdminException $e){
            //dd($e);
            $this->session->setFlash('warning', "Vous n'êtes pas autorisé à réaliser cette action !");
            // Redirection vers la page admin_home.php (page d'accueil de l'administration)
            header('Location: ' . $this->url('admin_home') . '?forbidden=2');
            exit();
        }
        catch(Exception $e){
            //dd($e);
            
            // Redirection vers la page login.php (page de connexion)
            header('Location: ' . $this->url('admin_home') . '?forbidden=3');
            //return $e;
            exit();
            
        }
        
        return $this; // Renvoie l'objet en cours (la classe Router)
    }

}