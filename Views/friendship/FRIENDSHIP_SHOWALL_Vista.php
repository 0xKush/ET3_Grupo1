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

<?php print_r($errors) ?>


 	<div class="container-fluid">
 		<div class="row">
				<div class="pull-right" style="padding: 10px">
					<a href="index.php?controller=group&action=add">
						<button class="btn btn-success">
							<?= i18n("Create new group") ?>
							<i class="fa fa-plus"></i>
						</button>
					</a>
				</div>
		</div>
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
 										<img class="img-circle showPhoto" src="media/profileImages/<?=$friend->getPhoto()  ?>" alt="<?=$friend->getPhoto()  ?>">
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