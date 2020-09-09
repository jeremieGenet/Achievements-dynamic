<?php
namespace App\Validators;

use App\Connection;
use App\Table\CategoryTable;


// Permet de valider les données d'un champ de formulaire
class CategoryValidator{

    private $data; // Données reçues pour validation ($_POST)
    /*
    $data = [
        "name" => "qsdfqsdf",
        "slug" => "qsdfqsdf",
        "content" => "qsdfqsdf",
        "createdAt" => "2019-11-03 18:53:57",
    ];
    */
    private $errors = [];
    private $categoryTable;
    private $pdo;
    private $categoryId;

    // Signature : $v = new categoryValidator($_POST, $categoryTable, $category->getId());
    public function __construct(array $data, $categoryId = null)
    {
        $this->pdo = Connection::getPDO();
        $this->data = $data; // Données reçues en $_POST du formulaire
        $this->categoryTable = new CategoryTable($this->pdo);
        $this->categoryId = $categoryId;
    }

    // Vérif si un champs est vide (en param un tableau avec le ou les noms des champs à vérifier) (NE FONCTIONNE PAS SUR LE CHAMPS PICTURE)
    public function fieldEmpty(array $fieldNames): array
    {    
        foreach($fieldNames as $fieldName){
            if(empty($this->data[$fieldName])){
                //dd($this->data[$fieldName], $this->data);
                $this->errors[$fieldName] = "Le champ '{$fieldName}' ne peut pas être vide !";
            }
        }
        //dd($this->errors);
        return $this->errors; // Retourne un tableau d'erreurs OU un tableau vide
        //RETOURNE ex :
        // array:[
        //     "name" => "Le champs name ne peut pas être vide !"?
        //     "slug" => "Le champs slug ne peut pas être vide !"
        // ]
    }

    // Vérif la taille d'un champ (min et max)
    public function fieldLength(int $nbMin, int $nbMax, array $fieldNames): array
    {
        foreach($fieldNames as $fieldName){
            if(strlen($this->data[$fieldName]) < $nbMin){
                $this->errors[$fieldName] = "Le champ '{$fieldName}' doit comporter au moins {$nbMin} caractères !";
            }
            if(strlen($this->data[$fieldName]) > $nbMax){
                $this->errors[$fieldName] = "Le champ '{$fieldName}' ne doit pas dépasser {$nbMax} caractères !";
            }
        }
        return $this->errors; // Retourne un tableau d'erreurs OU un tableau vide
    }

    // Vérif si un champ existe déjà dans la bdd (en param un tableau avec le ou les noms des champs à vérifier)  Retourne un tableau d'erreurs OU un tableau vide
    public function fieldExist(array $fieldNames): array
    {
        foreach($fieldNames as $fieldName){
            // Méthode exist() permet de vérif dans la bdd si un champ est déja présent (voir dans Table.php)
            // exists() param 1 = Nom du champ, param2 = valeur du nom du champ, param3 = id du category actuel (en traitement)
            if($this->categoryTable->exists($fieldName, $this->data[$fieldName], $this->categoryId)){
                $this->errors[$fieldName] = "Le champ '{$fieldName}' existe déjà !";
            }       
        }
        return $this->errors; // Retourne un tableau d'erreurs OU un tableau vide
    }

 
}