<?php
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$users = $view->getVariable("users");
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");
?>
<?= isset($errors["general"])?$errors["general"]:"" ?>
<?php $view->moveToDefaultFragment(); ?>
<?php print_r($errors) ?>

<div class="container-fluid">
	
	<div class="col-md-8 col-md-offset-2" >
		<div class="well">
			<div class="container-fluid">
				<div class="row">
					<h1><?= i18n("Add Document")?> </h1>
				</div>
				<div class="row">

					<form action="index.php?controller=document&action=add" enctype="multipart/form-data" method="post">
						<div class="form-group">

							<label for="file"><?= i18n("File") ?></label>
							
							<input type="file" name="file" class="form-control-file" id="file">
						</div>
						<button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>