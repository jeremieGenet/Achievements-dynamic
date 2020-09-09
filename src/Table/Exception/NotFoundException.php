<?php
namespace App\Table\Exception;

class NotFoundException extends \Exception{

    public function __construct(?string $table, $id)
    {
        $this->message = "Aucun enregistrement ne correspond à cette requête dans la table '$table'";
    }

}