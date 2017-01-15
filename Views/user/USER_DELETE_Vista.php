<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$id = $_GET["id"];
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel">
			<div class="panel-body">
				<?php if ($user->getID() == $currentuserid): ?>
					<?php echo i18n("Are you sure you want to delete your account?"); ?>
				<?php else: ?>
					<?= i18n("Are you sure you want to delete") ?> @<?=$user->getUser() ?>?
				<?php endif ?>
			</div>
			<div class="panel-footer">
				<form action="index.php?controller=user&action=delete" method="post">
					<input type="text" name="id" value="<?= $user->getID() ?>" hidden>
					<a href="index.php?controller=user&action=login">
						<button type="button" class="btn btn-default">
							<?= i18n("No, go back") ?>
						</button>
					</a>    
					<button class="btn btn-danger pull-right" type="submit" name="submit" value="yes">
						<?= i18n("Yes, delete it") ?>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

	