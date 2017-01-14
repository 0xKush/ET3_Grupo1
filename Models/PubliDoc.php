<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class PubliDoc
{
    private $id;
    private $document;
    private $publication;
    
    public function __construct($id = NULL, $document = NULL, $publication = NULL)
    {
        $this->document    = $document;
        $this->publication = $publication;
        
    }
    
    public function getID()
    {
        return $this->id;
    }
    
    public function setID($id)
    {
        $this->id = $id;
    }
    
    public function getDocument()
    {
        return $this->document;
    }
    
    
    public function setDocument($document)
    {
        $this->document = $document;
        
        return $this;
    }
    
    
    public function getPublication()
    {
        return $this->publication;
    }
    
    
    public function setPublication($publication)
    {
        $this->publication = $publication;
        
        return $this;
    }
}
?>
