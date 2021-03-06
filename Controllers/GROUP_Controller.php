<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Group.php");
require_once(__DIR__ . "/../Models/GROUP_Model.php");
require_once(__DIR__ . "/../Models/UserGroup.php");
require_once(__DIR__ . "/../Models/USERGROUP_Model.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");
require_once(__DIR__ . "/../Services/Permissions.php");

class GROUP_Controller extends BaseController
{
    private $groupModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->groupModel = new GROUP_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        if (!$this->permissions->isAdmin($this->currentUser->getID())) {
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $groups = $this->groupModel->showall();
        $this->view->setVariable("groups", $groups);
        $this->view->render("group", "GROUP_SHOWALL_ADMIN_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An group id is mandatory"));
        }
        
        $groupid = $_REQUEST["id"];
        
        if (!$this->permissions->isAdmin($this->currentUser->getID()) && !$this->permissions->isOwner($this->currentUser->getID(), $groupid, "groupp") && !$this->permissions->isGroupMember($this->currentUser->getID(), $groupid) && !$this->permissions->isPublic($groupid, "groupp")) {
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $group = $this->groupModel->showcurrent($groupid);
        
        if ($group == NULL) {
            throw new Exception(i18n("No such group with id: ") . $groupid);
        }
        
        $perm     = new Permissions();
        $ismember = false;
        
        if ($perm->isGroupMember($this->currentUser->getID(), $groupid)) {
            $ismember = true;
        }
        
        $publicationModel = new PUBLICATION_Model();
        
        $publications = $publicationModel->showall($groupid, "group");
        
        $members = $this->groupModel->showmembers($groupid);
        
        $this->view->setVariable("group", $group);
        
        $this->view->setVariable("members", $members);
        
        $this->view->setVariable("ismember", $ismember);
        
        $this->view->setVariable("publications", $publications);
        
        $this->view->render("group", "GROUP_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        if (!$this->currentUser->getID()) {
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $group = new Group();
        
        if (isset($_POST["submit"])) {
            if (!empty($_POST["name"])) {
                $group->setName($_POST["name"]);
            } else {
                $this->view->setFlash(sprintf(i18n("Group name is required.")));
                $this->view->redirect("group", "add");
            }
            
            $group->setDescription($_POST["description"]);
            $group->setOwner($this->currentUser->getID());
            $group->setPrivate($_POST["private"]);
            $group->setStatus(1);
            
            try {
                if (!$this->groupModel->nameExists($_POST["name"])) {
                    $group->checkIsValidForCreate();
                    $this->groupModel->add($group);
                    $this->view->setFlash(sprintf(i18n("Group\"%s\" successfully added."), $group->getName()));
                    if ($this->permissions->isAdmin($this->currentUser->getID())) {
                        $this->view->redirect("group", "showall");
                    }
                    $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Group already exists");
                    $this->view->setVariable("errors", $errors);
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("group", $group);
        $this->view->render("group", "GROUP_ADD_Vista");
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An group id is mandatory"));
        }
        
        $groupid = $_REQUEST["id"];
        
        if (!$this->permissions->isAdmin($this->currentUser->getID()) && !$this->permissions->isOwner($this->currentUser->getID(), $groupid, "groupp")) {
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $group = $this->groupModel->showcurrent($groupid);
        if ($group == NULL) {
            throw new Exception(i18n("No such group with id: ") . $groupid);
        }
        if (isset($_POST["submit"])) {
            if (!empty($_POST["name"])) {
                $group->setName($_POST["name"]);
            } else {
                $this->view->setFlash(sprintf(i18n("Group name is required.")));
                $this->view->redirect("group", "add", "id=" . $groupid);
            }
            
            $group->setDescription($_POST["description"]);
            $group->setOwner($this->currentUser->getID());
            $group->setPrivate($_POST["private"]);
            $group->setStatus($_POST["status"]);
            
            try {
                $group->checkIsValidForCreate();
                $this->groupModel->edit($group);
                $this->view->setFlash(sprintf(i18n("Group \"%s\" successfully updated."), $group->getName()));
                if ($this->permissions->isAdmin($this->currentUser->getID())) {
                    $this->view->redirect("group", "showall");
                }
                $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("group", $group);
        $this->view->render("group", "GROUP_EDIT_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        $groupid = $_REQUEST["id"];
        
        if (!$this->permissions->isAdmin($this->currentUser->getID()) && !$this->permissions->isOwner($this->currentUser->getID(), $groupid, "groupp")) {
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $group = $this->groupModel->showcurrent($groupid);
        if ($group == NULL) {
            throw new Exception(i18n("No such group with id: ") . $groupid);
        }
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->groupModel->delete($group);
                $this->view->setFlash(sprintf(i18n("Group \"%s\" successfully deleted."), $group->getName()));
            }
            if ($this->permissions->isAdmin($this->currentUser->getID())) {
                $this->view->redirect("group", "showall");
            }
            $this->view->redirect("usergroup", "showall", "id=" . $this->currentUser->getID());
        }
        $this->view->setVariable("group", $group);
        $this->view->render("group", "GROUP_DELETE_Vista");
    }
    
    public function search()
    {
        if (isset($_POST["submit"])) {
            $query = "";
            $flag  = 0;
            if ($_POST["name"]) {
                $query .= "name LIKE '%" . $_POST["name"] . "%'";
                $flag = 1;
            }
            if ($_POST["description"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "description LIKE '%" . $_POST["description"] . "%'";
                $flag = 1;
            }
            if ($_POST["owner"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "owner LIKE '%" . $_POST["owner"] . "%'";
                $flag = 1;
            }
            if ($_POST["private"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "private LIKE '%" . $_POST["private"] . "%'";
                $flag = 1;
            }
            if ($_POST["creationdate"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "creationdate LIKE '%" . $_POST["creationdate"] . "%'";
                $flag = 1;
            }
            if ($_POST["status"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "status LIKE '%" . $_POST["status"] . "%'";
                $flag = 1;
            }
            if (empty($query)) {
                $groups = $this->groupModel->showall();
            } else {
                $groups = $this->groupModel->search($query);
            }
            
            $usergroupModel = new USERGROUP_Model();
            $usergroups     = $usergroupModel->getGroups($this->currentUser->getID());
            
            $this->view->setVariable("usergroups", $usergroups);
            
            $this->view->setVariable("groups", $groups);
            $this->view->render("group", "GROUP_SHOWALL_Vista");
        } else {
            $this->view->render("group", "GROUP_SEARCH_Vista");
        }
    }
    
}
