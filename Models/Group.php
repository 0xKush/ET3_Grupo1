<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Group
{
    private $id;
    private $name;
    private $description;
    private $owner;
    private $private;
    private $creationdate;
    private $status;
    
    
    public function __construct($id = NULL, $name = NULL, $description = NULL, $owner = NULL, $private = NULL, $creationdate = NULL, $status = NULL)
    {
        $this->id           = $id;
        $this->name         = $name;
        $this->description  = $description;
        $this->owner        = $owner;
        $this->private      = $private;
        $this->creationdate = $creationdate;
        $this->status       = $status;
    }
    
    
    
    public function getID()
    {
        return $this->id;
    }
    
    public function setID($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    
    public function getDescription()
    {
        return $this->description;
    }
    
    
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    public function getOwner()
    {
        return $this->owner;
    }
    
    public function setOwner($owner)
    {
        $this->owner = $owner;
        
        return $this;
    }
    
    
    public function getPrivate()
    {
        return $this->private;
    }
    
    public function setPrivate($private)
    {
        $this->private = $private;
        
        return $this;
    }
    
    
    public function getCreationDate()
    {
        return $this->creationdate;
    }
    
    
    public function setCreationDate($creationdate)
    {
        $this->creationdate = $creationdate;
        
        return $this;
    }
    
    
    public function getStatus()
    {
        return $this->status;
    }
    
    
    public function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }
    
    public function checkIsValidForCreate()
    {
        $errors = array();
        if (strlen($this->getName()) < 5) {
            $errors["groupname"] = "Group name must be at least 5 characters length";
            
        }
        
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Group is not valid");
        }
    }
    
    
}
?>
