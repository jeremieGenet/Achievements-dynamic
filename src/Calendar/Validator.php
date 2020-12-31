<?php
namespace App\Calendar;

class Validator{

    private $data;
    protected $errors = [];

    /**
     * Valide les données réçues
     *
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data){
        $this->errors = []; // On vide le tableau des erreurs (s'il y en a)
        $this->data = $data;
    }

    /**
     * Valide un champs (s'il existe) en fonction d'une méthode ($method), qui recevera des paramètres ($parameters)
     *
     * @param string $field (champ sur lequel on applique la validation)
     * @param string $method (méthode, ou fonction à appliquer sur le champ)
     * @param [type] ...$parameters (paramètres à envoyer à la méthode validate())
     * @return void
     */
    public function validate(string $field, string $method, ...$parameters){
        
        //dump('Nom du champ = $this->data[$field] vaut :' . $this->data[$field]); // Affiche le contenu du champ
        //dump('Nom du champ = $field vaut :' . $field); // Affiche le nom de l'attribut du champ
        
        // Si le champ n'existe pas ...
        if(!isset($this->data[$field])){
            $this->errors[$field] = "Le champ $field n'est pas rempli !";
        }else{
            // Appel de la méthode sur l'objet en cours, en param la valeur du nom du champ, et les différents paramètres
            call_user_func([$this, $method], $field, ...$parameters); // call_user_func() permet d'appeller une fonction de rappel avec des paramètres associés
        }
    }

    // Permet de controller la taille d'une chaine de caractère ($field) en fonction de sa taille ($length)
    public function minLength(string $field, int $length){
        // Si la taille du champ est inférieur à la taille défini ($length) alors...
        $taille = mb_strlen($field);
        if(mb_strlen($this->data[$field]) < $length){
            $this->errors[$field] = "Le titre doit comporter plus de $length caractères";
        }
    }

    // Permet de valider une date (en vérifiant si la valeur qu'on lui donne '$field' fonctionne avec la méthode createFromFormat())
    public function validateDate(string $field): bool{
        // Si le champ reçu en param ne permet pas d'être formater (donc vaut false) alors...
        if(\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false){
            $this->errors[$field] = "La date ne semble pas valide";
            return false;
        }
        return true;
    }

    // Permet de valider une date (en vérifiant si la valeur qu'on lui donne '$field' fonctionne avec la méthode createFromFormat())
    public function validateTime(string $field): bool{
        // Si le champ reçu en param ne permet pas d'être formater (donc vaut false) alors...
        if(\DateTime::createFromFormat('H:i', $this->data[$field]) === false){
            $this->errors[$field] = "Le Temps ne semble pas valide";
            return false;
        }
        return true;
    }

    // Permet de vérif si l'heure de début et supérieur à l'heure de fin 
    public function beforTime(string $startField, string $endField): bool{
        // Si les champs de début et fin (passés en param) valent "true" (retour de la méthode validateTime) alors ...
        if($this->validateTime($startField) && $this->validateTime($endField)){
            $start = \DateTime::createFromFormat('H:i', $this->data[$startField]); // On formate le champs de départ (format Heure:minutes)
            $end = \DateTime::createFromFormat('H:i', $this->data[$endField]); // On formate le champs de fin (format Heure:minutes)
            // Si le timestamp du champs de début est supérieur à celui de fin alors...
            if($start->getTimestamp() > $end->getTimestamp()){
                $this->errors[$startField] = "Le Temps de début doit être inférieur à celui de fin !";
                return false;
            }
            return true;
        }
        return false;
    }

}