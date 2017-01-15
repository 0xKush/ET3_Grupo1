<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$friends = $view->getVariable("friends");
$requests = $view->getVariable("requests");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>



 	<div class="container-fluid">
 			<?php if ($requests != NULL): ?>
			<div class="panel">
				<div class="panel-heading">
					<h1><?=i18n("Friendship Requests") ?></h1>
				</div>
				<div class="panel-body" style="background: #cbd8ed">
					
			
			<?php foreach ($requests as $request): ?>
				<?php if (true): ?>
					<div class="col-md-6">
					<div class="panel">
						<div class="panel-body">
							<div class="row text-center">
								<font class="pfname"><?=$request->getName()." ".$request->getSurname() ?></font>
							</div>
							<div class="row text-center" style="padding-left: 5px: padding-right: 5px">
								<font class="user">@<?=$request->getUser() ?></font>
							</div>
							
						</div>
						<div class="panel-footer">
							<div class="row"> 
							
								<div class="col-md-6">
					 				<a href="index.php?controller=friendship&action=delete&id=<?= $request->getID()  ?>">
					 					<button class="btn btn-danger btn-md"><?= i18n("Decline") ?></button>
					 				</a>		 			

									<form action="index.php?controller=friendship&action=edit" method="post">
					 					<input type="text" value="<?=$request->getID() ?>" name="id" hidden>
					 					<button type="submit" name="submit" 	 class="btn btn-warning" btn-md><?= i18n("Accept") ?>
					 						
					 					</button>
					 				</form>						 			
					 				</div>
					 								 			
								<div class="col-md-6">
									<a href="index.php?controller=user&action=showcurrent&id=<?=$request->getID() ?>">
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
 		<?php if ($friends == NULL): ?>
 			<div class="panel">
 				<div class="panel-body">
 					 <h1 class="text-center">
 					 	<?= i18n("No entries to show") ?>
 					 </h1>
 				</div>
 			</div>
 		<?php endif ?>
 			<?php foreach ($friends as $friend): ?>
 				<div class="col-md-3">
 					<div class="panel">
 						<div class="panel-body">
 							<div class="row text-center">
 								<a href="index.php?controller=user&action=showcurrent&id=<?= $friend->getID()?>">
 									<?php if ($friend->getPhoto() != NULL): ?>
 										<img class="img-circle showPhoto" src="<?=$friend->getPhoto()  ?>" alt="<?=$friend->getPhoto()  ?>">
 									<?php else: ?>
 										<img class="img-circle showPhoto" src="media/profileImages/default.png" alt="default.png">
 									<?php endif ?>
 								</a>
 							</div>

 							<div class="row text-center">
 								<div class="row name">
 									<font class="name"><?=$friend->getName() ?> <?=$friend->getSurname() ?></font>
 								</div>
 								<div class="row user">
 									<font>@<?=$friend->getUser()  ?></font>
 								</div>
 							</div>

							
 						</div>
 						<div class="panel-footer">
 						
 							<form action="index.php?controller=friendship&action=delete" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$friend->getID() ?>">
									<button class="btn btn-danger btn-block" type="submit"  >
										<i class="fa fa-trash-o fa-fw"></i>
										<?= i18n("Unfriend") ?>
									</button>
								</form>

							<form action="index.php?controller=conversation&action=add" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$friend->getID() ?>">
									<button style="margin-top: 5px" class="btn btn-default btn-block" type="submit"  >
										<i class="fa fa-envelope fa-fw"></i>
										<?= i18n("Message") ?>
									</button>
								</form>	
 						</div>
 					</div>
 				</div>
 			<?php endforeach ?>
 		</div>
 	</div>