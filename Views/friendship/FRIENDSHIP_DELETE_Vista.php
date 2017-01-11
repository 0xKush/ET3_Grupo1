<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$friendship = $view->getVariable("friendship");
$friend = $view->getVariable("friend");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<div class="container-fluid">
 		<div class="row">
 			<?php foreach ($friends as $friend): ?>
 				<div class="col-md-3">
 					<div class="panel">
 						<div class="panel-body">
 							<div class="row text-center">
 								<a href="index.php?controller=user&action=showcurrent&id=<?= $friend->getID()?>">
 									<?php if ($friend->getPhoto() != NULL): ?>
 										<img class="img-circle showPhoto"> src="media/profileImages/<?=$friend->getPhoto()  ?>" alt="<?=$friend->getPhoto()  ?>">
 									<?php else: ?>
 										<img class="img-circle showPhoto" src="media/profileImages/default.png" alt="default.png">
 									<?php endif ?>
 								</a>
 							</div>

 							<div class="row text-center">
 								<div class="row name">
 									<font><?=$friend->getName() ?> <?=$friend->getSurname() ?></font>
 								</div>
 								<div class="row user">
 									<font>@<?=$friend->getUser()  ?></font>
 								</div>
 							</div>

							<div class="row text-center" style="margin-top: 5px">
								<form action="index.php?controller=friendship&action=delete" method="post">
									<input type="text" hidden="hidden" name="id" value="<?=$friend->getID() ?>">
									<button class="btn btn-danger" type="submit" name="yes">
										<i class="fa fa-trash-o fa-fw"></i>
										<?= i18n("Yes, unfriend") ?>
									</button>
								</form>
							</div>
 						</div>
 					</div>
 				</div>
 			<?php endforeach ?>
 		</div>
 	</div>