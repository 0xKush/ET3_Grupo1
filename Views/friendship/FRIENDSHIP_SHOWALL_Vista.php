<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
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
	 				<h1 class="heading"><?= i18n("Your Friends") ?></h1>
	 			</div>
 				
 			</div>
 		</div>

 		<?php foreach ($friends as $friend): ?>
 			<div class="well">
 				<div class="row">
 						<div class="container-fluid">
 							<img class="profileThumbnail" src="<?= $friend->getPhoto()?>" alt=""><?= $friend->getName() ?><?= $friend->getSurname() ?>
 							<br>
 							<?= $friend->getUsername() ?>
 						</div>
 				</div>

 			</div>
 		<?php endforeach ?>
 		
 		
 		
 	</div>