<?php
namespace App\Calendar;

use App\Calendar\Validator;


class EventValidator extends Validator{
    
    /**
     * Valide les données réçues (retournera un tableau d'erreurs ou un booléen)
     *
     * @param array $data (tableau de donnée (celle postées pour notre app))
     * @return array|bool
     */
    public function valid(array $data){
        // On récup les données via la méthode validates() de la classe parent (Validator)
        parent::validates($data);
        $this->validate('name', 'minLength', 3); // Validation du champs nommé 'name' auquel on applique la méthode 'minLength', et on donne '6' comme param à cette méthode
        $this->validate('date', 'validateDate'); // Vérif si le champ date est au bon format
        $this->validate('start', 'validateTime'); // Vérif si le champ de début est au bon format
        $this->validate('end', 'validateTime'); // Vérif si le champ de fin est au bon format
        $this->validate('start', 'beforTime', 'end'); // Vérif si l'heure de début est bien avant l'heure de fin

        // Retourne un tableau d'erreurs ($this->errors est une propriété de la classe parent Validator.php)
        return $this->errors; 
    }

}