<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$event = $view->getVariable("event");

$isAdmin = $view->getVariable("isadmin");
$isOwner = $view->getVariable("isowner");
$isEventMember = $view->getVariable("iseventmember");
$isPrivate = $view->getVariable("isprivate");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
	<div class="row">
		<div class="pull-right">
			<?php if($isAdmin || $isOwner): ?>
				<div>
					<form action="index.php?controller=event&action=delete" method="post">
						<input type="text" name="id" value="<?= $event->getID() ?>" hidden>
						<button class="btn btn-danger" name="delete">
							<?= i18n("Delete") ?>
							<i class="fa fa-trash"></i>
						</button>
					</form>
				</div>
			<?php endif ?>
			
			<?php if ($isEventMember): ?>
				<div>
					<form action="index.php?controller=guest&action=delete" method="post">
						<input type="text" name="id" value="<?= $event->getID() ?>" hidden>
						<button class="btn btn-warning" name="delete">
							<?= i18n("Unsubscribe") ?>
							<i class="fa fa-trash"></i>
						</button>
					</form>
				</div> 
			<?php elseif(!$isPrivate): ?>
				<div>
					<form action="index.php?controller=guest&action=add" method="post">
						<input type="text" name="id" value="<?= $event->getID() ?>" hidden>
						<button class="btn btn-warning" name="delete">
							<?= i18n("Join") ?>
							<i class="fa fa-trash"></i>
						</button>
					</form>
				</div>
			<?php else: ?>
			 <div>
					<form action="index.php?controller=guest&action=add" method="post">
						<input type="text" name="id" value="<?= $event->getID() ?>" hidden>
						<button class="btn btn-warning" name="delete">
							<?= i18n("Ask to join") ?>
							<i class="fa fa-hand-rock-o"></i>
						</button>
					</form>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>