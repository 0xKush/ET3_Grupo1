<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Conversation.php");
require_once(__DIR__ . "/../Models/CONVERSATION_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class CONVERSATION_Controller extends BaseController
{
    private $conversationModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->conversationModel = new CONVERSATION_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        $conversations = $this->conversationModel->showall();
        $this->view->setVariable("conversations", $conversations);
        $this->view->render("conversation", "CONVERSATION_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A conversation id is mandatory"));
        }
        
        $conversationid = $_REQUEST["id"];
        $conversation   = $this->conversationModel->showcurrent($conversationid);
        
        if ($conversation == NULL) {
            throw new Exception(i18n("No such conversation with id: ") . $conversationid);
        }
        
        $this->view->setVariable("conversation", $conversation);
        $this->view->render("conversation", "CONVERSATION_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $conversation = new Conversation();
        
        if (isset($_POST["submit"])) {
            $conversation->setMember($_POST["member"]);
            $conversation->setSecondaryMember($_POST["secondarymember"]);
            $conversation->setStartDate($_POST["startdate"]);
            $conversation->setStatus($_POST["status"]);
            
            try {
                /*   if (!$this->conversationModel->nameExists($_POST["name"])) {*/
                $this->conversationModel->add($conversation);
                $this->view->setFlash(sprintf(i18n("Conversation\"%s\" successfully added.")));
                $this->view->redirect("conversation", "show");
                /*  } else {
                $errors            = array();
                $errors["general"] = i18n("Conversation already exists");
                $this->view->setVariable("errors", $errors);
                }*/
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("conversation", $conversation);
        $this->view->render("conversation", "CONVERSATION_ADD_Vista");
    }
    
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A conversation id is mandatory"));
        }
        
        $conversationid = $_REQUEST["id"];
        $conversation   = $this->conversationModel->showcurrent($conversationid);
        
        if ($conversation == NULL) {
            throw new Exception(i18n("No such conversation with id: ") . $conversationid);
        }
        
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->conversationModel->delete($conversation);
                $this->view->setFlash(sprintf(i18n("Conversation \"%s\" successfully deleted.")));
            }
            $this->view->redirect("conversation", "show");
        }
        $this->view->setVariable("conversation", $conversation);
        $this->view->render("conversation", "CONVERSATION_DELETE_Vista");
    }
    
    
}
