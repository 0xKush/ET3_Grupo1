<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$members = $view->getVariable("members");
$publications = $view->getVariable("publications");
$errors = $view->getVariable("errors");
$group = $view->getVariable("group");
$isOwner = $view->getVariable("isOwner");
$isMember = $view->getVariable("ismember");
require_once(__DIR__."/../../Models/USER_Model.php");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>

<div class="container-fluid">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
			<div class="col-xs-8">
				<h1><?=$group->getName() ?></h1>
			</div>
			<div class="col-xs-4">
				<div class="row pull-right">
					<?php if ($currentuserid == $group->getOwner()): ?>
						<a href="index.php?controller=group&action=delete&id=<?=$group->getID() ?>">
							<button class="btn btn-danger">
								<i class="fa fa-trash"></i>
								<?= i18n("Delete") ?>
							</button>
						</a>
					<?php elseif($isMember): ?>
						<form action="index.php?controller=usergroup&action=delete" method="post">
							<input type="text" name="id" value="<?=$group->getID() ?>" hidden>
							<button type="submit" class="btn btn-warning">
								<i class="fa fa-leave"></i>
								<?= i18n("Unsubscribe") ?>
							</button>
						</form>
					<?php else: ?>
						<form action="index.php?controller=usergroup&action=join" method="post">
							<input type="text" name="groupid" value="<?=$group->getID() ?>" hidden>
							<input type="text" name="member" value="<?=$currentuserid ?>" hidden>
							<button class="btn btn-success" name="submit" value="yes">
								<i class="fa fa-"></i>
								<?=i18n("Join")  ?>
							</button>
						</form>
					<?php endif ?>
				</div>
			</div>
				
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
		<?php if ($isOwner || $isMember): ?>
			<div class="row" style="margin-bottom: 10px">
		<form action="index.php?controller=usergroup&action=invite" method="post">
		<input type="text" name="id" hidden value="<?= $group->getID() ?>">
			<button class="btn btn-block btn-success" type="submit">
				<?=i18n("Invite") ?> 
				<i class="fa fa-plus"></i>
			</button>
			</form>
		</div>
		<?php endif ?>

		<?php if ($members == NULL): ?>
			<div class="panel">
				<div class="panel-body">
					<div class="text-center">
						<font class=""><?= i18n("No members yet") ?></font>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php foreach ($members as $member): ?>
		<div class="row">
		<div class="panel">
			<div class="panel-body" >
				<div class="row text-center" style="padding: 5px">
					<?php if ($member->getPhoto() == NULL): ?>
						<img class="smallPhoto img-circle" src="media/profileImages/default.png" alt="default">
					<?php else: ?>
						<img class="smallPhoto img-circle" src="media/profileImages/<?=$member->getPhoto() ?>" alt="<?=$member->getPhoto() ?>">
					<?php endif ?>
					<font class="name"><?= $member->getName()." ".$member->getSurname() ?></font><br>
					<font class="user">@<?=$member->getUser() ?></font>
				</div>
			</div>
			<div class="panel-footer">
			<div class="row">
				<a href="index.php?controller=user&action=showcurrent&id=<?=$friend->getID()  ?>">
					<button class="btn btn-default pull-right">
					<i class="fa fa-angle-double-right"></i>
						<?= i18n("View") ?>	
					</button>
				</a>
			</div>
				
			</div>
		</div>
	</div>
	<?php endforeach ?>
<?php endif ?>
		</div>
		<div class="col-md-8">
			<?php if ($publications == NULL): ?>
			<div class="panel">
				<div class="panel-body">
					<div class="text-center">
						<font class=""><?= i18n("No publication here") ?></font>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php foreach ($publications as $publication): ?>
							<div class="panel">
								<div class="panel-body">
									<font class="user">
										<?=$publication->getDescription() ?>
									</font>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6 pull-left">
											
										</div>
										<div class="col-md-6">
											<a href="index.php?controller=publication&action=showcurrent&id=<?=$publication->getID() ?>">
												<button class="btn btn-default pull-right">
													<?= i18n("View")  ?>
													<i class="fa fa-angle-double-right"></i>
												</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>			
		<?php endif ?>
		</div>
	</div>
	
</div>
