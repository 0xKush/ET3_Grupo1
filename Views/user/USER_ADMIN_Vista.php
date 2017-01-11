<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 text-center">
				<div class="panel">
					<div class="panel-body">
						<div class="row">
							<i class="fa fa-user big-icon"></i>
						</div>
						<div class="row" style="margin-top: 15px">
							<font class="pfname"><?= i18n("Users") ?></font>
						</div>

					</div>
					<div class="panel-footer">
						<a href="index.php?controller=user&action=showall">
							<button class="btn btn-block btn-primary">
								<i class="fa fa-cog"></i>
								<?= i18n("Manage") ?>
							</button>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4 text-center">
				<div class="panel">
					<div class="panel-body">
						<div class="row">
							<i class="fa fa-group big-icon"></i>
						</div>
						<div class="row" style="margin-top: 15px">
							<font class="pfname"><?= i18n("Groups") ?></font>
						</div>

					</div>
					<div class="panel-footer">
						<a href="index.php?controller=group&action=showall">
							<button class="btn btn-block btn-primary">
								<i class="fa fa-cog"></i>
								<?= i18n("Manage") ?>
							</button>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4 text-center">
				<div class="panel">
					<div class="panel-body">
						<div class="row">
							<i class="fa fa-calendar big-icon"></i>
						</div>
						<div class="row" style="margin-top: 15px">
							<font class="pfname"><?= i18n("Events") ?></font>
						</div>

					</div>
					<div class="panel-footer">
						<a href="index.php?controller=event&action=showall">
							<button class="btn btn-block btn-primary">
								<i class="fa fa-cog"></i>
								<?= i18n("Manage") ?>
							</button>
						</a>
					</div>
				</div>
			</div>
		
		</div>
	</div>


