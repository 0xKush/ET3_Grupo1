<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Publication
{
    private $id;
    private $destination;
    private $type;
    private $owner;
    private $creationdate;
    private $hour;
    private $description;
    private $status;
    
    
    public function __construct($id = NULL, $destination = NULL, $type = NULL, $owner = NULL, $creationdate = NULL, $hour = NULL, $description = NULL, $status = NULL)
    {
        $this->id           = $id;
        $this->destination  = $destination;
        $this->type         = $type;
        $this->owner        = $owner;
        $this->creationdate = $creationdate;
        $this->hour         = $hour;
        $this->description  = $description;
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
    
    public function getDestination()
    {
        return $this->destination;
    }
    
    
    public function setDestination($destination)
    {
        $this->destination = $destination;
        
        return $this;
    }
    
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        
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
    
    
    
    public function getCreationDate()
    {
        return $this->creationdate;
    }
    
    
    public function setCreationDate($creationdate)
    {
        $this->creationdate = $creationdate;
        
        return $this;
    }
    
    
    public function getHour()
    {
        return $this->hour;
    }
    
    public function setHour($hour)
    {
        $this->hour = $hour;
        
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
        if (strlen($this->description < 4)) {
            $errors["publidescription"] = "Description must be at least 5 characters length";
            
        }
        
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Publication is not valid");
        }
    }
    
}
?>

