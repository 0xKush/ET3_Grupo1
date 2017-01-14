<?php 
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$group = $view->getVariable("group");
	$errors = $view->getVariable("errors");
	$id = $_GET["id"];
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>


<div class="container-fluid">
	<div class="panel">

		<div class="panel-body">
			<form action="index.php?controller=group&action=delete&id=<?=$id ?>" method="post">
	<div class="row">

			<h1><?= i18n("Delete Group: ") ?><?= $group->getName()?></h1>

	</div>
				<div class="row">
					<div class="pull-right">

					<button type="submit" name="submit" value="no" class="btn btn-default"><?= i18n("No, go back") ?></button>                                                      
                    <button type="submit" name="submit" value="yes" class="btn btn-danger"><?= i18n("Yes, delete it ") ?></button>

				</div>
				
			</div>
		</form>
		</div>
	</div>
</div>


