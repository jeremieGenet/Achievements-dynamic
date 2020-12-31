<?php
namespace App\Exception;

/* Classe utilisé Dans Table.php */
class NotFoundException extends \Exception{

    public $message;
    //public $code = 404;

    public function __construct(?string $table, ?int $id)
    {
        $this->message = "Aucun enregistrement ne correspond à cette requête dans la table '$table' à l'id : '$id'";
    }

}