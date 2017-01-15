<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$publication = $view->getVariable("publication");

$comments = $view->getVariable("comments");

$owner = $view->getVariable("user");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
		<div class="panel">
				<div  class="panel-heading">
					<font size="3" class="name">
						<?= $owner->getName()." ".$owner->getSurname() ?>
					</font >  <a href="index.php?controller=user&action=showcurrent&id=<?= $owner->getID() ?>"><font size="3" class="user">@<?=$owner->getUser()  ?></font></a>
				</div>
				<div class="panel-body">
					<font size="4" class="user"><?= $publication->getDescription() ?></font>
				</div>
				<div class="panel-footer">
				<div class="row text-center">
					
				
					<div class=" pull-left" style="margin-left: 15px"> 
						<?php if ($publication->getOwner() == $currentuserid): ?>
							<a href="index.php?controller=publication&action=delete&id=<?=$publication->getID() ?>">
							<button class="btn btn-danger">
								<?= i18n("Delete") ?>
								<i class="fa fa-trash-o"></i>
							</button>
							</a>
						<?php endif ?>
					</div>
						
					
					<div class=" pull-right" style="margin-right: 15px">
					<a href="index.php?controller=comment&action=add&id=<?=$publication->getDestination() ?>">
							<button class="btn btn-success">
								<?= i18n("Comment") ?>
								<i class="fa fa-comment"></i>
							</button>
						</a>
						<a href="index.php?controller=<?=$publication->getType() ?>&action=showcurrent&id=<?=$publication->getDestination() ?>">
							<button class="btn btn-primary">
								<?= i18n("View in site posted") ?>
								<i class="fa fa-eye"></i>
							</button>
						</a>
					</div>
					</div>
				</div>
			</div>

	<div class="row">
		<?php foreach ($comments as $comment): ?>
			<div class="panel">
				<div class="panel-body">
					<font size="4" class="user"><?= $publication->getDescription() ?></font>
				</div>
				<div class="panel-footer">
				<div class="row">
					
				
					<div class=" pull-left" style="margin-left: 15px"> 
						<?php if ($publication->getOwner() == $currentuserid): ?>
							<a href="index.php?controller=publication&action=delete&id=<?=$publication->getID() ?>">
							<button class="btn btn-danger">
								<?= i18n("Delete") ?>
								<i class="fa fa-trash-o"></i>
							</button>
							</a>
						<?php endif ?>
					</div>
					
					<div class=" pull-right" style="margin-right: 15px">
						<a href="index.php?controller=<?=$publication->getType() ?>&action=showcurrent&id=<?=$publication->getDestination() ?>">
							<button class="btn btn-primary">
								<?= i18n("View in site posted") ?>
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

