<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
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

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("Your Wall") ?></h1>
	 			</div>
 				
 			</div>
 		</div>

 		<?php foreach ($publications as $publication): ?>
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
	 			</div>

	 			<?php if (isset($publidoc[$publication->getID()])): ?>
	 				<div class="row">
	 					<div class="container-fluid">
	 						<?= $publidoc[$publication->getID()]->getLocation() ?>
	 					</div>
	 				</div>
	 			<?php endif ?>

	 			<div class="row">
	 				<div class="pull-right ">
	 					<a href="index.php?controller=publication&action=showcurrent&id=<?=$publication->getID() ?>"><button class="btn btn-primary"><?= i18n("View") ?></button></a>
	 				</div>
	 			</div>
 			</div>
 		<?php endforeach ?>

 		
 		
 		
 	</div>
 	