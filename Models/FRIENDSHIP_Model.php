<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class FRIENDSHIP_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($currentuserid, $add = 1)
    {
        $friends = array();
        
        $sql = $this->db->prepare("SELECT u.id, u.user, u.name, u.surname, u.status, u.photo FROM user as u, friendship as f where f.member=? AND f.status=? and f.secondarymember=u.id ORDER BY u.name");
        $sql->execute(array(
            $currentuserid,
            $add
        ));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($friends_db as $friend) {
            array_push($friends, new User($friend["id"], $friend["user"], $friend["name"], $friend["surname"], NULL, NULL, NULL, NULL, $friend["status"], $friend["photo"]));
        }

        $sql = $this->db->prepare("SELECT u.id, u.user, u.name, u.surname, u.status, u.photo FROM user as u, friendship as f where f.secondarymember=? AND f.status=? and f.member=u.id ORDER BY u.name");
        $sql->execute(array(
            $currentuserid,
            $add
        ));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($friends_db as $friend) {
            array_push($friends, new User($friend["id"], $friend["user"], $friend["name"], $friend["surname"], NULL, NULL, NULL, NULL, $friend["status"], $friend["photo"]));
        }

        return $friends;
    }
    
    public function showcurrent($currentuserid, $friend)
    {
        $sql = $this->db->prepare("SELECT * FROM friendship WHERE (member=? and secondarymember=?) or (secondarymember=? and member=?)");
        $sql->execute(array(
            $currentuserid,
            $friend,
            $currentuserid,
            $friend
            
        ));
        $friendship = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($friendship != NULL) {
            return new Friendship($friendship["id"], $friendship["member"], $friendship["secondarymember"], $friendship["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Friendship $friendship)
    {
        $sql = $this->db->prepare("INSERT INTO friendship(member,secondarymember,status) values (?,?,?)");
        $sql->execute(array(
            $friendship->getMember(),
            $friendship->getSecondaryMember(),
            $friendship->getStatus()
        ));
    }
    
    public function edit(Friendship $friendship)
    {
        $sql = $this->db->prepare("UPDATE friendship SET member=?, secondarymember=?, status=? where id=?");
        $sql->execute(array(
            $friendship->getMember(),
            $friendship->getSecondaryMember(),
            $friendship->getStatus()
        ));
    }
    
    public function delete(Friendship $friendship)
    {
        $sql = $this->db->prepare("DELETE FROM friendship where id=?");
        $sql->execute(array(
            $friendship->getID()
        ));
    }
    
    public function friendExists($member, $secondarymember)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM friendship where (member=? AND secondarymember=?) or (secondarymember=? AND member=?)");
        $sql->execute(array(
            $member,
            $secondarymember,
            $member,
            $secondarymember
            
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function getFriends($currentuserid) {
        $friends = array();
                
        $sql = $this->db->prepare("SELECT u.id FROM user as u, friendship as f where f.member=? AND f.secondarymember=u.id ORDER BY u.name");
        $sql->execute(array(
            $currentuserid
        ));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($friends_db as $friend) {
            array_push($friends, $friend["id"]);
        }

        $sql = $this->db->prepare("SELECT u.id FROM user as u, friendship as f where f.secondarymember=? AND f.member=u.id ORDER BY u.name");
        $sql->execute(array(
            $currentuserid
        ));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($friends_db as $friend) {
            array_push($friends, $friend["id"]);
        }

        return $friends;
    }

    public function requests($currentuserid)
    {
        $friends = array();

        $sql = $this->db->prepare("SELECT u.id, u.user, u.name, u.surname, u.status, u.photo FROM user as u, friendship as f where f.secondarymember=? AND f.status=0 and f.member=u.id ORDER BY u.name");
        $sql->execute(array(
            $currentuserid
        ));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($friends_db as $friend) {
            array_push($friends, new User($friend["id"], $friend["user"], $friend["name"], $friend["surname"], NULL, NULL, NULL, NULL, $friend["status"], $friend["photo"]));
        }

        return $friends;
    }
}