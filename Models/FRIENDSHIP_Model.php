<?php

require_once(__DIR__."/../core/PDOConnection.php");

class FRIENDSHIP_Model {
       
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function showall($currentuserid, $add=1)
    {
        $friends = array();
        
        $sql = $this->db->prepare("SELECT u.id, u.user, u.name, u.surname FROM user as u, friendship as f where f.member=? AND f.status=? ORDER BY u.name");
        $sql->execute(array($currentuserid, $add));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($friends_db as $friend) {
            array_push($friends, new User($user["id"], $user["user"], $user["name"], $user["surname"]));
        }

        $sql = $this->db->prepare("SELECT u.id, u.user, u.name, u.surname FROM user as u, friendship as f where f.secondarymember=? AND f.status=? ORDER BY u.name");
        $sql->execute(array($currentuserid, $add));
        $friends_db = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($friends_db as $friend) {
            array_push($friends, new User($user["id"], $user["user"], $user["name"], $user["surname"]));
        }

        return $friends;
    }

    public function showcurrent($friendshipID)
    {
        $sql = $this->db->prepare("SELECT * FROM friendship WHERE id=?");
        $sql->execute(array($friendshipID));
        $friendship = $sql->fetch(PDO::FETCH_ASSOC);

        if($friendship != NULL) {
            return new Friendship($friendship["id"], $friendship["member"], $friendship["secondarymember"], $friendship["status"]);
        } else {
            return NULL;
        }
    }

    public function add(Friendship $friendship) {
        $sql = $this->db->prepare("INSERT INTO friendship(member,secondarymember,status) values (?,?,?)");
        $sql->execute(array($friendship->getMember(), $friendship->getSecondaryMember(), $friendship->getStatus()));
    }

    public function edit(Friendship $friendship)
    {
        $sql = $this->db->prepare("UPDATE friendship SET member=?, secondarymember=?, status=? where id=?");
        $sql->execute(array($friendship->getMember(), $friendship->getSecondaryMember(), $friendship->getStatus()));
    }

    public function delete(Friendship $friendship)
    {
        $sql = $this->db->prepare("DELETE FROM friendship where id=?");
        $sql->execute(array($friendship->getID()));
    }

    public function friendExists($member, $secondarymember)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM friendship where member=? AND secondarymember=?");
        $sql->execute(array($member, $secondarymember));

        if ($sql->fetchColumn() > 0) {
            return true;
        }

        $sql = $this->db->prepare("SELECT count(id) FROM friendship where member=? AND secondarymember=?");
        $sql->execute(array($secondarymember, $member));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }    
}