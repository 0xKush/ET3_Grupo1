<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$friendship = $view->getVariable("friendship");

$umodel = new USER_Model();
$friend = $umodel->showcurrent($friendship->getSecondaryMember());
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<div class="container-fluid">
 		<div class="row">
 			<div class="panel">
 				<div class="panel-body">
 					<div class="row text-center">
 						<?= i18n("Are you sure you wanna unfriend") ?> <?=$friend->getName() ?>(
 						<font class="user">@<?=$friend->getUser() ?></font> )?
 					</div>
 					<div class="pull-right">
 						<form action="index.php?controller=friendship&action=delete" method="post">
 							<input hidden="hidden" type="text" name="id" value="<?=$friendship->getID()?>">
 							<button class="btn btn-default" type="submit" value="no" name="submit">
 								<?= i18n("No") ?>
 							</button>
 							<button class="btn btn-danger" value="yes" type="submit" name="submit">
 								<?= i18n("Yes") ?>
 							</button>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>