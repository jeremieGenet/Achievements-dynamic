<?php
namespace App\Helpers;

use PDO;
use App\Helpers\URL;
use App\Connection;
use App\Security\PaginationException;


class PaginatedQuery{

    private $query;
    private $queryCount;
    private $pdo;
    private $perPage;
    private $count; // Représente le nb d'items en bdd (propriété utilisé dans la méthode getPages())
    private $items; // Propriété qui va servir à limiter l'utilisation de la méthode "getItems()" (pour quelle ne soit pas appellé plusieurs fois, optimisation)

    public function __construct(
        string $query,
        string $queryCount,
        ?\PDO $pdo = null, // Connection à la bdd ("$pdo" prend par défaut la valeur null)
        int $perPage = 8
    )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO(); // Si "$pdo" n'est pas défini on récup la connexion de base de l'app (Connection::getPDO())
        $this->perPage = $perPage;
    }

    // Récup les items en fonction des réquêtes
    public function getItems(string $classMapping)
    {
        // Condition d'optimisation du code (pour ne pas multiplier la demande d'items)
        // Si "$this->items" est null ($this->items" représente le résultat de la requête qui récup les items) alors...
        if($this->items === null){
            $currentPage = $this->getCurrentPage(); // $currentPage représente notre page actuelle (d'url)

            $pages = $this->getPages();

            if($currentPage > $pages){
                throw new PaginationException('Cette page n\'existe pas !', 404);
            }

            // $offset Représente le décallage du nb d'items entre chaques pages ()
            $offset = $this->perPage * ($currentPage - 1); 

            // Récup des données (données que l'on stock dans "$this->items")
            return $this->items = $this->pdo->query(
                $this->query .
                " LIMIT {$this->perPage} OFFSET $offset"
            )->fetchAll(PDO::FETCH_CLASS, $classMapping); // Utilisation du mode FETCH_CLASS pour utiliser une classe comme mode de récup de données
        }
    }

    // Représente le lien "précédent" en html (après vérif)
    public function previousLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage(); // $currentPage représente notre page actuelle (d'url)
        
        if($currentPage <= 1) return null;

        if($currentPage > 2) $l = $link .= '?page=' . ($currentPage - 1);
        // On retourne le lien (syntaxe heredoc pour ne pas avoir à échapper le html)
        return <<<HTML
            <a href="{$link}" class="btn btn-primary">&laquo; Page précédente</a>
HTML;
    }

    // Représente le lien "suivant" en html (après vérif)
    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage(); // $currentPage représente notre page actuelle (d'url)
        $pages = $this->getPages();
        if($currentPage >= $pages) return null;
        $link .= "?page=" . ($currentPage + 1);
        // On retourne le lien (syntaxe heredoc pour ne pas avoir à échapper le html)
        return <<<HTML
            <a href="{$link}" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
HTML;
    }

    // Récup la page actuelle (dans l'url)
    public function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1); // Représente notre page actuelle (d'url)
    }


    // Récup le nb d'item (via une requête) puis calcul le nb de pages de la pagination
    public function getPages()
    {
        // Si la propriété "count" (de notre classe) vaut null (c'est qu'elle n'est pas défini) alors... (On fait pour optimiser les performances)
        if($this->count === null){
            $this->count = (int)$this->pdo
                ->query($this->queryCount)
                ->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage); // Nombre de pages totales de notre pagination (ceil() arrondi au chiffre supérieur)
    }


}