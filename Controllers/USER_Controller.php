<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../core/Upload.php");
require_once(__DIR__ . "/../Models/User.php");
require_once(__DIR__ . "/../Models/USER_Model.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");
require_once(__DIR__ . "/../Models/Friendship.php");
require_once(__DIR__ . "/../Models/FRIENDSHIP_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class USER_Controller extends BaseController
{
    private $userModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new USER_Model();
        $this->view->setLayout("base");
    }
    
    public function login()
    {
        if ($this->currentUser->getName()) {
            $this->view->redirect("publication", "showall", "id=" . $this->currentUser->getID());
        }
        
        if (isset($_POST["user"])) {
            if ($this->userModel->isValidUser($_POST["user"], $_POST["password"])) {
                $user                      = $this->userModel->show_by_username($_POST["user"]);
                $_SESSION["currentuser"]   = $user->getUser();
                $_SESSION["currentuserid"] = $user->getID();
                $this->view->redirect("publication", "showall", "id=" . $user->getID()."&type=user");
            } else {
                $errors            = array();
                $errors["general"] = i18n("User is not valid");
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setLayout("login");
        $this->view->render("user", "USER_LOGIN_Vista");
    }
    
    public function home()
    {
        $this->view->redirect("publication", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function showall()
    {
        $users = $this->userModel->showall();
        $this->view->setVariable("users", $users);
        $this->view->render("user", "USER_SHOWALL_ADMIN_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An user id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $user   = $this->userModel->showcurrent($userid);
        
        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ") . $userid);
        }
        
        $publicationModel = new PUBLICATION_Model();
        $publications     = $publicationModel->showall($userid, "user");
        
        
        $friendshipModel = new FRIENDSHIP_Model();
        $friends         = $friendshipModel->showall($userid);
        
        
        
        $this->view->setVariable("user", $user);
        
        $this->view->setVariable("publications", $publications);
        
        $this->view->setVariable("friends", $friends);
        
        $this->view->render("user", "USER_SHOWCURRENT_Vista");
    }
    
    
    public function add()
    {
        $user   = new User();
        $upload = new Upload();
        
        if (isset($_POST["submit"])) {
            if (isset($_POST["file"])) {
                if ($upload->checkFile()) {
                    $user->setPhoto($upload->getDestination());
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Error while upload image");
                    $this->view->setVariable("errors", $errors);
                }
            }
            
            $user->setUser($_POST["user"]);
            $user->setName($_POST["name"]);
            $user->setSurname($_POST["surname"]);
            $user->setEmail($_POST["email"]);
            $user->setPhone($_POST["phone"]);
            $user->setBirthday($_POST["birthday"]);
            $user->setaddress($_POST["address"]);
            $user->setType($_POST["type"]);
            if ($_POST["status"] == "up") {
                $user->setStatus(TRUE);
            } else {
                $user->setStatus(FALSE);
            }
            if ($_POST["private"] == "private") {
                $user->setPrivate(TRUE);
            } else {
                $user->setPrivate(FALSE);
            }
            $user->setPassword($_POST["password"]);
            try {
                if (!$this->userModel->userExists($_POST["user"]) && !empty($_POST["user"])) {
                    if (!$this->userModel->emailExists($_POST["email"]) && !empty($_POST["email"])) {
                        $user->checkIsValidForCreate();
                        $this->userModel->add($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully added."), $user->getUser()));
                        $this->view->redirect("user", "login");
                    } else {
                        $errors            = array();
                        $errors["general"] = i18n("email already exists");
                        $this->view->setVariable("errors", $errors);
                    }
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Username already exists");
                    $this->view->setVariable("errors", $errors);
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_ADD_Vista");
    }
    
    public function edit()
    {
        $upload = new Upload();
        
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An user id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        
        $user = $this->userModel->showcurrent($userid);
        
        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ") . $userid);
        }
        
        if (isset($_POST["submit"])) {
            if (isset($_POST["file"])) {
                if ($upload->checkFile()) {
                    $user->setPhoto($upload->getDestination());
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Error while upload image");
                    $this->view->setVariable("errors", $errors);
                }
            }
            
            $user->setName($_POST["name"]);
            $user->setSurname($_POST["surname"]);
            $user->setPhone($_POST["phone"]);
            $user->setBirthday($_POST["birthday"]);
            $user->setaddress($_POST["address"]);
            $user->setType($_POST["type"]);
            if ($_POST["status"] == "up") {
                $user->setStatus(TRUE);
            } else {
                $user->setStatus(FALSE);
            }
            if ($_POST["private"] == "private") {
                $user->setPrivate(TRUE);
            } else {
                $user->setPrivate(FALSE);
            }
            if ($_POST["password"]){
                $user->setPassword($_POST["password"]);
            }
            
            try {
                if ($user->getUser() == $_POST["user"] && $user->getEmail() == $_POST["email"]) {
                    $user->checkIsValidForCreate();
                    $this->userModel->edit($user);
                    $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."), $user->getUser()));
                    $this->view->redirect("user", "login");
                } else if ($user->getUser() == $_POST["user"] && $user->getEmail() != $_POST["email"]) {
                    if (!$this->userModel->emailExists($_POST["email"]) && !empty($_POST["email"])) {
                        $user->setEmail($_POST["email"]);
                        $user->checkIsValidForCreate();
                        $this->userModel->edit($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."), $user->getUser()));
                        $this->view->redirect("user", "login");
                    } else {
                        $errors            = array();
                        $errors["general"] = i18n("Email already exists or NULL");
                        $this->view->setVariable("errors", $errors);
                    }
                } else if ($user->getUser() != $_POST["user"] && $user->getEmail() == $_POST["email"]) {
                    if (!$this->userModel->userExists($_POST["user"]) && !empty($_POST["user"])) {
                        $user->setUser($_POST["user"]);
                        $user->checkIsValidForCreate();
                        $this->userModel->edit($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."), $user->getUser()));
                        $this->view->redirect("user", "login");
                    } else {
                        $errors            = array();
                        $errors["general"] = i18n("Username already exists or NULL");
                        $this->view->setVariable("errors", $errors);
                    }
                } else if (!$this->userModel->emailExists($_POST["email"]) && !empty($_POST["email"])) {
                    if (!$this->userModel->userExists($_POST["user"] && !empty($_POST["user"]))) {
                        $user->setEmail($_POST["email"]);
                        $user->setUser($_POST["user"]);
                        $user->checkIsValidForCreate();
                        $this->userModel->edit($user);
                        $this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."), $user->getUser()));
                        $this->view->redirect("user", "login");
                    } else {
                        $errors            = array();
                        $errors["general"] = i18n("Username already exists");
                        $this->view->setVariable("errors", $errors);
                    }
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Email already exists or NULL");
                    $this->view->setVariable("errors", $errors);
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_EDIT_Vista");
    }
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $user   = $this->userModel->showcurrent($userid);
        
        if ($user == NULL) {
            throw new Exception(i18n("No such user with id: ") . $userid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->userMapper->delete($user);
                $this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."), $user->getUsername()));
            }
            
            $this->view->redirect("user", "showall");
        }
        
        $this->view->setVariable("user", $user);
        $this->view->render("user", "USER_DELETE_Vista");
    }
    
    public function logout()
    {
        session_destroy();
        $this->view->redirect("user", "login");
    }
    
    public function register()
    {
        $user = new User();
        
        $user->setUser($_POST["user"]);
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        
        try {
            if (!$this->userModel->userExists($_POST["user"]) && !empty($_POST["user"])) {
                if (!$this->userModel->emailExists($_POST["email"]) && !empty($_POST["email"])) {
                    $user->checkIsValidForCreate();
                    $this->userModel->register($user);
                    $this->view->setFlash(sprintf(i18n("User \"%s\" successfully registered."), $user->getUser()));
                    $this->view->redirect("user", "login");
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("email already exists");
                    $this->view->setVariable("errors", $errors);
                }
            } else {
                $errors            = array();
                $errors["general"] = i18n("Username already exists");
                $this->view->setVariable("errors", $errors);
            }
        }
        catch (ValidationException $ex) {
            $errors = $ex->getErrors();
            $this->view->setVariable("errors", $errors);
        }
        
        $this->view->setVariable("user", $user);
        $this->view->redirect("user", "login");
    }
    
    public function admin()
    {
        $this->view->render("user", "USER_ADMIN_Vista");
    }

    public function searchselect()
    {
        $this->view->render("user", "USER_SEARCHSELECT_Vista");
    }
    
    public function search()
    {
        if (isset($_POST["submit"])) {
            $query = "";
            $flag  = 0;
            if ($_POST["user"]) {
                $query .= "user LIKE '%" . $_POST["user"] . "%'";
                $flag = 1;
            }
            if ($_POST["name"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "name LIKE '%" . $_POST["name"] . "%'";
                $flag = 1;
            }
            if ($_POST["surname"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "surname LIKE '%" . $_POST["surname"] . "%'";
                $flag = 1;
            }
            if ($_POST["email"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "email LIKE '%" . $_POST["email"] . "%'";
                $flag = 1;
            }
            if ($_POST["type"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "type LIKE '%" . $_POST["type"] . "%'";
                $flag = 1;
            }
            if ($_POST["status"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "status LIKE '%" . $_POST["status"] . "%'";
                $flag = 1;
            }
            if ($_POST["private"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "private LIKE '%" . $_POST["private"] . "%'";
            }
            
            if (empty($query)) {
                $users = $this->userModel->showall();
            } else {
                $users = $this->userModel->search($query);
            }
            $this->view->setVariable("users", $users);
            $this->view->render("user", "USER_SHOWALL_Vista");
        } else {
            $this->view->render("user", "USER_SEARCH_Vista");
        }
    }
}
