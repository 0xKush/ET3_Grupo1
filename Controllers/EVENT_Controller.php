<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Event.php");
require_once(__DIR__ . "/../Models/EVENT_Model.php");
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
        $this->view->render("event", "EVENT_SHOWALL_Vista");
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
        
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $event = new Event();
        
        if (isset($_POST["submit"])) {
            $event->setCreationDate($_POST["creationdate"]);
            $event->setOwner($_POST["owner"]);
            $event->setStartDate($_POST["startdate"]);
            $event->setEndDate($_POST["enddate"]);
            $event->setStartHour($_POST["starthour"]);
            $event->setEndHour($_POST["endhour"]);
            $event->setDescription($_POST["description"]);
            $event->setStatus($_POST["status"]);
            $event->setName($_POST["name"]);
            $event->setType($_POST["type"]);
            
            
            try {
                if (!$this->eventModel->nameExists($_POST["name"])) {
                    $event->checkIsValidForCreate();
                    $this->eventModel->add($event);
                    $this->view->setFlash(sprintf(i18n("Event\"%s\" successfully added."), $event->getName()));
                    $this->view->redirect("event", "show");
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
            $event->setCreationDate($_POST["creationdate"]);
            $event->setOwner($_POST["owner"]);
            $event->setStartDate($_POST["startdate"]);
            $event->setEndDate($_POST["enddate"]);
            $event->setStartHour($_POST["starthour"]);
            $event->setEndHour($_POST["endhour"]);
            $event->setDescription($_POST["description"]);
            $event->setStatus($_POST["status"]);
            $event->setName($_POST["name"]);
            $event->setType($_POST["type"]);
            
            try {
                if (!$this->eventModel->nameExists($_POST["name"])) {
                    $event->checkIsValidForCreate();
                    $this->eventModel->edit($event);
                    $this->view->setFlash(sprintf(i18n("Event\"%s\" successfully updated."), $event->getName()));
                    $this->view->redirect("event", "show");
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
            $this->view->redirect("event", "show");
        }
        $this->view->setVariable("event", $event);
        $this->view->render("event", "EVENT_DELETE_Vista");
    }
    
    
}
