<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class EVENT_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM event ORDER BY creationdate");
        $sql->execute();
        $events_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $events = array();
        
        foreach ($events_db as $event) {
            array_push($events, new Event($event["id"], $event["creationdate"], $event["owner"], $event["startdate"], $event["enddate"], $event["starthour"], $event["endhour"], $event["description"], $event["status"], $event["name"], $event["private"]));
        }
        
        return $events;
    }
    
    
    public function showcurrent($eventID)
    {
        $sql = $this->db->prepare("SELECT * FROM event WHERE id=?");
        $sql->execute(array(
            $eventID
        ));
        $event = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($event != NULL) {
            return new Event($event["id"], $event["creationdate"], $event["owner"], $event["startdate"], $event["enddate"], $event["starthour"], $event["endhour"], $event["description"], $event["status"], $event["name"], $event["private"]);
        } else {
            return NULL;
        }
    }
    
    
    public function add(Event $event)
    {
        $sql = $this->db->prepare("INSERT INTO event(creationdate,owner,startdate,enddate,starthour,endhour,description,status,name,private) values (?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array(
            $event->getCreationDate(),
            $event->getOwner(),
            $event->getStartDate(),
            $event->getEndDate(),
            $event->getStartHour(),
            $event->getEndHour(),
            $event->getDescription(),
            $event->getStatus(),
            $event->getName(),
            $event->getPrivate()
        ));
    }
    
    public function edit(Event $event)
    {
        $sql = $this->db->prepare("UPDATE event SET creationdate=?,owner=?,startdate=?,enddate=?,starthour=?,endhour=?,description=?,status=?,name=?,private=? where id=?");
        $sql->execute(array(
            $event->getCreationDate(),
            $event->getOwner(),
            $event->getStartDate(),
            $event->getEndDate(),
            $event->getStartHour(),
            $event->getEndHour(),
            $event->getDescription(),
            $event->getStatus(),
            $event->getName(),
            $event->getPrivate(),
            $event->getID()
        ));
        
    }
    
    
    public function delete(Event $event)
    {
        $sql = $this->db->prepare("DELETE FROM event where id=?");
        $sql->execute(array(
            $event->getID()
        ));
    }
    
    public function nameExists($name)
    {
        $sql = $this->db->prepare("SELECT count(name) FROM event where name=?");
        $sql->execute(array(
            $name
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
    public function search($query)
    {
        $search_query = "SELECT * FROM event WHERE " . $query;
        $sql          = $this->db->prepare($search_query);
        $sql->execute();
        $events_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        $events    = array();
        foreach ($events_db as $event) {
            array_push($events, new Event($event["id"], $event["creationdate"], $event["owner"], $event["startdate"], $event["enddate"], $event["starthour"], $event["endhour"], $event["description"], $event["status"], $event["name"], $event["private"]));
        }
        return $events;
    }
    
}