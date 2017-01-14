<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$users = $view->getVariable("users");
$friends = $view->getVariable("friends");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<div class="container-fluid">
 		<div class="row">
 		<?php if ($users == NULL): ?>
 			<div class="panel">
 				<div class="panel-body">
 					 <h1 class="text-center">
 					 	<?= i18n("No entries to show") ?>
 					 </h1>
 				</div>
 			</div>
 		<?php endif ?>
 			<?php foreach ($users as $user): ?>
 				<div class="col-md-3">
 					<div class="panel">
 						<div class="panel-body">
 							<div class="row text-center">
 								<a href="index.php?controller=user&action=showcurrent&id=<?= $user->getID()?>">
 									<?php if ($user->getPhoto() != NULL): ?>
 										<img class="img-circle showPhoto" src="media/profileImages/<?=$user->getPhoto()  ?>" alt="<?=$user->getPhoto()  ?>">
 									<?php else: ?>
 										<img class="img-circle showPhoto" src="media/profileImages/default.png" alt="default.png">
 									<?php endif ?>
 								</a>
 							</div>

 							<div class="row text-center">
 								<div class="row name">
 									<font class="name"><?=$user->getName() ?> <?=$user->getSurname() ?></font>
 								</div>
 								<div class="row user">
 									<font>@<?=$user->getUser()  ?></font>
 								</div>
 							</div>

							
 						</div>
 						<div class="panel-footer">
 						
 							<form action="index.php?controller=user&action=showcurrent" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$user->getID() ?>">
									<button class="btn btn-primary btn-block" type="submit"  >
										<?= i18n("View") ?>
										<i class="fa fa-eye fa-fw"></i>
									</button>
								</form>
							<?php if ($friends != NULL): ?>
								<?php if (in_array($user->getID(), $friends)): ?>
									<form action="index.php?controller=friendship&action=delete" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$user->getID() ?>">
									<button class="btn btn-danger btn-block" type="submit"  >
										<?= i18n("Unfriend") ?>
										<i class="fa fa-trash-o fa-fw"></i>
									</button>
									</form>
								<?php else: ?>
									<form action="index.php?controller=friendship&action=add" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$user->getID() ?>">
									<button class="btn btn-success btn-block" type="submit"  >
										<?= i18n("Add") ?>
										<i class="fa fa-plus fa-fw"></i>
									</button>
									</form>
								<?php endif ?>
							<?php endif ?>
								
 						</div>
 					</div>
 				</div>
 			<?php endforeach ?>
 		</div>
 	</div>