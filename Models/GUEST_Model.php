<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

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
        
        $sql = $this->db->prepare("SELECT e.id, e.name FROM event as e, guest as g where g.member=? AND g.status=? ORDER BY e.name");
        $sql->execute(array(
            $currentuserid,
            $invited
        ));
        $events_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($events_db as $event) {
            array_push($events, new Event($event["id"], $event["name"]));
        }
        
        $sql = $this->db->prepare("SELECT e.id, e.name FROM event as e, guest as g where g.secondarymember=? AND g.status=? ORDER BY e.name");
        $sql->execute(array(
            $currentuserid,
            $invited
        ));
        $events_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($events_db as $event) {
            array_push($events, new Event($event["id"], $event["name"]));
        }
        
        return $events;
    }
    
    public function showcurrent($guestID)
    {
        $sql = $this->db->prepare("SELECT * FROM guest WHERE id=?");
        $sql->execute(array(
            $guestID
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