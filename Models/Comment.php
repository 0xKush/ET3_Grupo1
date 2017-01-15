<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Comment
{
    private $id;
    private $publication;
    private $owner;
    private $origincomment;
    private $creationdate;
    private $hour;
    private $content;
    private $status;
    
    
    public function __construct($id = NULL, $publication = NULL, $owner = NULL, $origincomment = NULL, $creationdate = NULL, $hour = NULL, $content = NULL, $status = NULL)
    {
        $this->id            = $id;
        $this->publication   = $publication;
        $this->owner         = $owner;
        $this->origincomment = $origincomment;
        $this->creationdate  = $creationdate;
        $this->hour          = $hour;
        $this->content       = $content;
        $this->status        = $status;
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
    
    
    public function getPublication()
    {
        return $this->publication;
    }
    
    
    public function setPublication($publication)
    {
        $this->publication = $publication;
        
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
    
    
    public function getOriginComment()
    {
        return $this->origincomment;
    }
    
    
    public function setOriginComment($origincomment)
    {
        $this->origincomment = $origincomment;
        
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
    
    
    public function getContent()
    {
        return $this->content;
    }
    
    
    public function setContent($content)
    {
        $this->content = $content;
        
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
        if (strlen($this->content) < 1) {
            $errors["commentcontent"] = "Content must be at least 1 character length";
            
        }
        
        if (sizeof($errors) > 0) {
            throw new ValidationException($errors, "Comment is not valid");
        }
    }
}
?>
