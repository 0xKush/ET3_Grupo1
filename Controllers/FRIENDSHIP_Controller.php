<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/Friendship.php");
require_once(__DIR__."/../Models/FRIENDSHIP_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class FRIENDSHIP_Controller extends BaseController {

    private $friendshipModel;

    public function __construct()
    {
        parent::__construct();
        $this->friendshipModel = new FRIENDSHIP_Model();
        $this->view->setLayout("base");
    }

    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $friends = $this->friendshipModel->showall($userid);
        $this->view->setVariable("friends", $friends);
        $this->view->render("friendship", "FRIENDSHIP_SHOWALL_Vista");
    }

    public function requests()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $friends = $this->friendshipModel->showall($userid, 0);
        $this->view->setVariable("friends", $friends);
        $this->view->render("friendship", "FRIENDSHIP_SHOWALL_Vista");
    }

    public function add()
    {
        $friendship = new Friendship();
        
        if (isset($_POST["submit"])) {
            
            $friendship->setMember($_POST["member"]);
            $friendship->setSecondaryMember($_POST["secondarymember"]);

            try {
                if(!$this->friendshipModel->friendExists($_POST["member"], $_POST["secondarymember"]) && !empty($_POST["member"]) && !empty($_POST["secondarymember"])){
                    $this->friendshipModel->add($user);
                    $this->view->setFlash(sprintf(i18n("Friend successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("Friend already exists.")));
                }
            }catch(ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->redirect("friendship", "showall", "id=".$this->currentUser->getID());
    }

    public function edit()
    {

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $friendshipid = $_REQUEST["id"];
        $friendship = $this->friendshipModel->showcurrent($friendshipid);

        if ($friendship == NULL) {
            throw new Exception(i18n("No such friendship with id: ").$friendshipid);
        }
        
        
        if (isset($_POST["submit"])) {
            $friendship->setStatus(1);
            $this->friendshipModel->edit($friendship);
        }

        $this->view->redirect("friendship", "showall", "id=".$this->currentUser->getID());
    }
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $friendshipid = $_REQUEST["id"];
        $friendship = $this->friendshipModel->showcurrent($this->currentUser->getID(), $friendshipid);
        
        if ($friendship == NULL) {
            throw new Exception(i18n("No such friendship with id: ").$friendshipid);
        }
        
        if (isset($_POST["submit"])) {
            
            if ($_POST["submit"] == "yes"){
                $this->friendshipModel->delete($friendship);
                $this->view->setFlash(sprintf(i18n("Friendship successfully deleted.")));
            }
            
            $this->view->redirect("friendship", "showall", "id=".$this->currentUser->getID());
        }

        $this->view->setVariable("friendship", $friendship);
        $this->view->render("friendship", "FRIENDSHIP_DELETE_Vista");
    }
}
