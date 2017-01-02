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
    public function isMember($id, $entity)
    {
        $table_name = htmlentities(trim($entity));
        $query = "SELECT count(id) FROM " . $table_name . " where member=? or secondarymember=?";
        $sql = $this->db->prepare($query);
        $sql->execute(array($id, $id));

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
    public function isOwner($id, $entity)
    {
        $table_name = htmlentities(trim($entity));
        $query = "SELECT count(id) FROM " . $table_name . " where id=? and owner=1";
        $sql = $this->db->prepare($query);
        $sql->execute(array($id));

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