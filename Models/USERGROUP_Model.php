<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
/*id groupid secondarymember member status*/
class USERGROUP_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($currentuserid)
    {
        $groups = array();
        
        $sql = $this->db->prepare("
            SELECT g.id as id,g.name as name,g.description as description ,g.owner as owner,g.type as type,g.creationdate as creationdate,g.status as status 
            FROM groupp, usergroup 
            WHERE usergroup.member=? AND usergroup.status=1  
            ORDER BY groupp.name");
        $sql->execute(array(
            $currentuserid
        ));
        $groups_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($groups_db as $group) {
            array_push($groups, new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["type"], $group["creationdate"], $group["status"]));
        }
        
        $sql = $this->db->prepare("
            SELECT g.id as id,g.name as name,g.description as description ,g.owner as owner,g.type as type,g.creationdate as creationdate,g.status as status 
            FROM groupp, usergroup 
            WHERE usergroup.secondarymember=? AND usergroup.status=1  
            ORDER BY groupp.name");
        $sql->execute(array(
            $currentuserid
        ));
        $groups_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($groups_db as $group) {
            array_push($groups, new Group($group["id"], $group["name"], $group["description"], $group["owner"], $group["type"], $group["creationdate"], $group["status"]));
        }
        
        return $groups;
    }
    
    public function add(UserGroup $usergroup)
    {
        $sql = $this->db->prepare("INSERT INTO usergroup(groupid,secondarymember,member,status) values (?,?,?,?)");
        $sql->execute(array(
            $usergroup->getGroupID(),
            $usergroup->getSecondaryMember(),
            $usergroup->Member(),
            $usergroup->getStatus()
        ));
    }
    
    public function edit(UserGroup $usergroup)
    {
        $sql = $this->db->prepare("UPDATE usergroup SET groupid=?,secondarymember=?, member=?,status=? where id=?");
        $sql->execute(array(
            $usergroup->getGroupID(),
            $usergroup->getSecondaryMember(),
            $usergroup->Member(),
            $usergroup->getStatus(),
            $usergroup->getID()
        ));
    }
    
    public function delete(UserGroup $usergroup)
    {
        $sql = $this->db->prepare("DELETE FROM usergroup where id=?");
        $sql->execute(array(
            $usergroup->getID()
        ));
    }
    
    public function usergroupExists($groupid, $member, $secondarymember)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM groupp where groupid=? AND member=? AND secondarymember=?");
        $sql->execute(array(
            $groupid,
            $member,
            $secondarymember
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
        
        $sql = $this->db->prepare("SELECT count(id) FROM groupp where groupid=? AND member=? AND secondarymember=?");
        $sql->execute(array(
            $groupid,
            $secondarymember,
            $member
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
    
    
}
