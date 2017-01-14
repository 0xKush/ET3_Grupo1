<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$publications = $view->getVariable("publications");
$documents = $view->getVariable("documents");


//publidoc -->array de k->v: [idpublicacion]->[iddocument]
$publidoc = $view->getVariable("publidoc");
?>

<?php 
	$umapper = new USER_Model();
 ?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
	<div class="row">
		<?php include(__DIR__.'/../../Views/publication/PUBLICATION_ADD_Vista.php'); ?>
	</div>

	<div class="row">
		
	</div>
</div>