<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Event.php");
require_once(__DIR__ . "/../Models/EVENT_Model.php");
require_once(__DIR__ . "/../Models/Guest.php");
require_once(__DIR__ . "/../Models/GUEST_Model.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class EVENT_Controller extends BaseController
{
    private $eventModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->eventModel = new EVENT_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        $events = $this->eventModel->showall();
        $this->view->setVariable("events", $events);
        $this->view->render("event", "EVENT_SHOWALL_ADMIN_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An event id is mandatory"));
        }
        
        $eventid = $_REQUEST["id"];
        $event   = $this->eventModel->showcurrent($eventid);
        
        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ") . $eventid);
        }
        
        $ismember = false;
        
        if ($this->permissions->isEventMember($this->currentUser->getID(), $eventid)) {
            $ismember = true;
        }
        
        $publicationModel = new PUBLICATION_Model();
        
        $publications = $publicationModel->showall($eventid, "event");
        
        
        $this->view->setVariable("event", $event);
        
        $this->view->setVariable("ismember", $ismember);
        
        $this->view->setVariable("publications", $publications);
        
        $this->view->render("event", "EVENT_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $event = new Event();
        
        if (isset($_POST["submit"])) {
            $event->setName($_POST["name"]);
            $event->setOwner($this->currentUser->getID());
            $event->setPrivate($_POST["private"]);
            $event->setStartDate($_POST["startdate"]);
            $event->setEndDate($_POST["enddate"]);
            $event->setStartHour($_POST["starthour"]);
            $event->setEndHour($_POST["endhour"]);
            $event->setDescription($_POST["description"]);
            $event->setStatus(1);
            
            try {
                if (!$this->eventModel->nameExists($_POST["name"])) {
                    $event->checkIsValidForCreate();
                    $this->eventModel->add($event);
                    $this->view->setFlash(sprintf(i18n("Event\"%s\" successfully added."), $event->getName()));
                    $this->view->redirect("event", "showall");
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("Event already exists");
                    $this->view->setVariable("errors", $errors);
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_ADD_Vista");
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An event id is mandatory"));
        }
        
        $eventid = $_REQUEST["id"];
        $event   = $this->eventModel->showcurrent($eventid);
        
        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ") . $eventid);
        }
        
        if (isset($_POST["submit"])) {
            $event->setName($_POST["name"]);
            $event->setOwner($this->currentUser->getID());
            $event->setPrivate($_POST["private"]);
            $event->setStartDate($_POST["startdate"]);
            $event->setEndDate($_POST["enddate"]);
            $event->setStartHour($_POST["starthour"]);
            $event->setEndHour($_POST["endhour"]);
            $event->setDescription($_POST["description"]);
            $event->setStatus($_POST["status"]);
            
            try {
                $event->checkIsValidForCreate();
                $this->eventModel->edit($event);
                $this->view->setFlash(sprintf(i18n("Event\"%s\" successfully updated."), $event->getName()));
                $this->view->redirect("event", "showall");
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_EDIT_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("An event id is mandatory"));
        }
        
        $eventid = $_REQUEST["id"];
        $event   = $this->eventModel->showcurrent($eventid);
        
        if ($event == NULL) {
            throw new Exception(i18n("No such event with id: ") . $eventid);
        }
        
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->eventModel->delete($event);
                $this->view->setFlash(sprintf(i18n("Event \"%s\" successfully deleted."), $event->getName()));
            }
            $this->view->redirect("event", "showall");
        }
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_DELETE_Vista");
    }
    
    public function search()
    {
        if (isset($_POST["submit"])) {
            $query = "";
            $flag  = 0;
            if ($_POST["creationdate"]) {
                $query .= "creationdate LIKE '%" . $_POST["creationdate"] . "%'";
                $flag = 1;
            }
            if ($_POST["owner"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "owner LIKE '%" . $_POST["owner"] . "%'";
                $flag = 1;
            }
            if ($_POST["startdate"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "startdate LIKE '%" . $_POST["startdate"] . "%'";
                $flag = 1;
            }
            if ($_POST["enddate"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "enddate LIKE '%" . $_POST["enddate"] . "%'";
                $flag = 1;
            }
            if ($_POST["starthour"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "starthour LIKE '%" . $_POST["starthour"] . "%'";
                $flag = 1;
            }
            if ($_POST["endhour"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "endhour LIKE '%" . $_POST["endhour"] . "%'";
                $flag = 1;
            }
            if ($_POST["description"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "description LIKE '%" . $_POST["description"] . "%'";
            }
            
            if ($_POST["status"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "status LIKE '%" . $_POST["status"] . "%'";
            }
            
            if ($_POST["name"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "name LIKE '%" . $_POST["name"] . "%'";
            }
            
            if ($_POST["private"]) {
                if ($flag) {
                    $query .= " AND ";
                }
                $query .= "private LIKE '%" . $_POST["private"] . "%' ";
            }
            
            if (empty($query)) {
                $events = $this->eventModel->showall();
            } else {
                $events = $this->eventModel->search($query);
            }
            
            $guestModel = new GUEST_Model();
            $guests     = $guestModel->getEvents($this->currentUser->getID());
            
            $this->view->setVariable("guests", $guests);
            $this->view->setVariable("events", $events);
            $this->view->render("event", "EVENT_SHOWALL_Vista");
        } else {
            $this->view->render("event", "EVENT_SEARCH_Vista");
        }
    }
    
    
}
