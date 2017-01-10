<?php

require_once(__DIR__."/../core/PDOConnection.php");

class Permissions {
       
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    /**
     * return true if an entity is Public
     */
    public function isPublic($id, $entity)
    {
        $table_name = htmlentities(trim($entity));
        $query = "SELECT count(id) FROM " . $table_name . " where id=? and private=0";
        $sql = $this->db->prepare($query);
        $sql->execute(array($id));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * return true if a user is member of a relationship:
     * Friend
     * Group
     * Event
     * Conversation
     * Any
     */
    public function isGroupMember($userid, $groupid)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM usergroup where groupid=? and (member=? or secondarymember=?) and status=1");
        $sql->execute(array($groupid, $userid, $userid));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isEventMember($userid, $eventid)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM guest where eventid=? and (member=? or secondarymember=?) and status=1");
        $sql->execute(array($eventid, $userid, $userid));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    public function isFriend($userid, $friendid)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM friendship where (member=? and secondarymember=?) or (member=? and secondarymember=?) and status=1");
        $sql->execute(array($userid, $friendid, $friendid, $userid));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Return true if user is owner of an entity of:
     * Group
     * Event
     * Wall
     * Any
     */
    public function isOwner($userid, $entityid, $entity)
    {
        $table_name = htmlentities(trim($entity));
        $query = "SELECT count(id) FROM " . $table_name . " where id=? and owner=?";
        $sql = $this->db->prepare($query);
        $sql->execute(array($entityid, $userid));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }

    /**
     * Return true if a user is admin
     */
    public function isAdmin($id)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM user where id=? and type=1");
        $sql->execute(array($id));

        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}

$perm = new Permissions();

if ($perm->isGroupMember(1,2)) {
    echo " is member";
} else{
    echo "puto iago";
}