<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Group.php");
require_once(__DIR__ . "/../Models/GROUP_Model.php");
require_once(__DIR__ . "/../Models/UserGroup.php");
require_once(__DIR__ . "/../Models/USERGROUP_Model.php");
require_once(__DIR__ . "/../Models/User.php");
require_once(__DIR__ . "/../Models/USER_Model.php");
require_once(__DIR__ . "/../Models/Friendship.php");
require_once(__DIR__ . "/../Models/FRIENDSHIP_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class USERGROUP_Controller extends BaseController
{
    private $usergroupModel;
    private $userModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->usergroupModel = new USERGROUP_Model();
        $this->userModel = new USER_Model();
        $this->view->setLayout("base");
    }
    
    
    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $groups = $this->usergroupModel->showall($userid);
        $this->view->setVariable("groups", $groups);
        $requests = $this->usergroupModel->showall($userid, 0);
        $this->view->setVariable("requests", $requests);
         $owners = array();
        foreach ($groups as $group) {
            $owners[$group->getOwner()] = $this->userModel->showcurrent($group->getOwner());
        }
        $this->view->setVariable("owners", $owners);
        $this->view->render("usergroup", "USERGROUP_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A usergroup id is mandatory"));
        }
        
        $usergroup = $_REQUEST["id"];
        $usergroup = $this->usergroupModel->showcurrent($usergroup);
        
        if ($usergroup == NULL) {
            throw new Exception(i18n("No such usergroup with id: ") . $usergroup);
        }
        
        $this->view->setVariable("usergroup", $usergroup);
        $this->view->render("usergroup", "USERGROUP_SHOWCURRENT_Vista");
    }
    
    //invitacion a grupos
    public function requests()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $groups = $this->usergroupModel->showall($userid, 0);

        $this->view->setVariable("groups", $groups);
       
        $this->view->render("usergroup", "USERGROUP_SHOWALL_Vista");
    }
    
    public function add()
    {
        $usergroup = new UserGroup();
        
        if (isset($_POST["submit"])) {
            $usergroup->setGroupID($_POST["groupid"]);
            $usergroup->setSecondaryMember($_POST["secondarymember"]);
            $usergroup->setMember($_POST["member"]);
            $usergroup->setStatus($_POST["status"]);
            
            try {
                if (!$this->usergroupModel->usergroupExists($_POST["groupid"], $_POST["member"], $_POST["secondarymember"]) && !empty($_POST["groupid"]) && !empty($_POST["member"]) && !empty($_POST["secondarymember"])) {
                    $this->usergroupModel->add($usergroup);
                    $this->view->setFlash(sprintf(i18n("UserGroup successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("UserGroup already exists.")));
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
    }

    public function invite()
    {

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $groupid = $_REQUEST["id"];
        $groupModel = new GROUP_Model();
        $group = $groupModel->showcurrent($groupid);

        if ($group == NULL) {
            throw new Exception(i18n("No such usergroup with id: ") . $groupid);
        }
        
        if (isset($_POST["submit"])) {
            $invites= $_POST["invites"];
            foreach ($invites as $invite){
                $usergroup = new UserGroup();
                $usergroup->setGroupID($groupid);
                $usergroup->setSecondaryMember($invite);
                $usergroup->setMember($this->currentUser->getID());
                $usergroup->setStatus(0);
            
                try {
                    if (!$this->usergroupModel->usergroupExists($usergroup->getGroupID(), $usergroup->getMember(), $usergroup->getSecondaryMember())) {
                        $this->usergroupModel->add($usergroup);
                    }
                }
                catch (ValidationException $ex) {
                    $errors = $ex->getErrors();
                    $this->view->setVariable("errors", $errors);
                }
            }
            $this->view->setFlash(sprintf(i18n("Invitations successfully sent.")));
            $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
        }

        if ($this->permissions->isAdmin($this->currentUser->getID())){
            $userModel = new USER_Model();
            $friends = $userModel->showall();
        } else {
            $friendshipModel = new FRIENDSHIP_Model();
            $friends = $friendshipModel->showall($this->currentUser->getID());
        }

        $this->view->setVariable("friends", $friends);
        $this->view->setVariable("group", $group);
        $this->view->render("usergroup", "USERGROUP_INVITE_Vista");
        
    }

    public function join()
    {
        $usergroup = new UserGroup();
        
        if (isset($_POST["submit"])) {
            $usergroup->setGroupID($_POST["groupid"]);
            $usergroup->setMember($_POST["member"]);
            $usergroup->setStatus(1);
            
            try {
                if (!$this->usergroupModel->usergroupExists($_POST["groupid"], $_POST["member"], NULL) && !empty($_POST["groupid"]) && !empty($_POST["member"])) {
                    $this->usergroupModel->add($usergroup);
                    $this->view->setFlash(sprintf(i18n("UserGroup successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("UserGroup already exists.")));
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $usergroupid = $_REQUEST["id"];
        $usergroup   = $this->usergroupModel->showcurrent($this->currentUser->getID(), $usergroupid);
        
        if ($usergroup == NULL) {
            throw new Exception(i18n("No such usergroup with id: ") . $usergroupid);
        }
        
        
        if (isset($_POST["submit"])) {
            $usergroup->setStatus(1);
        }
        
        $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }

        if (isset($_REQUEST["kick"])) {
            $usertodelete = $_REQUEST["kick"];
        } else {
            $usertodelete = $this->currentUser->getID();
        }
        
        $usergroupid = $_REQUEST["id"];
        $usergroup   = $this->usergroupModel->showcurrent($usertodelete, $usergroupid);

        if ($usergroup == NULL) {
            throw new Exception(i18n("No such usergroup with id: ") . $usergroupid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->usergroupModel->delete($usergroup);
                $this->view->setFlash(sprintf(i18n("UserGroup successfully deleted.")));
            }
            
            $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
        }
        
        $this->view->setVariable("usergroup", $usergroup);
        $this->view->render("usergroup", "USERGROUP_DELETE_Vista");
    }
}