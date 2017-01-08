<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Guest.php");
require_once(__DIR__ . "/../Models/GUEST_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class GUEST_Controller extends BaseController
{
    private $guestModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->guestModel = new GUEST_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $events = $this->guestModel->showall($userid);
        $this->view->setVariable("events", $events);
        $this->view->render("guest", "GUEST_SHOWALL_Vista");
    }
    
    public function requests()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $events = $this->guestModel->showall($userid, 0);
        $this->view->setVariable("events", $events);
        $this->view->render("guest", "GUEST_SHOWALL_Vista");
    }
    
    public function add()
    {
        $guest = new Guest();
        
        if (isset($_POST["submit"])) {
            $guest->setEvent($_POST["event"]);
            $guest->setMember($_POST["member"]);
            $guest->setSecondaryMember($_POST["secondarymember"]);
            
            try {
                if (!$this->guestModel->guestExists($_POST["event"], $_POST["member"], $_POST["secondarymember"]) && !empty($_POST["event"]) && !empty($_POST["member"]) && !empty($_POST["secondarymember"])) {
                    $this->guestModel->insert($guest);
                    $this->view->setFlash(sprintf(i18n("Guest successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("Guest already exists.")));
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->redirect("guest", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $guestid = $_REQUEST["id"];
        $guest   = $this->guestModel->showcurrent($guestid);
        
        if ($guest == NULL) {
            throw new Exception(i18n("No such guest with id: ") . $guestid);
        }
        
        
        if (isset($_POST["submit"])) {
            $guest->setStatus(1);
        }
        
        $this->view->redirect("guest", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $guestid = $_REQUEST["id"];
        $guest   = $this->guestModel->showcurrent($guestid);
        
        if ($guest == NULL) {
            throw new Exception(i18n("No such guest with id: ") . $guestid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->guestModel->delete($guest);
                $this->view->setFlash(sprintf(i18n("Guest successfully deleted.")));
            }
            
            $this->view->redirect("guest", "showall", "id=" . $this->currentUser->getID());
        }
        
        $this->view->setVariable("guest", $guest);
        $this->view->render("guest", "GUEST_DELETE_Vista");
    }
}