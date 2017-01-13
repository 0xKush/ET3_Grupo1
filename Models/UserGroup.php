<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class UserGroup
{
    private $id;
    private $groupid;
    private $secondarymember;
    private $member;
    private $status;
    
    
    public function __construct($id = NULL, $groupid = NULL, $secondarymember = NULL, $member = NULL, $status = NULL)
    {
        $this->id              = $id;
        $this->groupid         = $groupid;
        $this->secondarymember = $secondarymember;
        $this->member          = $member;
        $this->status          = $status;
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
    
    
    public function getGroupID()
    {
        return $this->groupid;
    }
    
    
    public function setGroupID($groupid)
    {
        $this->groupid = $groupid;
        
        return $this;
    }
    
    
    public function getSecondaryMember()
    {
        return $this->secondarymember;
    }
    
    
    public function setSecondaryMember($secondarymember)
    {
        $this->secondarymember = $secondarymember;
        
        return $this;
    }
    
    
    
    public function getMember()
    {
        return $this->member;
    }
    
    
    public function setMember($member)
    {
        $this->member = $member;
        
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
}
?>
