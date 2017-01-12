<?php
require_once(__DIR__ . "/../Models/User.php");
require_once(__DIR__ . "/../Models/USER_Model.php");
require_once(__DIR__ . "/../Models/Publication.php");
require_once(__DIR__ . "/../Models/PUBLICATION_Model.php");

class JSON_Controller
{
    private $publicationModel;
    
    public function __construct()
    {
	$this->publicationModel = new PUBLICATION_Model();
    }
    
    public function showall()
    {   
	$entityid = $_REQUEST["id"];   
	$publications = $this->publicationModel->showall($entityid, "user");
	$result = array();
	
        foreach($publications as $publication) {
	    $user = new USER_Model();
	    $autor = $user->showcurrent($publication->getOwner());
	    array_push($result, array(
		"id" => $publication->getID(),
		"autor" => $autor->getUser(),
		"publication" => $publication->getDescription()
	    ));
	}

	header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
	header('Content-Type: application/json');
	echo(json_encode($result));
	
    }
}
