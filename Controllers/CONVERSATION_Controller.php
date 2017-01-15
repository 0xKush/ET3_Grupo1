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
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];

        if ($this->currentUser->getID() != $userid){
            if (!$this->permissions->isAdmin($this->currentUser->getID())
            ){
                $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
                $this->view->redirect("user", "login");
            }
        }
        
        $conversations = $this->conversationModel->showall($userid);
        $this->view->setVariable("conversations", $conversations);
        $this->view->render("conversation", "CONVERSATION_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A conversation id is mandatory"));
        }
        
        $conversationid = $_REQUEST["id"];

        if (!$this->permissions->isAdmin($this->currentUser->getID()) &&
            !$this->permissions->isConversationMember($this->currentUser->getID(), $conversationid)
        ){
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $conversation   = $this->conversationModel->showcurrent($conversationid);
        
        if ($conversation == NULL) {
            throw new Exception(i18n("No such conversation with id: ") . $conversationid);
        }

        $isFriend= $this->permissions->isFriend($conversation->getMember(),$conversation->getSecondaryMember());
        
        $this->view->setVariable("isFriend", $isFriend);
        $this->view->setVariable("conversation", $conversation);
        $this->view->render("conversation", "CONVERSATION_SHOWCURRENT_Vista");
    }
    
    public function add()
    {

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A conversation id is mandatory"));
        }

        $conversation = new Conversation();
        
        $conversation->setMember($this->currentUser->getID());
        $conversation->setSecondaryMember($_REQUEST["id"]);
        $conversation->setStartDate(date("Y-m-d"));
        $conversation->setStatus(1);
            
        try {
            if (!$this->conversationModel->conversationExists($conversation)) {
                $this->conversationModel->add($conversation);
            }
        }
        catch (ValidationException $ex) {
            $this->view->setFlash(sprintf(i18n("Conversation error: \"%s\"."), $ex->getErrors()));
            $this->view->redirect("conversation", "show");
        }

        $conversation = $this->conversationModel->conversation_by_friend($this->currentUser->getID(), $_REQUEST["id"]);
        $this->view->redirect("conversation", "showcurrent", "id=".$conversation->getID());
    }
    
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A conversation id is mandatory"));
        }
        
        $conversationid = $_REQUEST["id"];

        if (!$this->permissions->isAdmin($this->currentUser->getID()) &&
            !$this->permissions->isConversationMember($this->currentUser->getID(), $conversationid)
        ){
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $conversation   = $this->conversationModel->showcurrent($conversationid);
        
        if ($conversation == NULL) {
            throw new Exception(i18n("No such conversation with id: ") . $conversationid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->conversationModel->delete($conversation);
                $this->view->setFlash(sprintf(i18n("Conversation \"%s\" successfully deleted.")));
            }
            $this->view->redirect("conversation", "showall","id=".$this->currentUser->getID());
        }
        $this->view->setVariable("conversation", $conversation);
        $this->view->render("conversation", "CONVERSATION_DELETE_Vista");
    }
    
    
}
