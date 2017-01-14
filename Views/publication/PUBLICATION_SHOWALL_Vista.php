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
	<div class="row" style="margin-bottom: 10px"> 
			<div class="pull-right">
				<form action="index.php?controller=publication&action=add" method="post">
					<input type="text" name="type" value="user" hidden="">
					<input type="text" name="destination" value="<?=$currentuserid ?>" hidden>

					<button class="btn btn-success"><?= i18n("Create publication") ?></button>
				</form>
			</div>
	</div>

	<div class="row">
		<?php foreach ($publications as $publication): ?>
			<div class="panel">
				<div class="panel-heading">
					
				</div>
				<div class="panel-body">
					<?= $publication->getDescription() ?>
				</div>
				<div class="panel-footer">
				<div class="row">
					
				
					<div class="col-xs-4 pull-left">
						
					</div>
					<div class="col-xs-4">
						
					</div>
					<div class="col-xs-4 pull-right">
						<a href="index.php?controller=publication&action=showcurrent&id=<?=$publication->getID() ?>">
							<button class="btn btn-primary">
								<?= i18n("View") ?>
								<i class="fa fa-eye"></i>
							</button>
						</a>
					</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

