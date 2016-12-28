<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Document
{
    private $id;
    private $user;
    private $location;
    private $uploaddate;
    private $status;
    
    
    public function __construct($id = NULL, $user = NULL, $location = NULL, $uploaddate = NULL, $status = NULL)
    {
        $this->id         = $id;
        $this->user       = $user;
        $this->location   = $location;
        $this->uploaddate = $uploaddate;
        $this->status     = $status;
    }
    
    /*  public function checkIsValidForCreate()
    {
    $errors = array();
    if (strlen($this->name < 4)) {
    $errors["groupname"] = "Group name must be at least 5 characters length";
    
    }
    
    if (sizeof($errors) > 0) {
    throw new ValidationException($errors, "Group is not valid");
    }
    }*/
    
    
    public function getID()
    {
        return $this->id;
    }
    
    private function setID($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    private function setUser($user)
    {
        $this->user = $user;
        
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
