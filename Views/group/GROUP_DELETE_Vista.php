<?php 
$view = ViewManager::getInstance();
$id = $_GET["id"];
$user = $view->getVariable("group");

 ?>

	<div class="container">
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<form action="index.php?controller=group&action=delete&id=<?=$id ?>">
			<div class="well">
				<div class="row">
					<?= i18n("Delete Group: ") ?><?= $group->getName()?>
				</div>
				<div class="row">
					<div class="pull-right">
					<a href="index.php?controller=group&action=showall">
					<button type="button" class="btn btn-default"><?= i18n("No, go back") ?></button></a>                                                              
                    <button type="submit" value="yes" class="btn btn-danger"><?= i18n("Yes, delete it ") ?></button>

				</div>
				</div>
				
			</div>
		</form>
		</div>
	</div>

