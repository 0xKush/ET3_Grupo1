<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class Message
{
    private $id;
    private $conversation;
    private $owner;
    private $senddate;
    private $sendhour;
    private $content;
    private $status;
    
    
    public function __construct($id = NULL, $conversation = NULL, $owner = NULL, $senddate = NULL, $sendhour = NULL, $content = NULL, $status = NULL)
    {
        $this->id           = $id;
        $this->conversation = $conversation;
        $this->owner        = $owner;
        $this->content      = $content;
        $this->senddate     = $senddate;
        $this->sendhour     = $sendhour;
        $this->status       = $status;
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
    
    
    public function getConversation()
    {
        return $this->conversation;
    }
    
    
    private function setConversation($conversation)
    {
        $this->conversation = $conversation;
        
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
    
    
    public function getSendDate()
    {
        return $this->senddate;
    }
    
    
    private function setSendDate($senddate)
    {
        $this->senddate = $senddate;
        
        return $this;
    }
    
    
    public function getSendHour()
    {
        return $this->sendhour;
    }
    
    
    private function setSendHour($sendhour)
    {
        $this->sendhour = $sendhour;
        
        return $this;
    }
    
    
    public function getContent()
    {
        return $this->content;
    }
    
    
    private function setContent($content)
    {
        $this->content = $content;
        
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
