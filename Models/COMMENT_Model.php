<?php

require_once(__DIR__ . "/../core/PDOConnection.php");

class COMMENT_Model
{
    private $db;
    
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }
    
    
    public function showall()
    {
        $sql = $this->db->prepare("SELECT * FROM comment ORDER BY creationdate,hour");
        $sql->execute();
        $comments_db = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        $comments = array();
        
        foreach ($comments_db as $comment) {
            array_push($comments, new Comment($comment["id"], $comment["publication"], $comment["owner"], $comment["origincomment"], $comment["creationdate"], $comment["hour"], $comment["content"], $comment["status"]));
        }
        
        return $comments;
    }
    
    
    public function showcurrent($commentID)
    {
        $sql = $this->db->prepare("SELECT * FROM comment WHERE id=?");
        $sql->execute(array(
            $commentID
        ));
        $comment = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($comment != NULL) {
            return new Comment($comment["id"], $comment["publication"], $comment["owner"], $comment["origincomment"], $comment["creationdate"], $comment["hour"], $comment["content"], $comment["status"]);
        } else {
            return NULL;
        }
    }
    
    public function add(Comment $comment)
    {
        $sql = $this->db->prepare("INSERT INTO comment(id,publication,owner,origincomment,creationdate,hour,content,status) values (?,?,?,?,?,?,?,?)");
        $sql->execute(array(
            $comment->getID(),
            $comment->getPublication(),
            $comment->getOwner(),
            $comment->getOriginComment(),
            $comment->getCreationDate(),
            $comment->getHour(),
            $comment->getContent(),
            $comment->getStatus()
        ));
    }
    
    public function edit(Comment $comment)
    {
        $sql = $this->db->prepare("UPDATE comment SET publication=?,owner=?,origincomment=?,creationdate=?,hour=?,content=?
    status=? where id=?");
        $sql->execute(array(
            $comment->getPublication(),
            $comment->getOwner(),
            $comment->getOriginComment(),
            $comment->getCreationDate(),
            $comment->getHour(),
            $comment->getContent(),
            $comment->getStatus(),
            $comment->getID()
        ));
        
    }
    
    public function delete(Comment $comment)
    {
        $sql = $this->db->prepare("DELETE FROM comment where id=?");
        $sql->execute(array(
            $comment->getID()
        ));
    }
    
}