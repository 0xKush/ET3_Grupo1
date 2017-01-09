<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class PUBLIDOC_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($currentuserid)
    {
        $documents = array();
        
        $sql = $this->db->prepare("
            SELECT document.id as id,document.owner as owner,document.location as location, document.uploaddate as uploaddate,document.status as status 
            WHERE publication.owner = ?");
        $sql->execute(array(
            $currentuserid
        ));
        $documents = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($documents as $document) {
            array_push($documents, new Document($document["id"], $document["owner"], $document["location"], $document["uploaddate"], $document["status"]));
        }
        
        return $documents;
    }
    
    
    
    public function showcurrent($id)
    {
        $sql = $this->db->prepare("SELECT * FROM publidoc WHERE id = ?");
        $sql->execute(array(
            $id
        ));
        $publidoc = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($publidoc != NULL) {
            return new PubliDoc($publidoc["id"], $publidoc["document"], $publidoc["publication"]);
        } else {
            return NULL;
        }
    }
    
    public function add(PubliDoc $publidoc)
    {
        $sql = $this->db->prepare("INSERT INTO publidoc(document,publication) values (?,?)");
        $sql->execute(array(
            $publidoc->getDocument(),
            $publidoc->getPublication()
        ));
    }
    
    public function edit(PubliDoc $publidoc)
    {
        $sql = $this->db->prepare("UPDATE publidoc SET document=?, publication=? WHERE id =?");
        $sql->execute(array(
            $publidoc->getID()
        ));
    }
    
    public function delete(PubliDoc $publidoc)
    {
        $sql = $this->db->prepare("DELETE FROM publidoc WHERE id=?");
        $sql->execute(array(
            $publidoc->getID()
        ));
    }
    
    public function publidocExists($document, $publication)
    {
        $sql = $this->db->prepare("SELECT count(id) FROM publidoc where document=? AND publication=?");
        $sql->execute(array(
            $document,
            $publication
        ));
        
        if ($sql->fetchColumn() > 0) {
            return true;
        }
    }
}