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
	<div class="col-md-10 col-md-offset-1">
		
	
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
				<?php $owner = $owners[$publication->getOwner()] ?>
					<font class="name">
						<?= $owner->getName()." ".$owner->getSurname() ?>
					</font>  <a href="index.php?controller=user&action=showcurrent&id=<?= $owner->getID() ?>"><font class="user">@<?=$owner->getUser()  ?></font></a>
				</div>
				<div class="panel-body">
					<font class="user"><?= $publication->getDescription() ?></font>
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
</div>

