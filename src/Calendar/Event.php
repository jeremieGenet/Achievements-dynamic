<?php
namespace App\Calendar;

// Classe qui représente un évènement (avec les mêmes caractèristiques que la table 'events' dans la bdd)
class Event{

    private $id;
    private $name;
    private $description;
    private $start;
    private $end;

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getDescription(): string{
        // Ternaire qui veut dire : retourne la description ou (si il n'y en a pas) retourne une chaine de caractère vide (rend l'attribut description nullable)
        return $this->description ?? ''; 
    }

    public function getStart(): \DateTime{
        return new \DateTime($this->start);
    }

    public function getEnd(): \DateTime{
        return new \DateTime($this->end);
    }


    public function setName(string $name){
        $this->name = $name;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function setStart(string $start){
        $this->start = $start;
    }

    public function setEnd(string $end){
        $this->end = $end;
    }


}