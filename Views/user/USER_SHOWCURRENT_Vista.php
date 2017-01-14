<?php 
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$currentuserid = $view->getVariable("currentuserid");

	$user = $view->getVariable("user");
	$friends = $view->getVariable("friends");//friendship
	$publications = $view->getVariable("publications");
	$documents = $view->getVariable("documents");
	$isPrivate = $view->getVariable("isPrivate");



	$errors = $view->getVariable("errors");

?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">

	<div class="row">
	<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4 text-center">
					<?php if ($user->getPhoto() == NUll): ?>
						<img class="pfphoto img-circle" src="media/profileImages/default.png" alt="default">
					<?php else: ?>
						<img class="pfphoto img-circle" src="media/profileImages/<?=$user->getPhoto() ?>" alt="<?=$user->getPhoto() ?>">
					<?php endif ?>
					
				</div>
				<div class="col-md-8">
					<div class="row">
						<font class="pfname"><?=$user->getName() ?> <?=$user->getSurname() ?></font>
					</div>
					<div class="row">
						<font class="pfusername">@<?=$user->getUser() ?></font>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

<?php if (!($isPrivate && !$isFriend)): ?>


<div class="row">
	<div class="col-md-4">
	<div class="row" style="margin-bottom: 15px">
	<a href="index.php?controller=user&action=edit&id=<?= $currentuserid ?>">
		<button class="btn btn-block btn-warning">
			<?= i18n("Edit my profile") ?>
			<i class="fa fa-edit"></i>
		</button>
	</a>	
	</div>
	<div class="row">
		<div class="panel">
			<div class="panel-header" style="padding: 5px">
				<div class="text-center primary">
 					<i class="fa fa-drivers-license fa-fw"></i>
 					<label for=""><?=i18n("Contact information") ?></label>
				</div>
			</div>
			<div class="panel-body" >
				<div class="row" style="padding: 5px">
						<label for=""><?= i18n("Email") ?>:</label> <?=$user->getEmail() ?>
					</div>
					<div class="row" style="padding: 5px">
						<label for=""><?= i18n("Phone") ?>:</label> <?=$user->getPhone() ?>
					</div>
					<div class="row" style="padding: 5px">
						<label for=""><?= i18n("Adress") ?>:</label> <?=$user->getAddress() ?>
					</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 15px">
	<a href="index.php?controller=user&action=delete&id=<?= $currentuserid ?>">
		<button class="btn btn-block btn-danger">
			<i class="fa fa-warning"></i>
			<?= i18n("Delete my acconunt") ?>
			<i class="fa fa-warning"></i>
		</button>
	</a>	
	</div>
	<div class="row">
		<div class="panel">
			<div class="panel-body" >
				<i class="fa fa-users">
				</i> <?= i18n("Friends") ?>
			</div>
		</div>
	</div>

	<?php foreach ($friends as $friend): ?>
		<div class="row">
		<div class="panel">
			<div class="panel-body" >
				<div class="row text-center" style="padding: 5px">
					<?php if ($friend->getPhoto() == NULL): ?>
						<img class="smallPhoto img-circle" src="media/profileImages/default.png" alt="default">
					<?php else: ?>
						<img class="smallPhoto img-circle" src="media/profileImages/<?=$friend->getPhoto() ?>" alt="<?=$friend->getPhoto() ?>">
					<?php endif ?>
					<font class="name"><?= $friend->getName()." ".$friend->getSurname() ?></font><br>
					<font class="user">@<?=$friend->getUser() ?></font>
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
<?php else: ?>
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<?= i18n("This user's profile is private") ?>
			</div>
		</div>
	</div>		
	<?php endif ?>	
</div>