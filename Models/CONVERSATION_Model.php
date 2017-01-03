<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
/*$id = NULL, $member = NULL, $secondarymember = NULL, $startdate = NULL, $status = NULL*/
class CONVERSATION_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM conversation ORDER BY startdate ASC");
        $sql->execute();
        $conversations_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $conversations = array();
        
        foreach ($conversations_db as $conversation) {
            array_push($conversations, new Conversation($message["id"], $message["member"], $message["secondarymember"], $message["startdate"], $message["status"]));
        }
        
        return $conversations;
    }
    
    
    public function showcurrent($conversationID)
    {
        $sql = $this->db->prepare("SELECT * FROM conversation WHERE id = ?");
        $sql->execute(array(
            $conversationID
        ));
        $conversation = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($conversation != NULL) {
            return new Conversation($message["id"], $message["member"], $message["secondarymember"], $message["startdate"], $message["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Conversation $conversation)
    {
        $sql = $this->db->prepare("INSERT INTO conversation(member,secondarymember,startdate,status) values (?,?,?,?)");
        $sql->execute(array(
            $conversation->getMember(),
            $conversation->getSecondaryMember(),
            $conversation->getStartDate(),
            $conversation->getStatus()
        ));
    }
    
    
    public function delete(Conversation $conversation)
    {
        $sql = $this->db->prepare("DELETE FROM conversation where id=?");
        $sql->execute(array(
            $conversation->getID()
        ));
    }
}