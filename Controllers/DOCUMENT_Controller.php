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
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A user id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        
        if ($this->currentUser->getID() != $userid) {
            if (!$this->permissions->isAdmin($this->currentUser->getID()) && !$this->permissions->isFriend($this->currentUser->getID(), $userid) && !$this->permissions->isPublic($userid, "user")) {
                $this->view->setFlash(sprintf(i18n("You have no permissions here.")));
                $this->view->redirect("user", "login");
            }
        }
        
        
        
        $documents = $this->documentModel->showall($userid);
        $isAdmin   = $this->permissions->isAdmin($this->currentUser->getID());
        
        $this->view->setVariable("documents", $documents);
        $this->view->setVariable("isAdmin", $isAdmin);
        $this->view->setVariable("userid", $userid);
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
            if ($_FILES["file"]["size"] == 0) {
                $this->view->setFlash(sprintf(i18n("File is requerid.")));
                $this->view->redirect("document", "add");
            }
            try {
                if ($upload->checkFile()) {
                    $document->setOwner($this->currentUser->getID());
                    $document->setLocation($upload->getDestination());
                    $document->setUploadDate(date("Y-m-d"));
                    $document->setStatus(1);
                    
                    $this->documentModel->add($document);
                    $this->view->setFlash(sprintf(i18n("Document\"%s\" successfully added.")));
                    $this->view->redirect("document", "showall", "id=" . $this->currentUser->getID());
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
            $this->view->redirect("document", "showall", "id=" . $this->currentUser->getID());
        }
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_DELETE_Vista");
    }
    
}
