<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Comment.php");
require_once(__DIR__ . "/../Models/COMMENT_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class COMMENT_Controller extends BaseController
{
    private $commentModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->commentModel = new COMMENT_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        $comments = $this->commentModel->showall();
        $this->view->setVariable("comments", $comments);
        $this->view->render("comment", "COMMENT_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An comment id is mandatory"));
        }
        
        $commentid = $_REQUEST["id"];
        $comment   = $this->commentModel->showcurrent($commentid);
        
        if ($comment == NULL) {
            throw new Exception(i18n("No such comment with id: ") . $commentid);
        }
        
        $this->view->setVariable("comment", $comment);
        $this->view->render("comment", "COMMENT_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $comment = new Comment();
        $publicationid = $_REQUEST["publication"];

        if (isset($_POST["submit"])) {
            $comment->setPublication($_POST["publication"]);
            $comment->setOwner($_POST["owner"]);
            $comment->setOriginComment($_POST["origincomment"]);
            $comment->setCreationDate($_POST["creationdate"]);
            $comment->setHour($_POST["hour"]);
            $comment->setContent($_POST["content"]);
            $comment->setStatus($_POST["status"]);
            
            try {
                $comment->checkIsValidForCreate();
                $this->commentModel->add($comment);
                $this->view->setFlash(sprintf(i18n("Comment\"%s\" successfully added.")));
                $this->view->redirect("publication", "showcurrent", "&id=".$publicationid);
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }

        $this->view->setVariable("publicationid", $publicationid);
        $this->view->setVariable("comment", $comment);
        $this->view->render("comment", "COMMENT_ADD_Vista");
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An comment id is mandatory"));
        }
        
        $commentid = $_REQUEST["id"];
        $comment   = $this->commentModel->showcurrent($commentid);
        
        if ($comment == NULL) {
            throw new Exception(i18n("No such comment with id: ") . $commentid);
        }
        
        if (isset($_POST["submit"])) {
            $comment->setPublication($_POST["publication"]);
            $comment->setOwner($_POST["owner"]);
            $comment->setOriginComment($_POST["origincomment"]);
            $comment->setCreationDate($_POST["creationdate"]);
            $comment->setHour($_POST["hour"]);
            $comment->setContent($_POST["content"]);
            $comment->setStatus($_POST["status"]);
            
            
            try {
                $comment->checkIsValidForCreate();
                $this->commentModel->edit($comment);
                $this->view->setFlash(sprintf(i18n("Comment \"%s\" successfully updated.")));
                $this->view->redirect("comment", "show");
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("comment", $comment);
        $this->view->render("comment", "COMMENT_EDIT_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $commentid = $_REQUEST["id"];
        $comment   = $this->commentModel->showcurrent($commentid);
        
        if ($comment == NULL) {
            throw new Exception(i18n("No such comment with id: ") . $commentid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->commentModel->delete($comment);
                $this->view->setFlash(sprintf(i18n("Comment \"%s\" successfully deleted.")));
            }
            $this->view->redirect("comment", "show");
        }
        $this->view->setVariable("comment", $comment);
        $this->view->render("comment", "COMMENT_DELETE_Vista");
    }
    
}
