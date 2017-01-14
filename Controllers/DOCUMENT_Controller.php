<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../core/Upload.php");
require_once(__DIR__ . "/../Models/Document.php");
require_once(__DIR__ . "/../Models/DOCUMENT_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class DOCUMENT_Controller extends BaseController
{
    private $documentModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->documentModel = new DOCUMENT_Model();
        $this->view->setLayout("base");
    }
    
    public function showall()
    {
        $documents = $this->documentModel->showall($this->currentUser->getID());
        $isAdmin   = $this->permissions->isAdmin($this->currentUser->getID());
        $this->view->setVariable("documents", $documents);
        $this->view->setVariable("isAdmin", $isAdmin);
        $this->view->render("document", "DOCUMENT_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A document id is mandatory"));
        }
        
        $documentid = $_REQUEST["id"];
        $document   = $this->documentModel->showcurrent($documentid);
        
        if ($document == NULL) {
            throw new Exception(i18n("No such document with id: ") . $documentid);
        }
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $document = new Document();
        $upload   = new Upload();
        
        if (isset($_POST["submit"])) {
            try {
                if ($upload->checkFile()) {
                    $document->setOwner($this->currentUser->getID());
                    $document->setLocation($upload->getDestination());
                    $document->setUploadDate(date("Y-m-d"));
                    $document->setStatus(1);
                    
                    $this->documentModel->add($document);
                    $this->view->setFlash(sprintf(i18n("Document\"%s\" successfully added.")));
                    $this->view->redirect("document", "showall");
                } else {
                    $errors            = array();
                    $errors["general"] = i18n("An error has occurred during upload");
                    $this->view->setVariable("errors", $errors);
                }
                
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            
        }
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_ADD_Vista");
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $documentid = $_REQUEST["id"];
        $document   = $this->documentModel->showcurrent($documentid);
        
        if ($document == NULL) {
            throw new Exception(i18n("No such document with id: ") . $documentid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->documentModel->delete($document);
                $this->view->setFlash(sprintf(i18n("Document \"%s\" successfully deleted.")));
            }
            $this->view->redirect("document", "showall");
        }
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_DELETE_Vista");
    }
    
}
