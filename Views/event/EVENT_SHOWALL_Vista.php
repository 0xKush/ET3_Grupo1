<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$events = $view->getVariable("events");
$guests = $view->getVariable("guests");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>


	<div class="container-fluid">
		<div class="row">
				<div class="pull-right" style="padding: 10px">
					<a href="index.php?controller=event&action=add">
						<button class="btn btn-success">
							<?= i18n("Create new event") ?>
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div>
		</div>
		<div class="row">
		<?php if ($events == NULL): ?>
			<div class="panel">
				<div class="panel-body">
					<h1><?= i18n("No entries to show") ?></h1>
				</div>
			</div>
		<?php endif ?>
			<?php foreach ($events as $event): ?>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body">
							<div class="row text-center">
								<font class="pfname"><?=$event->getName() ?></font>
							</div>
							<div class="row text-center" style="padding-left: 5px: padding-right: 5px">
								<font class="user"><?=$event->getDescription() ?></font>
							</div>
						
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6">
									<?php if ($event->getOwner() == $currentuserid): ?>
						 				<div class="col-md-6">
							 				<a href="index.php?controller=event&action=delete&id=<?= $event->getID()  ?>">
							 					<button class="btn btn-danger"><?= i18n("Delete") ?></button>
							 				</a>
							 			</div>
							 		<?php elseif(in_array($event->getID(), $guests)): ?>
							 			<div class="col-md-6">
							 				<form action="index.php?controller=guest&action=delete" method="post">
							 					<button type="submit" name="id" value="<?=$event->getID() ?>"	 class="btn btn-warning"><?= i18n("Unsubscribe") ?></button>
							 				</form>
							 			</div>
						 			<?php endif ?>
								</div>
								<div class="col-md-6">
									<a href="index.php?controller=event&action=showcurrent&id=<?=$event->getID() ?>">
										<button class="btn btn-info pull-right">
											<?= i18n("View") ?>
										</button>
									</a>
								</div>
						</div>
							</div>
							
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
