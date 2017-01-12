<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../Models/Message.php");


class MESSAGE_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall($conversationID)
    {
        $sql = $this->db->prepare("SELECT * FROM message WHERE conversation=? ORDER BY id ASC");
        $sql->execute(array($conversationID));
        $messages_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $messages = array();
        
        foreach ($messages_db as $message) {
            array_push($messages, new Message($message["id"], $message["conversation"], $message["owner"], $message["senddate"], $message["sendhour"], $message["content"], $message["status"]));
        }
        
        return $messages;
    }
    
    
    public function showcurrent($messageID)
    {
        $sql = $this->db->prepare("SELECT * FROM message WHERE id = ?");
        $sql->execute(array(
            $messageID
        ));
        $message = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($message != NULL) {
            return new Message($message["id"], $message["conversation"], $message["owner"], $message["senddate"], $message["sendhour"], $message["content"], $message["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Message $message)
    {
        $sql = $this->db->prepare("INSERT INTO message(conversation,owner,senddate,sendhour,content,status) values (?,?,?,?,?,?)");
        $sql->execute(array(
            $message->getConversation(),
            $message->getOwner(),
            $message->getSendDate(),
            $message->getSendHour(),
            $message->getContent(),
            $message->getStatus()
        ));
    }
    
    
    public function delete(Message $message)
    {
        $sql = $this->db->prepare("DELETE FROM message where id=?");
        $sql->execute(array(
            $message->getID()
        ));
    }
}
