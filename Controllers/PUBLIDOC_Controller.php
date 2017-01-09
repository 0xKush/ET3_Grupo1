<?php
require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../core/I18n.php");
require_once(__DIR__ . "/../Models/PubliDoc.php");
require_once(__DIR__ . "/../Models/PUBLIDOC_Model.php");
require_once(__DIR__ . "/../Controllers/BaseController.php");

class PUBLIDOC_Controller extends BaseController
{
    private $publidocModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->publidocModel = new PUBLIDOC_Model();
        $this->view->setLayout("base");
    }
    
    
    public function showall()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $userid = $_REQUEST["id"];
        $docs   = $this->publidocModel->showall($userid);
        $this->view->setVariable("docs", $docs);
        $this->view->render("publidoc", "PUBLIDOC_SHOWALL_Vista");
    }
    
    public function showcurrent()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("A publidoc id is mandatory"));
        }
        
        $documentid = $_REQUEST["id"];
        $document   = $this->documentModel->showcurrent($documentid);
        
        if ($document == NULL) {
            throw new Exception(i18n("No such publidoc with id: ") . $documentid);
        }
        
        $this->view->setVariable("document", $document);
        $this->view->render("document", "DOCUMENT_SHOWCURRENT_Vista");
    }
    
    public function add()
    {
        $publidoc = new PubliDoc();
        
        if (isset($_POST["submit"])) {
            $publidoc->setDocument($_POST["document"]);
            $publidoc->setPublication($_POST["publication"]);
            
            try {
                if (!$this->publidocModel->publidocExists($_POST["document"], $_POST["publication"]) && !empty($_POST["document"]) && !empty($_POST["publication"])) {
                    $this->publidocModel->add($publidoc);
                    $this->view->setFlash(sprintf(i18n("PubliDoc successfully added.")));
                } else {
                    $this->view->setFlash(sprintf(i18n("PubliDoc already exists.")));
                }
            }
            catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        $this->view->redirect("publidoc", "showall", "id=" . $this->currentUser->getID());
    }
    
    public function edit()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $publidocid = $_REQUEST["id"];
        $publidoc   = $this->publidocModel->showcurrent($publidocid);
        
        if ($publidoc == NULL) {
            throw new Exception(i18n("No such publidoc with id: ") . $publidocid);
        }
        
        if (isset($_POST["submit"])) {
            $publidoc->setDocument($_POST["document"]);
            $publidoc->setPublication($_POST["publication"]);
            $this->publidocModel->edit($publidoc);
        }
        
        $this->view->redirect("publidoc", "showall", "id=" . $this->currentUser->getID());
    }
    
    
    public function delete()
    {
        if (!isset($_REQUEST["id"])) {
            throw new Exception(i18n("Id is mandatory"));
        }
        
        $publidocid = $_REQUEST["id"];
        $publidoc   = $this->publidocModel->showcurrent($publidocid);
        
        if ($publidoc == NULL) {
            throw new Exception(i18n("No such publidoc with id: ") . $publidocid);
        }
        
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "yes") {
                $this->publidocModel->delete($publidoc);
                $this->view->setFlash(sprintf(i18n("PubliDoc successfully deleted.")));
            }
            
            $this->view->redirect("publidoc", "showall", "id=" . $this->currentUser->getID());
        }
        
        $this->view->setVariable("publidoc", $publidoc);
        $this->view->render("publidoc", "PUBLIDOC_DELETE_Vista");
    }
}