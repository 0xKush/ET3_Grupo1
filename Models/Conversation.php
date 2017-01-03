<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Conversation
{
    private $id;
    private $member;
    private $secondarymember;
    private $startdate;
    private $status;
    
    
    public function __construct($id = NULL, $member = NULL, $secondarymember = NULL, $startdate = NULL, $status = NULL)
    {
        $this->id              = $id;
        $this->member          = $member;
        $this->secondarymember = $secondarymember;
        $this->startdate       = $startdate;
        $this->status          = $status;
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
    
    
    public function getMember()
    {
        return $this->member;
    }
    
    private function setMember($member)
    {
        $this->member = $member;
        
        return $this;
    }
    
    
    public function getSecondaryMember()
    {
        return $this->secondarymember;
    }
    
    
    private function setSecondaryMember($secondarymember)
    {
        $this->secondarymember = $secondarymember;
        
        return $this;
    }
    
    
    public function getStartDate()
    {
        return $this->startdate;
    }
    
    
    private function setStartDate($startdate)
    {
        $this->startdate = $startdate;
        
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
