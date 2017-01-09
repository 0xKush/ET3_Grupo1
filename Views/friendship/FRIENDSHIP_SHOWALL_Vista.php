<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$friends = $view->getVariable("friends");
$requests = $view->getVariable("requests");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="row">
 			<div class="container-fluid">
 				<?= i18n("Friendship Requests") ?>
 			</div>
 			<div class="row">
 				
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("Your Friends") ?></h1>
	 			</div>
 				
 			</div>
 		</div>

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
 						<div class="pull-right">
 							<a href="index.php?controller=friendship&action=delete&id=<?= $friend->getID() ?>"><button class="btn btn-danger"><?= i18n("Remove Friend") ?></button></a>
 						</div>
 				</div>

 			</div>
 		<?php endforeach ?>
 		
 		
 		
 	</div>