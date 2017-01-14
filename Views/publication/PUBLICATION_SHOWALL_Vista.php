<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");

$publications = $view->getVariable("publications");

$documents = $view->getVariable("documents");

$publidoc = $view->getVariable("publidoc");

$owners = $view->getVariable("owners");
?>


<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
	<div class="row"> 
			<div class="pull-right">
				<form action="index.php?controller=publication&action=add" method="post">
					<input type="text" name="type" value="user" hidden="">
					<input type="text" name="destination" value="<?=$currentuserid ?>" hidden>

					<button class="btn btn-success"><?= i18n("Create publication") ?></button>
				</form>
			</div>
	</div>

	<div class="row">
		
	</div>
</div>

