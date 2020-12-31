<?php
namespace App\Calendar;

use Exception;
use App\Connection;
use App\Calendar\Event;


// Permet de manupuler les évènement de calendrier
class Events {

    private $db; // accès à la bdd

    public function __construct()
    {
        // On donne à l'attribut $db les infos pour la connexion à la bdd
        $this->db = Connection::getPDO();
    }

    // Retourne un tableau qui contient l'ensemble des évènements entre les dates de début et fin passées en paramètre
    public function getEventsBetween(\DateTime $start, \DateTime $end): array{
        // requête qui récup tous les évènements entre la date de début à 0h du matin et la date de fin à 23h59m59s (par ordre du plus récent au plus ancien)
        $req = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
        //dump($req);
        $statement = $this->db->query($req);
        $results = $statement->fetchAll();

        // Retourne chaque événements dans un tableau
        return $results;
    }

    // Retourne un tableau qui contient l'ensemble des évènements entre les dates de début et fin passées en paramètre MAIS indexé par la date du jour de l'évènement
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array{
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event){
            // On récup la uniquement la date du début de l'évènement (explode par l'espace entre la date et l'heure de l'évènement, si on mettait "$event['start'])[1]" on aurait récup l'heure de début de l'évènement)
            $date = explode(' ', $event['start'])[0];
            // Si il n'y a pas de '$date' dans le tableau $days[] alors on donne comme index la date et comme valeur l'évenment à notre tableau $days[]
            if(!isset($days[$date])){
                $days[$date] = [$event];
            // Sinon c'est que le tableau $days[$date] existe, et dans ce cas, on ajoute l'évènement
            }else{
                $days[$date][] = $event;
            }
        }
        // On rétourne les différents évènements (par jour)
        return $days;
    }

    // Récup un évènement via son id (retourne un objet de type Event.php)
    public function find(int $id): Event{
        $req = $this->db->query("SELECT * FROM events WHERE id= $id LIMIT 1");
        $req->setFetchMode(\PDO::FETCH_CLASS, Event::class); // MODIFICATION de la méthode fetch() dans le but de pouvoir récup les données à partir de la classe Events
        $result = $req->fetch();
        // Si le résultat de la req vaut false on jette une exeption, sinon on retourne le résutat
        if($result === false){
            throw new Exception('aucun évènement ne correspond');
        }else{
            return $result;
        }
        
    }

    // Permet d'hydrater l'objet de type Event d'un tableau de données
    public function hydrate(Event $event, array $data){
        $event->setName(htmlentities($data['name'])); // On sécurise la donnée avec la méthode (htmlentities)
        $event->setDescription(htmlentities($data['description']));
        // (les champs de type date doivent être formatés au format 'Américain' avant insertion dans la bdd)
        $event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . '' . $data['start'])->format('Y-m-d H:i:s')); 
        $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . '' . $data['end'])->format('Y-m-d H:i:s'));

        return $event;
    }

    // Insère un évènement dans notre la bdd
    public function create(Event $event): bool{
        $rep = $this->db->prepare('INSERT INTO events (name, description, start, end) VALUES (?, ?, ?, ?)');
        return $rep->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s')
        ]);

    }

    // Met à jour un évènement dans notre la bdd
    public function update(Event $event): bool{
        $rep = $this->db->prepare('UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?');
        return $rep->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);

    }

    /**
     * TODO: Supprime un évènement
     *
     * @param Event $event
     * @return boolean
     */
    public function delete(Event $event): bool{
        $rep = $this->db->prepare('DELETE FROM events WHERE id = ?');
        return $rep->execute([
            $event->getId()
        ]);
    }

}