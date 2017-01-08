<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Document
{
    private $id;
    private $owner;
    private $location;
    private $uploaddate;
    private $status;
    
    
    public function __construct($id = NULL, $owner = NULL, $location = NULL, $uploaddate = NULL, $status = NULL)
    {
        $this->id         = $id;
        $this->owner       = $owner;
        $this->location   = $location;
        $this->uploaddate = $uploaddate;
        $this->status     = $status;
    }
    
    
    public function getID()
    {
        return $this->id;
    }
    
    private function setID($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getOwner()
    {
        return $this->owner;
    }
    
    private function setOwner($owner)
    {
        $this->owner = $owner;
        
        return $this;
    }
    
    
    public function getLocation()
    {
        return $this->location;
    }
    
    
    private function setLocation($location)
    {
        $this->location = $location;
        
        return $this;
    }
    
    public function getUploadDate()
    {
        return $this->uploaddate;
    }
    
    private function setUploadDate($uploaddate)
    {
        $this->uploaddate = $uploaddate;
        
        return $this;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    
    private function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }
    
}
?>
