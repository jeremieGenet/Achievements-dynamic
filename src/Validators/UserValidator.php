<?php
namespace App\Validators;

use App\Connection;
use App\Table\UserTable;


// Permet de valider les données d'un champ de formulaire
class UserValidator{

    private $data; // Données postées, reçues pour validation ($_POST)
    /*
    $data = [
        "userName" => "qsdfqsdf",
        "email" => "mqlskdf@gmail.com
        "password" => "qsdfqsdf"
    ];
    */
    private $errors = [];
    private $pdo;

    // Signature : $v = new categoryValidator($_POST, $categoryTable, $category->getId());
    public function __construct(array $data)
    {
        $this->pdo = Connection::getPDO();
        $this->data = $data; // Données reçues en $_POST du formulaire
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
    public function fieldLength(array $fieldNames, int $nbMin, int $nbMax = null): array
    {
        //dd($nbMax);
        foreach($fieldNames as $fieldName){
            if(strlen($this->data[$fieldName]) < $nbMin){
                $this->errors[$fieldName] = "Le champ '{$fieldName}' doit comporter au moins {$nbMin} caractères !";
            }
            // Si '$nbMax' existe c'est qu'il ne vaut pas null, et qu'il est définit (null par défaut) on applique la contrainte de longueur max
            if($nbMax){
                //dd($nbMax, 'ligne 57');
                if(strlen($this->data[$fieldName]) > $nbMax){
                    $this->errors[$fieldName] = "Le champ '{$fieldName}' ne doit pas dépasser {$nbMax} caractères !";
                }
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

    // Vérif si le password et sa confirmation sont les mêmes
    public function samePassword(string $password, $passwordConfirm): array
    {
        // Si le password tapé est différent de la confirmation de password alors...
        //dd($password, $passwordConfirm);
        if($password !== $passwordConfirm){ 
            $this->errors['password'] = "Votre mot de passe doit être le même que votre confirmation de mot de passe !";
        }
        return $this->errors; // Retourne un tableau d'erreurs OU un tableau vide

    }

    // Contraint le mot de passe param 1 (en fonction du param 2 "$strengthPassword" = "max", "middle", "mini", ou "" par défaut) 
    public function passwordVulnerability(string $password, string $strengthPassword=""): array
    {
        //dd($password);
        if($strengthPassword === "max"){
            if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $password)) {
                $this->errors['password'] = "Votre mot de passe doit comporter au moins une Minuscule, une Majuscule, un Chiffre, et un caractère spécial !";
                //dd('max');
            }
        }
        if($strengthPassword === "middle"){
            if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $password)) {
                $this->errors['password'] = "Votre mot de passe doit comporter au moins une Minuscule, une Majuscule, et un Chiffre !";
                //dd('middle');
            }
        }
        if($strengthPassword === "mini"){
            if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])#', $password)) {
                $this->errors['password'] = "Votre mot de passe doit comporter au moins une Minuscule, et une Majuscule !";
                //dd('mini');
                //dd(preg_match('#^(?=.*[a-z])(?=.*[A-Z])#', $password));
            }
        }
        if($strengthPassword === ""){
            if (!preg_match('#^(?=.*[0-9])#', $password)) {
                $this->errors['password'] = "Votre mot de passe doit comporter au moins des chiffres !";
                //dd('aucune');
            }
        }
        return $this->errors; // Retourne un tableau d'erreurs OU un tableau vide (si)

 
    }

    
 
}