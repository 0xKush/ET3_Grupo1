<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class DOCUMENT_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM document ORDER BY uploaddate");
        $sql->execute();
        $documents_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $documents = array();
        
        foreach ($documents_db as $group) {
            array_push($documents, new Document($document["id"], $document["user"], $document["location"], $document["uploaddate"], $document["status"]));
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
            return new Document($document["id"], $document["user"], $document["location"], $document["uploaddate"], $document["status"]);
        } else {
            return NULL;
        }
    }
    
    
    public function show_by_user($user)
    {
        $sql = $this->db->prepare("SELECT * FROM document WHERE user=?");
        $sql->execute(array(
            $user
        ));
        $group = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($group != NULL) {
            return new Document($document["id"], $document["user"], $document["location"], $document["uploaddate"], $document["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Document $document)
    {
        $sql = $this->db->prepare("INSERT INTO document(user,location,uploaddate,status) values (?,?,?,?)");
        $sql->execute(array(
            $document->getOwner(),
            $document->getLocation(),
            $document->getUploadDate(),
            $document->getStatus()
        ));
    }
    
    public function edit(Document $document)
    {
        $sql = $this->db->prepare("UPDATE document SET user=?, location=?,
            uploaddate=?,status=? where id=?");
        $sql->execute(array(
            $document->getOwner(),
            $document->getLocation(),
            $document->getUploadDate(),
            $document->getStatus(),
            $document->getID()
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