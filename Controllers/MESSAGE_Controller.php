<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Message.php");
require_once(__DIR__ . "/../Models/MESSAGE_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class MESSAGE_Controller extends BaseController
{
    private $messageModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->messageModel = new MESSAGE_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        if (!isset($_REQUEST["conversation"])) {
            throw new Exception(i18n("A conversation is mandatory"));
        }
        
        $conversation = $_REQUEST["conversation"];
        $messages     = $this->messageModel->showall($conversation);
        
        if ($message == NULL) {
            throw new Exception(i18n("No such messages with conversation id: ") . $conversation);
        }
        
        $this->view->setVariable("messages", $messages);
        $this->view->render("message", "MESSAGE_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A message id is mandatory"));
        }
        
        $messageid = $_REQUEST["id"];
        $message   = $this->messageModel->showcurrent($messageid);
        
        if ($message == NULL) {
            throw new Exception(i18n("No such message with id: ") . $messageid);
        }
        
        $this->view->setVariable("message", $message);
        $this->view->render("message", "MESSAGE_SHOWCURRENT_Vista");
    }
    
    
    public function add()
    {
        $message = new Message();
        
        if (isset($_POST["submit"])) {
            $message->setConversation($_POST["conversation"]);
            $message->setOwner($_POST["owner"]);
            $message->setSendDate($_POST["senddate"]);
            $message->setSendHour($_POST["sendhour"]);
            $message->setContent($_POST["content"]);
            $message->setStatus($_POST["status"]);
            
            try {
                $this->messageModel->add($message);
                $this->view->setFlash(sprintf(i18n("Message\"%s\" successfully sent.")));
                $this->view->redirect("conversation", "showcurrent", "id=".$_POST["conversation"]);
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("message", $message);
        $this->view->render("message", "MESSAGE_ADD_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A message id is mandatory"));
        }
        
        $messageid = $_REQUEST["id"];
        $message   = $this->messageModel->showcurrent($messageid);
        
        if ($message == NULL) {
            throw new Exception(i18n("No such message with id: ") . $messageid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->messageModel->delete($message);
                $this->view->setFlash(sprintf(i18n("Message \"%s\" successfully deleted.")));
            }
            
            $this->view->redirect("conversation", "showcurrent", "&id=".$message->getConversation());
        }
        $this->view->setVariable("message", $message);
        $this->view->render("message", "MESSAGE_DELETE_Vista");
    }
    
    
    
    
    
}
