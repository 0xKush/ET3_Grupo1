<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>




 	<div class="col-md-8 col-md-offset-2">
 		<div class="well">
 		<div class="row">
 			<a href="index.php?controller=user&action=showall"><button class="btn btn-primary"><?= i18n("Users") ?></button></a>
 		</div>
 		</div>

 		<div class="well">
 		<div class="row">
				<a href="index.php?controller=group&action=showall"><button class="btn btn-primary"><?= i18n("Groups") ?></button></a>
 		</div>
 		</div>

 		<div class="well">
 		<div class="row">
		<a href="index.php?controller=event&action=showall"><button class="btn btn-primary"><?= i18n("Events") ?></button></a>
 		</div>
 		</div>
 		
 	</div>
 	