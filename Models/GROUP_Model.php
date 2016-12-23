<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class GROUP_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM group ORDER BY name");
        $sql->execute();
        $groups_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $groups = array();
        
        foreach ($groups_db as $group) {
            array_push($groups, new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["type"], $group["creationdate"], $group["status"]));
        }
        
        return $groups;
    }
    
    public function showcurrent($groupID)
    {
        $sql = $this->db->prepare("SELECT * FROM group WHERE id=?");
        $sql->execute(array(
            $groupID
        ));
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            return new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["type"], $group["creationdate"], $group["status"]);
        } else {
            return NULL;
        }
    }
    
    
    public function show_by_name($name)
    {
        $sql = $this->db->prepare("SELECT * FROM group WHERE name=?");
        $sql->execute(array(
            $name
        ));
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            return new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["type"], $group["creationdate"], $group["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Group $group)
    {
        $sql = $this->db->prepare("INSERT INTO group(name,description,owner,type,creationdate,status) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute(array(
            $group->getName(),
            $group->getDescription(),
            $group->getOwner(),
            $group->getType(),
            $group->getCreationDate(),
            $group->getStatus()
        ));
    }
    
    public function edit(Group $group)
    {
        $sql = $this->db->prepare("UPDATE group SET name=?, description=?, owner=?, type=?, creationdate=?,
    status=? where id=?");
        $sql->execute(array(
            $group->getName(),
            $group->getDescription(),
            $group->getOwner(),
            $group->getType(),
            $group->getCreationDate(),
            $group->getStatus(),
            $group->getID()
        ));
        
    }
    
    
    public function delete(Group $group)
    {
        $sql = $this->db->prepare("DELETE FROM group where id=?");
        $sql->execute(array(
            $group->getID()
        ));
    }
    
    public function nameExists($name)
    {
        $sql = $this->db->prepare("SELECT count(name) FROM group where name=?");
        $sql->execute(array(
            $name
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
    
}