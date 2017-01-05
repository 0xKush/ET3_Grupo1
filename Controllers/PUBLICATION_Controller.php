<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class PUBLICATION_Controller extends BaseController
{
    private $publicationModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->publicationModel = new PUBLICATION_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        $publications = $this->publicationModel->showall();
        $this->view->setVariable("publications", $publications);
        $this->view->render("publication", "PUBLICATION_SHOWALL_Vista");
    }
    
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A publication id is mandatory"));
        }
        
        $publicationid = $_REQUEST["id"];
        $publication   = $this->publicationModel->showcurrent($publicationid);
        
        if ($publication == NULL) {
            throw new Exception(i18n("No such publication with id: ") . $publicationid);
        }
        
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_SHOWCURRENT_Vista");
    }
    
    
    public function add()
    {
        $publication = new Publication();
        
        if (isset($_POST["submit"])) {
            $publication->setDestination($_POST["destination"]);
            $publication->setType($_POST["type"]);
            $publication->setOwner($_POST["owner"]);
            $publication->setCreationDate($_POST["creationdate"]);
            $publication->setHour($_POST["hour"]);
            $publication->setDescription($_POST["description"]);
            $publication->setStatus($_POST["status"]);
            
            try {
                $publication->checkIsValidForCreate();
                $this->publicationModel->add($publication);
                $this->view->setFlash(sprintf(i18n("Publication\"%s\" successfully added.")));
                $this->view->redirect("publication", "show");
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_ADD_Vista");
    }
    
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A publication id is mandatory"));
        }
        
        $publicationid = $_REQUEST["id"];
        $publication   = $this->publicationModel->showcurrent($publicationid);
        
        if ($publication == NULL) {
            throw new Exception(i18n("No such publication with id: ") . $publicationid);
        }
        
        if (isset($_POST["submit"])) {
            $publication->setDestination($_POST["destination"]);
            $publication->setType($_POST["type"]);
            $publication->setOwner($_POST["owner"]);
            $publication->setCreationDate($_POST["creationdate"]);
            $publication->setHour($_POST["hour"]);
            $publication->setDescription($_POST["description"]);
            $publication->setStatus($_POST["status"]);
            
            try {
                $publication->checkIsValidForCreate();
                $this->publicationModel->edit($publication);
                $this->view->setFlash(sprintf(i18n("Publication \"%s\" successfully updated.")));
                $this->view->redirect("publication", "show");
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_EDIT_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $publicationid = $_REQUEST["id"];
        $publication   = $this->publicationModel->showcurrent($publicationid);
        
        if ($publication == NULL) {
            throw new Exception(i18n("No such publication with id: ") . $publicationid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->publicationModel->delete($publication);
                $this->view->setFlash(sprintf(i18n("Publication \"%s\" successfully deleted.")));
            }
            $this->view->redirect("publication", "show");
        }
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_DELETE_Vista");
    }
    
    
    
    
    
}