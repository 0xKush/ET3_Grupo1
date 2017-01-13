<?php 
	
	require_once(__DIR__."/../../core/ViewManager.php");
	require_once(__DIR__."/../../Models/EVENT_Model.php");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");
	$guest = $view->getVariable("guest");

	$emapper = new EVENT_Model();
	$event = $emapper->showcurrent($guest->getEvent());
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


	<div class="container">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<form action="index.php?controller=guest&action=delete&id=<?=$guest->getID() ?>" method="post">
			<div class="well">
				<div class="row">
					<?= i18n("Unsubscribe from event ") ?><?= $event->getName()?>?
				</div>
				<div class="row">
					<div class="pull-right">
					<button type="button" class="btn btn-default"><?= i18n("No, go back") ?></button>                                                             
                    <button type="submit" name="submit" value="yes" class="btn btn-danger"><?= i18n("Yes, delete it ") ?></button>

				</div>
				</div>
				
			</div>
		</form>
		</div>
	</div>

