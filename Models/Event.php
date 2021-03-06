<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Event
{
    private $id;
    private $creationdate;
    private $owner;
    private $startdate;
    private $enddate;
    private $starthour;
    private $endhour;
    private $description;
    private $status;
    private $name;
    private $private;
    
    
    public function __construct($id = NULL, $creationdate = NULL, $owner = NULL, $startdate = NULL, $enddate = NULL, $starthour = NULL, $endhour = NULL, $description = NULL, $status = NULL, $name = NULL, $private = NULL)
    {
        $this->id           = $id;
        $this->creationdate = $creationdate;
        $this->owner        = $owner;
        $this->startdate    = $startdate;
        $this->enddate      = $enddate;
        $this->starthour    = $starthour;
        $this->endhour      = $endhour;
        $this->description  = $description;
        $this->status       = $status;
        $this->name         = $name;
        $this->private      = $private;
    }
    
    
    
    public function checkIsValidForCreate()
    {
        $errors = array();
        if (strlen($this->name) < 4) {
            $errors["eventname"] = "Event name must be at least 5 characters length";
            
        }
        
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Event is not valid");
        }
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
    
    
    public function getCreationDate()
    {
        return $this->creationdate;
    }
    
    
    public function setCreationDate($creationdate)
    {
        $this->creationdate = $creationdate;
        
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
    
    
    public function getStartDate()
    {
        return $this->startdate;
    }
    
    
    public function setStartDate($startdate)
    {
        $this->startdate = $startdate;
        
        return $this;
    }
    
    
    public function getEndDate()
    {
        return $this->enddate;
    }
    
    
    public function setEndDate($enddate)
    {
        $this->enddate = $enddate;
        
        return $this;
    }
    
    
    public function getStartHour()
    {
        return $this->starthour;
    }
    
    
    public function setStartHour($starthour)
    {
        $this->starthour = $starthour;
        
        return $this;
    }
    
    
    public function getEndHour()
    {
        return $this->endhour;
    }
    
    
    public function setEndHour($endhour)
    {
        $this->endhour = $endhour;
        
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
    
    
    public function getName()
    {
        return $this->name;
    }
    
    
    public function setName($name)
    {
        $this->name = $name;
        
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
}
?>
