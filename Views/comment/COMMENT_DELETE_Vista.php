<?php

	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$currentuserid = $view->getVariable("currentuserid");
	$errors = $view->getVariable("errors");
	$comment = $view->getVariable("comment");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>



	<div class="container">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<form action="index.php?controller=comment&action=delete&id=<?=$comment->getID()?>" method="post">
			<div class="well">
				<div class="row">
					<?= i18n("Delete Comment ") ?>
				</div>
				<div class="row">
					<div class="pull-right">
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

