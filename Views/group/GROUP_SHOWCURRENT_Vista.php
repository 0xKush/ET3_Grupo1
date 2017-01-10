<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$publications = $view->getVariable("publications");
$errors = $view->getVariable("errors");
$group = $view->getVariable("group");
$isMember = $view->getVariable("ismember");
//necesito salgo co que saber se currentuser pertence ó grupo en cuestión
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="row">
 			<div class="col-md-12">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("Group Profile") ?></h1>
	 			</div>
	 			<?php if ($currentuserid == $group->getOwner()): ?>
	 				<div class="row">
	 					<div class="pull-right">
	 					<form action="index.php?controller=usergroup&action=invite" method="post">
	 						<button type="submit" class="btn  btn-success"><?= i18n("Invite Friends") ?></button>
	 					</form>
 					</div>
	 				</div>
	 				
	 			<?php endif ?>
 				
 			</div>
 		</div>

 		<div class="well">
 			<div class="row">
 				<?php print_r($group)?>
 				<?php  ?>
 			</div>
 			<div class="row">
 				<?php if ($group->getOwner() == $currentuserid): ?>
		 				<div class="pull-right">
			 				<a href="index.php?controller=group&action=delete&id=<?= $group->getID()  ?>">
			 					<button class="btn btn-danger"><?= i18n("Delete") ?></button>
			 				</a>
			 			</div>
			 	<?php elseif($isMember): ?>
			 			<div class="pull-right">
			 				<form action="index.php?controller=usergroup&action=delete" method="post">
			 					<button type="submit" name="id" value="<?=$group->getID() ?>"	 class="btn btn-warning"><?= i18n("Unsubscribe") ?></button>
			 				</form>
			 			</div>
			 	
		 		<?php endif ?>
 			</div>
 		</div>
		<div id="alert">NECESITO getVariable("publications")</div>
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

	 			<div class="row">
	 				<div class="pull-right ">
						<?php if ($publication->getOwner() == $currentuserid): ?>
			 			
		 						<a href="index.php?controller=publication&action=delete&id=<?= $publication->getID()  ?>"><button class="btn btn-danger"><?= i18n("Delete") ?></button></a>
		 					
			 			<?php endif ?>
	 					<a href="index.php?controller=publication&action=showcurrent&id=<?=$publication->getID() ?>"><button class="btn btn-primary"><?= i18n("View") ?></button></a>
	 				</div>
	 			</div>
 			</div>
 		<?php endforeach ?>
 		
 		
 	</div>