<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Group.php");
require_once(__DIR__ . "/../Models/GROUP_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

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
        
        $this->view->setVariable("group", $group);
        $this->view->render("group", "GROUP_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $group = new Group();
        
        if (isset($_POST["submit"])) {
            $group->setName($_POST["groupname"]);
            $group->setDescription($_POST["description"]);
            $group->setOwner($_POST["owner"]);
            $group->setType($_POST["type"]);
            $group->setCreationDate($_POST["creationdate"]);
            $group->setStatus($_POST["status"]);
            
            try {
                if (!$this->groupModel->nameExists($_POST["groupname"])) {
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
            $group->setName($_POST["groupname"]);
            $group->setDescription($_POST["description"]);
            $group->setOwner($_POST["owner"]);
            $group->setType($_POST["type"]);
            $group->setCreationDate($_POST["creationdate"]);
            $group->setStatus($_POST["status"]);
            
            try {
                if (!$this->groupModel->nameExists($_POST["groupname"])) {
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
            $this->view->redirect("group", "show");
        }
        $this->view->setVariable("group", $group);
        $this->view->render("group", "GROUP_DELETE_Vista");
    }
    
    
    
    
    
}
