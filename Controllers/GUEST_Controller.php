<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Guest.php");
require_once(__DIR__ . "/../Models/GUEST_Model.php");
require_once(__DIR__ . "/../Models/Event.php");
require_once(__DIR__ . "/../Models/EVENT_Model.php");
require_once(__DIR__ . "/../Models/User.php");
require_once(__DIR__ . "/../Models/USER_Model.php");
require_once(__DIR__ . "/../Models/Friendship.php");
require_once(__DIR__ . "/../Models/FRIENDSHIP_Model.php");
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
        $requests = $this->guestModel->showall($userid, 0);
        $this->view->setVariable("requests", $requests);
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
                    $this->guestModel->add($guest);
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

    public function invite()
    {

        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $eventid = $_REQUEST["id"];
        $eventModel = new EVENT_Model();
        $event = $eventModel->showcurrent($groupid);

        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ") . $eventid);
        }
        
        if (isset($_POST["submit"])) {
            $invites = $_POST["invites"];

            foreach ($invites as $invite){
                $guest = new Guest();
                $guest->setEvent($eventid);
                $guest->setMember($this->currentUser->getID());
                $guest->setSecondaryMember($invite);
            
                try {
                    if (!$this->guestModel->guestExists($guest->getEvent(), $guest->getMember(), $guest->getSecondaryMember())) {
                        $this->guestModel->add($guest);
                    }
                }
                catch (ValidationException $ex) {
                    $errors = $ex->getErrors();
                    $this->view->setVariable("errors", $errors);
                }
            }
            $this->view->setFlash(sprintf(i18n("Invitations successfully sent.")));
            $this->view->redirect("guest", "showall", "id=" . $this->currentUser->getID());
        }
        
        if ($this->permissions->isAdmin($this->currentUser->getID())){
            $userModel = new USER_Model();
            $friends = $userModel->showall();
        } else {
            $friendshipModel = new FRIENDSHIP_Model();
            $friends = $friendshipModel->showall($this->currentUser->getID());
        }

        $this->view->setVariable("friends", $friends);
        $this->view->setVariable("event", $event);
        $this->view->render("guest", "GUEST_INVITE_Vista");
    }

    public function join()
    {
        $guest = new Guest();
        
        if (isset($_POST["submit"])) {
            $guest->setEvent($_POST["event"]);
            $guest->setMember($_POST["member"]);
            $guest->setStatus(1);
            
            try {
                if (!$this->guestModel->guestExists($_POST["event"], $_POST["member"], NULL) && !empty($_POST["event"]) && !empty($_POST["member"])) {
                    $this->guestModel->add($guest);
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
            $this->guestModel->edit($guest);
        }
        
        $this->view->redirect("guest", "showall", "id=" . $this->currentUser->getID());
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
        
        $guestid = $_REQUEST["id"];
        $guest   = $this->guestModel->showcurrent($usertodelete, $guestid);
        
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