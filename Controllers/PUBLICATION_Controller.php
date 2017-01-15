<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");
require_once(__DIR__ . "/../Models/User.php");
require_once(__DIR__ . "/../Models/USER_Model.php");

require_once(__DIR__ . "/../Models/Document.php");
require_once(__DIR__ . "/../Models/DOCUMENT_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class PUBLICATION_Controller extends BaseController
{
    private $publicationModel;
    private $userModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->publicationModel = new PUBLICATION_Model();
        $this->userModel = new USER_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        /*  if (!isset($_REQUEST["type"])) {
        throw new Exception(i18n("Entity type is mandatory"));
        }*/
        
        $entityid = $_REQUEST["id"];
        /*  $type     = $_REQUEST["type"];*/
        
        $publications = $this->publicationModel->showall($entityid, "user");
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
        
        $user = $this->userModel->showcurrent($publication->getOwner());

        $this->view->setVariable("user", $user);
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_SHOWCURRENT_Vista");
    }
    
    
    public function add()
    {
        $publication = new Publication();
        
        $documentModel = new DOCUMENT_Model();
        $documents     = $documentModel->showall($this->currentUser->getID());
        
        if (isset($_POST["submit"])) {
            $publication->setDestination($_POST["destination"]);
            $publication->setType($_POST["type"]);
            $publication->setOwner($this->currentUser->getID());
            $publication->setCreationDate(date("Y-m-d"));
            $publication->setHour(date('H:i:s'));
            $publication->setDescription($_POST["description"]);
            $publication->setStatus(1);
            
            try {
                $publication->checkIsValidForCreate();
                $this->publicationModel->add($publication);
                $this->view->setFlash(sprintf(i18n("Publication\"%s\" successfully added.")));
                $this->view->redirect($_REQUEST["type"], "showcurrent", "id=" . $_REQUEST["destination"]);
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        $this->view->setVariable("type", $_REQUEST["type"]);
        $this->view->setVariable("destination", $_REQUEST["destination"]);
        $this->view->setVariable("docs", $documents);
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_ADD_Vista");
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
            $this->view->redirect("user", "login");
        }
        $this->view->setVariable("publication", $publication);
        $this->view->render("publication", "PUBLICATION_DELETE_Vista");
    }
    
    
    
    
    
}
