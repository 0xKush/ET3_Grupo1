<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../Models/UserGroup.php");


class GROUP_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM groupp ORDER BY name");
        $sql->execute();
        $groups_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $groups = array();
        
        foreach ($groups_db as $group) {
            array_push($groups, new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["private"], $group["creationdate"], $group["status"]));
        }
        
        return $groups;
    }
    
    public function showcurrent($groupID)
    {
        $sql = $this->db->prepare("SELECT * FROM groupp WHERE id=?");
        $sql->execute(array(
            $groupID
        ));
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            return new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["private"], $group["creationdate"], $group["status"]);
        } else {
            return NULL;
        }
    }
    
    
    public function show_by_name($name)
    {
        $sql = $this->db->prepare("SELECT * FROM groupp WHERE name=?");
        $sql->execute(array(
            $name
        ));
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            return new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["private"], $group["creationdate"], $group["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Group $group)
    {
        $sql = $this->db->prepare("INSERT INTO groupp(name,description,owner,private,status) values (?,?,?,?,?)");
        $sql->execute(array(
            $group->getName(),
            $group->getDescription(),
            $group->getOwner(),
            $group->getPrivate(),
            $group->getStatus()
        ));
        
        $sql = $this->db->query("SELECT * FROM groupp ORDER BY id DESC LIMIT 1");
        
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            $usergroup = new UserGroup(NULL, $group["id"], NULL, $group["owner"], $group["status"]);
            
            $sql = $this->db->prepare("INSERT INTO usergroup(groupid,member,status) values (?,?,?)");
            
            $sql->execute(array(
                $usergroup->getGroupID(),
                $usergroup->getMember(),
                $usergroup->getStatus()
            ));
        }
    }
    
    public function edit(Group $group)
    {
        $sql = $this->db->prepare("UPDATE groupp SET name=?, description=?, owner=?, private=?, creationdate=?,
    status=? where id=?");
        $sql->execute(array(
            $group->getName(),
            $group->getDescription(),
            $group->getOwner(),
            $group->getPrivate(),
            $group->getCreationDate(),
            $group->getStatus(),
            $group->getID()
        ));
        
    }
    
    
    public function delete(Group $group)
    {
        $sql = $this->db->prepare("DELETE FROM groupp where id=?");
        $sql->execute(array(
            $group->getID()
        ));
    }
    
    public function nameExists($name)
    {
        $sql = $this->db->prepare("SELECT count(name) FROM groupp where name=?");
        $sql->execute(array(
            $name
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
    public function search($query)
    {
        $search_query = "SELECT * FROM groupp WHERE " . $query;
        $sql          = $this->db->prepare($search_query);
        $sql->execute();
        $groups_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        $groups    = array();
        foreach ($groups_db as $group) {
            array_push($groups, new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["private"], $group["creationdate"], $group["status"]));
        }
        return $groups;
    }
    
    
}