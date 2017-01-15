<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$publicationid = $view->getVariable("publicationid");

?>

<div class="panel">
	<div class="panel-heading">
		<h1><?= i18n("New Comment") ?></h1>
	</div>
	<div class="panel-body" style="padding: 20px">
		<form action="index.php?controller=comment&action=add" method="post">

		<div class="form-group">
		<input type="text" hidden name="publication" value="<?=$publicationid ?>">

			<div class="row">
					<label for="imp"><?= i18n("Content") ?>:</label>
					<input class="form-control" rows="4" parsley-data-validate required id="imp" type="textarea" name="content">
				<button class="btn btn-success" type="submit" name="submit" pull-right>
				<?= i18n("Submit") ?>
			</button>
			</div>
		</div>
			
		</form>
	</div>
</div>