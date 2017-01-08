<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class PubliDoc
{
    private $document;
    private $publication;
    
    public function __construct($document = NULL, $publication = NULL)
    {
        $this->document    = $document;
        $this->publication = $publication;
        
    }
    
    public function getDocument()
    {
        return $this->document;
    }
    
    
    private function setDocument($document)
    {
        $this->document = $document;
        
        return $this;
    }
    
    
    public function getPublication()
    {
        return $this->publication;
    }
    
    
    private function setPublication($publication)
    {
        $this->publication = $publication;
        
        return $this;
    }
}
?>
