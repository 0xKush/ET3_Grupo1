<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../Services/Permissions.php");
require_once(__DIR__."/../Models/User.php");

class BaseController {

    protected $view;  
    protected $currentUser;
  
    public function __construct() {
        $this->view = ViewManager::getInstance();
        $this->permissions = new Permissions();
   
        if (session_status() == PHP_SESSION_NONE) {      
            session_start();
        }

        $this->currentUser = new User();
        
        if(isset($_SESSION["currentuser"])) {      
            $this->currentUser->setName($_SESSION["currentuser"]);
            $this->view->setVariable("currentusername", $this->currentUser->getName());  
        }

        if(isset($_SESSION["currentuserid"])) {      
            $this->currentUser->setID($_SESSION["currentuserid"]);
            $this->view->setVariable("currentuserid", $this->currentUser->getID());
        }
    }
}