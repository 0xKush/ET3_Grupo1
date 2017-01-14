<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class DOCUMENT_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($owner)
    {
        $sql = $this->db->prepare("SELECT * FROM document where owner=? ORDER BY uploaddate ");
        $sql->execute(array(
            $owner
        ));
        $documents_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $documents = array();
        
        foreach ($documents_db as $document) {
            array_push($documents, new Document($document["id"], $document["owner"], $document["location"], $document["uploaddate"], $document["status"]));
        }
        
        return $documents;
    }
    
    public function showcurrent($documentID)
    {
        $sql = $this->db->prepare("SELECT * FROM document WHERE id=?");
        $sql->execute(array(
            $documentID
        ));
        $document = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($document != NULL) {
            return new Document($document["id"], $document["owner"], $document["location"], $document["uploaddate"], $document["status"]);
        } else {
            return NULL;
        }
    }
    
    
    public function show_by_user($owner)
    {
        $sql = $this->db->prepare("SELECT * FROM document WHERE owner=?");
        $sql->execute(array(
            $owner
        ));
        $document = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($document != NULL) {
            return new Document($document["id"], $document["owner"], $document["location"], $document["uploaddate"], $document["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Document $document)
    {
        $sql = $this->db->prepare("INSERT INTO document(owner,location,uploaddate,status) values (?,?,?,?)");
        $sql->execute(array(
            $document->getOwner(),
            $document->getLocation(),
            $document->getUploadDate(),
            $document->getStatus()
        ));
    }
    
    public function delete(Document $document)
    {
        $sql = $this->db->prepare("DELETE FROM document where id=?");
        $sql->execute(array(
            $document->getID()
        ));
    }
    
    
    
}