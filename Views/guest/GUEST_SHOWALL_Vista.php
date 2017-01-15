<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$events = $view->getVariable("events");
$owners = $view->getVariable("owners");
$requests = $view->getVariable("requests");

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

		<?php if ($requests != NULL): ?>
			<div class="panel">
				<div class="panel-heading">
					<h1><?=i18n("Event invites") ?></h1>
				</div>
				<div class="panel-body" style="background: #cbd8ed">
					
			
			<?php foreach ($requests as $request): ?>
				<?php if (true): ?>
					<div class="col-md-6">
					<div class="panel">
						<div class="panel-body">
							<div class="row text-center">
								<font class="pfname"><?=$request->getName() ?></font>
							</div>
							<div class="row text-center" style="padding-left: 5px: padding-right: 5px">
								<font class="user"><?=$request->getDescription() ?></font>
							</div>
							
						</div>
						<div class="panel-footer">
							<div class="row"> 
							
								<div class="col-md-9">
					 				<a href="index.php?controller=guest&action=delete&id=<?= $request->getID()  ?>">
					 					<button class="btn btn-danger btn-md"><?= i18n("Decline") ?></button>
					 				</a>		 			

									<form action="index.php?controller=guest&action=edit" method="post">
					 					<input type="text" value="<?=$request->getID() ?>" name="id" hidden>
					 					<button type="submit" name="submit" 	 class="btn btn-warning" btn-md><?= i18n("Accept") ?>
					 						
					 					</button>
					 				</form>						 			
					 				</div>
					 								 			
								<div class="col-md-3">
									<a href="index.php?controller=event&action=showcurrent&id=<?=$request->getID() ?>">
										<button class="btn btn-info btn-md pull-right">
											<?= i18n("View") ?>
										</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>
				
			<?php endforeach ?>
				</div>
			</div>
		<?php endif ?>


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
							<div class="row" style="margin-top: 15px">
								<div class=" text-center">

									<?php $owner = $owners[$event->getOwner()]?>
									<a href="index.php?controller=user&action=showcurrent&id=<?=$owner->getID() ?>">
						 				<?php if ($owner->getPhoto() != NULL): ?>
						 					<img class="img-circle smallPhoto" src="<?=$owner->getPhoto() ?>" alt="">
						 				<?php else: ?>
						 					<img class="img-circle smallPhoto" src="media/profileImages/default.png" alt="">
						 				<?php endif ?>
					 				</a>
					 				<font class="user">  @<?=$owner->getUser() ?></font>
								</div>
								
							</div>
						</div>
						<div class="panel-footer">
							<div class="row"> 
							
							<?php if ($owner->getID() == $currentuserid): ?>
								<div class="col-md-9">
					 				<a href="index.php?controller=event&action=delete&id=<?= $event->getID()  ?>">
					 					<button class="btn btn-danger btn-md"><i class="fa fa-trash-o"></i> <?= i18n("Delete") ?></button>
					 				</a>
					 				<a href="index.php?controller=event&action=edit&id=<?=$event->getID() ?>">
							<button class="btn btn-warning">
								<i class="fa fa-edit"></i>
								<?= i18n("Edit") ?>
							</button>
						</a>
					 			</div>				 			
					 		<?php else: ?>
					 			<div class="col-md-9">
									<form action="index.php?controller=guest&action=delete" method="post">
					 					<button type="submit" name="id" value="<?=$event->getID() ?>"	 class="btn btn-warning" btn-md><?= i18n("Unsubscribe") ?></button>
					 				</form>						 			</div>
					 								 			
				 			<?php endif ?>
								<div class="col-md-3">
									<a href="index.php?controller=event&action=showcurrent&id=<?=$event->getID() ?>">
										<button class="btn btn-info btn-md pull-right">
											<?= i18n("View") ?>
											<i class="fa fa-angle-double-right"></i>
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
