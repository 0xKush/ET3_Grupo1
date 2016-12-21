<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Models/User.php");
require_once(__DIR__."/../Models/USER_Model.php");
require_once(__DIR__."/../Controllers/BaseController.php");

class USER_Controller extends BaseController {

    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new USER_Model();
        $this->view->setLayout("base");
    }

    public function login() {
        if (isset($_POST["user"])){
            if ($this->userMapper->isValidUser($_POST["user"], $_POST["password"])) {
                $user = $this->userModel->show_by_username($_POST["user"]);
                $_SESSION["currentuser"] = $user->getUser();
                $_SESSION["currentuserid"] = $user->getID();
                $_SESSION["currentusertype"] = $user->getType();
                $this->view->redirect("user", "login");
            }else{
                $errors = array();
                $errors["general"] = i18n("User is not valid");
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->render("user", "USER_LOGIN_Vista");
    }

    public function showall(){
        $users = $this->userModel->showall();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "USER_SHOWALL_Vista");
    }

    public function showcurrent(){
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An user id is mandatory"));
        }

        $userid = $_REQUEST["id"];
        $user = $this->userModel->showcurrent($userid);

        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ").$userid);
        }

        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_SHOWCURRENT_Vista");
    }

    public function logout() {
        session_destroy();
        $this->view->redirect("user", "login");
    }

}
