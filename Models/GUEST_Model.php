<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../Models/Event.php");

class GUEST_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($currentuserid, $invited = 1)
    {
        $events = array();
        
        $sql = $this->db->prepare("SELECT distinct e.id, e.name, e.owner FROM event as e, guest as g where g.member=? or g.secondarymember=? AND g.status=? ORDER BY e.name");
        $sql->execute(array(
            $currentuserid,
            $currentuserid,
            $invited
        ));
        $events_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($events_db as $event) {
            $ev = new Event();
            $ev->setID($event["id"]);
            $ev->setName($event["name"]);
            $ev->setOwner($event["owner"]);
            array_push($events, $ev);
        }
        
        return $events;
    }
    
    public function showcurrent($currentuserid, $event)
    {
        $sql = $this->db->prepare("SELECT * FROM guest WHERE (member=? and event=?) or (secondarymember=? and event=?)");
        $sql->execute(array(
            $currentuserid,
            $event,
            $currentuserid,
            $event
        ));
        $guest = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($guest != NULL) {
            return new Guest($guest["id"], $guest["event"], $guest["member"], $guest["secondarymember"], $guest["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Guest $guest)
    {
        $sql = $this->db->prepare("INSERT INTO guest(event,member,secondarymember,status) values (?,?,?,?)");
        $sql->execute(array(
            $guest->getMember(),
            $guest->getEvent(),
            $guest->getSecondaryMember(),
            $guest->getStatus()
        ));
    }
    
    public function edit(Guest $guest)
    {
        $sql = $this->db->prepare("UPDATE guest SET event=?, member=?, secondarymember=?, status=? where id=?");
        $sql->execute(array(
            $guest->getMember(),
            $guest->getEvent(),
            $guest->getSecondaryMember(),
            $guest->getStatus()
        ));
    }
    
    public function delete(Guest $guest)
    {
        $sql = $this->db->prepare("DELETE FROM guest where id=?");
        $sql->execute(array(
            $guest->getID()
        ));
    }
    
    public function guestExists($event, $member, $secondarymember)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM guest where event=? AND member=? AND secondarymember=?");
        $sql->execute(array(
            $event,
            $member,
            $secondarymember
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
        
        $sql = $this->db->prepare("SELECT count(id) FROM guest where event=? AND member=? AND secondarymember=?");
        $sql->execute(array(
            $event,
            $secondarymember,
            $member
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}