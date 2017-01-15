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
    private $userModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->guestModel = new GUEST_Model();
        $this->userModel = new USER_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];

        if ($this->currentUser->getID() != $userid){
            if (!$this->permissions->isAdmin($this->currentUser->getID()) &&
                !$this->permissions->isFriend($this->currentUser->getID(), $userid) &&
                !$this->permissions->isPublic($userid, "user")
            ){
                $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
                $this->view->redirect("user", "login");
            }
        }
        
        $events = $this->guestModel->showall($userid);
        $this->view->setVariable("events", $events);
        $requests = $this->guestModel->requests($userid);
        $this->view->setVariable("requests", $requests);
          $owners = array();
        foreach ($events as $guest) {
            $owners[$guest->getOwner()] = $this->userModel->showcurrent($guest->getOwner());
        }

        $requests = $this->guestModel->requests($userid);

        $this->view->setVariable("requests", $requests);

        $this->view->setVariable("owners", $owners);
        $this->view->render("guest", "GUEST_SHOWALL_Vista");
    }
    
    public function request()
    {
        $guest = new Guest();
        
        if (isset($_POST["submit"])) {
            $guest->setEvent($_POST["event"]);
            $guest->setMember($_POST["member"]);
            $guest->setStatus(0);
            
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

        if (!$this->permissions->isAdmin($this->currentUser->getID()) &&
            !$this->permissions->isOwner($this->currentUser->getID(), $eventid, "event") &&
            !$this->permissions->isEventMember($this->currentUser->getID(), $eventid) &&
            !$this->permissions->isPublic($eventid, "event")
        ){
            $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
            $this->view->redirect("user", "login");
        }
        
        $eventModel = new EVENT_Model();
        $event = $eventModel->showcurrent($eventid);

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
                $guest->setStatus(0);
            
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
        $guest   = $this->guestModel->showcurrent($this->currentUser->getID(), $guestid);
        
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