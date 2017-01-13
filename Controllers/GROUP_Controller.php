<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Group.php");
require_once(__DIR__ . "/../Models/GROUP_Model.php");
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
        $groups = $this->groupModel->showall();
        $this->view->setVariable("groups", $groups);
        $this->view->render("group", "GROUP_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An group id is mandatory"));
        }
        
        $groupid = $_REQUEST["id"];
        $group   = $this->groupModel->showcurrent($groupid);
        
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
        
        
        $this->view->setVariable("group", $group);
        
        $this->view->setVariable("ismember", $ismember);
        
        $this->view->setVariable("publications", $publications);
        
        $this->view->render("group", "GROUP_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $group = new Group();
        
        if (isset($_POST["submit"])) {
            $group->setName($_POST["name"]);
            $group->setDescription($_POST["description"]);
            $group->setOwner($_POST["owner"]);
            $group->setPrivate($_POST["private"]);
            $group->setCreationDate($_POST["creationdate"]);
            $group->setStatus($_POST["status"]);
            
            try {
                if (!$this->groupModel->nameExists($_POST["name"])) {
                    $group->checkIsValidForCreate();
                    $this->groupModel->add($group);
                    $this->view->setFlash(sprintf(i18n("Group\"%s\" successfully added."), $group->getName()));
                    $this->view->redirect("group", "show");
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
        $group   = $this->groupModel->showcurrent($groupid);
        if ($group == NULL) {
            throw new Exception(i18n("No such group with id: ") . $groupid);
        }
        if (isset($_POST["submit"])) {
            $group->setName($_POST["name"]);
            $group->setDescription($_POST["description"]);
            $group->setOwner($_POST["owner"]);
            $group->setPrivate($_POST["private"]);
            $group->setCreationDate($_POST["creationdate"]);
            $group->setStatus($_POST["status"]);
            
            try {
                if (!$this->groupModel->nameExists($_POST["name"])) {
                    $group->checkIsValidForCreate();
                    $this->groupModel->edit($group);
                    $this->view->setFlash(sprintf(i18n("Group \"%s\" successfully updated."), $group->getName()));
                    $this->view->redirect("group", "show");
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
        $this->view->render("group", "GROUP_EDIT_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        $groupid = $_REQUEST["id"];
        $group   = $this->groupModel->showcurrent($groupid);
        if ($group == NULL) {
            throw new Exception(i18n("No such group with id: ") . $groupid);
        }
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->groupModel->delete($group);
                $this->view->setFlash(sprintf(i18n("Group \"%s\" successfully deleted."), $group->getName()));
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
            $this->view->setVariable("groups", $groups);
            $this->view->render("usergroup", "USERGROUP_SHOWALL_Vista");
        } else {
            $this->view->render("group", "GROUP_SEARCH_Vista");
        }
    }
    
    
    
    
    
}
