<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$groups = $view->getVariable("groups");

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
	 				<h1 class="heading"><?= i18n("Your Groups") ?></h1>
	 			</div>
 				
 			</div>
 		</div>
		
		<?php foreach ($groups as $group): ?>
				<div class="well">
		 			<div class="row">
		 				<a href="index.php?controller=group&action=showcurrent&id=<?= $group->getID()  ?>"><?= $group->getName()?></a>
		 			</div>
		 			<div class="">
		 				<a href="index.php?controller=user&action=showcurrent&id=<?= $group->getOwner()  ?>">
		 				<?php $owner = $umapper->showcurrent($group->getOwner())?>
		 				<?php if ($owner->getPhoto() != NULL): ?>
		 					<img class="smallPhoto" src="media/profileImages/<?=$owner->getPhoto() ?>" alt="">
		 				<?php else: ?>
		 					<img class="smallPhoto" src="media/profileImages/default.png" alt="">
		 				<?php endif ?>
		 				<?= $owner->getUser(); ?></a>
		 			</div>
		 			<div class="row">
		 				<?= $group->getDescription() ?>
		 			</div>
		 			<div class="row">
		 			<?php if ($owner->getID() == $currentuserid): ?>
		 				<div class="pull-right">
			 				<a href="index.php?controller=group&action=delete&id=<?= $group->getID()  ?>">
			 					<button class="btn btn-danger"><?= i18n("Delete") ?></button>
			 				</a>
			 			</div>
			 		<?php else: ?>
			 			<div class="pull-right">
			 				<a href="index.php?controller=usergroup&action=delete&id=<?= $group->getID()  ?>">
			 					<button class="btn btn-warning"><?= i18n("Unsubscribe") ?></button>
			 				</a>
			 			</div>
		 			<?php endif ?>
		 			
		 				
		 			
		 				<div class="pull-right">
			 				<a href="index.php?controller=group&action=showcurrent&id=<?= $group->getID()  ?>">
			 					<button class="btn btn-primary"><?= i18n("View") ?></button>
			 				</a>
			 			</div>
		 			</div>
			 			
		 		</div>
		<?php endforeach ?>
 		
 		
 		
 	</div>