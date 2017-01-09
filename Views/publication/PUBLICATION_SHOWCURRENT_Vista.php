<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$publication = $view->getVariable("publication");
$document = $view->getVariable("document");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		

 		<div class="well">
	 			<div class="row">
	 				<div class="container-fluid">
	 					<?= $publication->getDescription() ?>
	 				</div>
	 				<div class="container-fluid">
	 					<?= i18n("Author") ?>: <a href="index.php?controller=user&action=showcurrent&id=<?=$publication->getOwner() ?>"><?php $publication->getOwner();  ?></a>
	 				</div>
	 				<div class="container-fluid">
	 					<?= $publication->getCreationDate();?>
	 					<?= $publication->getHour()  ?>
	 				</div>
	 			</div>
 		</div>

		<div class="well">
 			<div class="row">
 				<div class="container-fluid">
 					<?= $document->getLocation() ?>
 				</div>
 				
 				<div class="container-fluid">
 					<?= $document->getUploadDate();?>
 				</div>
 			</div>
		</div>
 		
 		
 	</div>
 	