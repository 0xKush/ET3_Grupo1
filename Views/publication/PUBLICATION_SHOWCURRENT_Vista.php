<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$publication = $view->getVariable("publication");
$document = $view->getVariable("document");

$umapper = new USER_Model();
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
	 					<?= i18n("Author") ?>: <a href="index.php?controller=user&action=showcurrent&id=<?=$publication->getOwner() ?>"><?php $owner = $umapper->showcurrent($publication->getOwner()); echo $owner->getUser();  ?></a>
	 				</div>
	 				<div class="container-fluid">
	 					<?= $publication->getCreationDate();?>
	 					<?= $publication->getHour()  ?>
	 				</div>
	 				<?php if ($publication->getOwner() == $currentuserid): ?>
	 				<div class="pull-right">
 						<a href="index.php?controller=publication&action=delete&id=<?= $publication->getID()  ?>"><button class="btn btn-danger"><?= i18n("Delete") ?></button></a>
 					</div>
	 			<?php endif ?>
	 			</div>
 		</div>

		<div class="well">
 			<div class="row">
	 			
 				
 				<div class="container-fluid">
 				<?php if (isset($document) && ($document != NULL)): ?>
 					<?= $document->getLocation() ?>
 					<div class="container-fluid">
 					<?= $document->getUploadDate();?>
 					</div>
 				<?php else: ?>
 					<?= i18n("This publication has no documents") ?>
 				<?php endif ?>
 					
 				</div>
 				
 				
 			</div>
		</div>
 		
 		
 	</div>
 	