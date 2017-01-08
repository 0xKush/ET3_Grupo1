<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$id = $_GET["id"];
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>

	<div class="container">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<form action="index.php?controller=user&action=delete&id=<?=$id ?>">
			<div class="well">
				<div class="row">
					<?= i18n("Delete User: ") ?><?= $user->getUser()?>
				</div>
				<div class="row">
					<div class="pull-right">
					<a href="index.php?controller=user&action=showall">
					<button type="button" class="btn btn-default"><?= i18n("No, go back") ?></button></a>                                                              
                    <button type="submit" name="submit" value="yes" class="btn btn-danger"><?= i18n("Yes, delete it ") ?></button>

				</div>
				</div>
				
			</div>
		</form>
		</div>
	</div>

