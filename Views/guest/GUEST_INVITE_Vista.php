<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$friends = $view->getVariable("friends");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("invite Friends") ?> <?= i18n("to group") ?>: <?=$group->getName() ?></h1>
	 			</div>
 				
 			</div>
 		</div>
		<form action="index.php?controller=usergroup&action=invite" method="post">
 		<?php foreach ($friends as $friend): ?>
 			<div class="well">
 				<div class="row">
 						<div class="container-fluid">
 						<a href="index.php?controller=user&action=showcurrent&id=<?=$friend->getID() ?>">
 						<?php if ($friend->getPhoto() != NULL): ?>
 							<img class="smallPhoto" src="<?= $friend->getPhoto()?>" alt="">
 						<?php else:  ?>
 							<img class="smallPhoto" src="media/profileImages/default.png" alt="">
 						<?php endif ?></a>

 							<?= $friend->getName() ?><?= $friend->getSurname() ?>
 							<br>
 							<?= $friend->getUser() ?>
 						</div>
 						<div class="row">							
 								<div class="form-group">
 									<span><input class="form-control" type="checkbox" name="invites[]" value="<?=$friend->getID()  ?>"><?= i18n("Invite?") ?></span>
 								</div>		
 						</div>
 				</div>

 			</div>
 				<div class="pull-right">
 					<button type="submint" name="submit"><?= i18n("Send Invites!") ?></button>
 				</div>
 			</form>
 		<?php endforeach ?>
 		
 		
 		
 	</div>