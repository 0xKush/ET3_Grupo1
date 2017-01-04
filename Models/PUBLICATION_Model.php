<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class PUBLICATION_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM publication ORDER BY creationdate");
        $sql->execute();
        $publications_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $publications = array();
        
        foreach ($publications_db as $publication) {
            array_push($publications, new Publication($publication["id"], $publication["destination"], $publication["type"], $publication["owner"], $publication["creationdate"], $publication["hour"], $publication["description"], $publication["status"]));
        }
        
        return $publications;
    }
    
    
    public function showcurrent($publicationID)
    {
        $sql = $this->db->prepare("SELECT * FROM publication WHERE id=?");
        $sql->execute(array(
            $publicationID
        ));
        $publication = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($publication != NULL) {
            return new Publication($publication["id"], $publication["destination"], $publication["type"], $publication["owner"], $publication["creationdate"], $publication["hour"], $publication["description"], $publication["status"]);
        } else {
            return NULL;
        }
    }
    
    
    public function add(Publication $publication)
    {
        $sql = $this->db->prepare("INSERT INTO publication(id,destination,type,owner,creationdate,hour,description,status) values (?,?,?,?,?,?,?,?)");
        $sql->execute(array(
            $publication->getID(),
            $publication->getDestination(),
            $publication->getType(),
            $publication->getOwner(),
            $publication->getCreationDate(),
            $publication->getHour(),
            $publication->getDescription(),
            $publication->getStatus()
        ));
    }
    
    public function edit(Publication $publication)
    {
        $sql = $this->db->prepare("UPDATE publication SET destination=?, type=?,owner=?,creationdate=?,hour=?,description=?
    status=? where id=?");
        $sql->execute(array(
            $publication->getDestination(),
            $publication->getType(),
            $publication->getOwner(),
            $publication->getCreationDate(),
            $publication->getHour(),
            $publication->getDescription(),
            $publication->getStatus(),
            $publication->getID()
        ));
        
    }
    
    public function delete(Publication $publication)
    {
        $sql = $this->db->prepare("DELETE FROM publication where id=?");
        $sql->execute(array(
            $publication->getID()
        ));
    }
    
}