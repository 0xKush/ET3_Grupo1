<?php

	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");
	$id = $_GET["id"];
	$event = $view->getVariable("event");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


	<div class="container">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<form action="index.php?controller=event&action=delete&id=<?=$event->getID()?>" method="post">
			<div class="well">
				<div class="row">
					<?= i18n("Delete Event: ") ?><?= $event->getName()?>
				</div>
				<div class="row">
					<a href="index.php?controller=user&action=login">
						<button type="button" class="btn btn-default">
							<?= i18n("No, go back") ?>
						</button>
					</a>                                                                  
                    <button type="submit" name="submit" value="yes" class="btn btn-danger"><?= i18n("Yes, delete it ") ?></button>

				</div>
				</div>
				
			</div>
		</form>
		</div>
	</div>

