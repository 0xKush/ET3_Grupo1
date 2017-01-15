<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$conversations = $view->getVariable("conversations");
$currentuserid = $view->getVariable("currentuserid");

$umapper = new USER_Model();
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>


 	<div class="container-fluid">
 		<div class="row" style="padding-left: 15px; padding-right: 15px">
 			<div class="panel">
 				<div class="panel-body">
 						<div class="text-center">
			 				<font class="title"><?= i18n("Chats") ?></font>
			 			</div>
 				</div>
 			</div>
 			
 		</div>
 		<?php foreach ($conversations as $c): ?>
 			<div class="col-md-6">
	 				<div class="panel">
	 					<div class="panel-body">
	 						 <div class="row">
	 						 		<div class=" text-center">
									<?= i18n("With") ?>:
									<?php if ($umapper->showcurrent($c->getMember())->getID() == $currentuserid): ?>
										<?php $owner = $umapper->showcurrent($c->getSecondaryMember())?>
									<?php else: ?>
										<?php $owner = $umapper->showcurrent($c->getMember())?>
									<?php endif ?>

									
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
	 					<div class="row" style="padding-left: 10px; padding-right: 10px;">
	 						<div class="pull-left">
	 							<form action="index.php?controller=conversation&action=delete" method="POST">
	 								<input type="text" name="id" value="<?=$c->getID()  ?>" hidden="hidden">
	 								<button class="btn btn-danger" type="submit" name="delete">
	 									<i class="fa fa-trash-o"></i>
	 									<?= i18n("Delete") ?>
	 								</button>
	 							</form>
	 						</div>
	 						<div class="pull-right">
	 							<form action="index.php?controller=conversation&action=showcurrent&id=<?=$c->getID()  ?>" method="POST">
	 								<input type="text" name="id" value="<?=$c->getID()  ?>" hidden="hidden">
	 								<button class="btn btn-default" type="submit" name="delete">
	 									<?= i18n("View") ?>
	 									<i class="fa fa-angle-double-right"></i>
	 								</button>
	 							</form>
	 						</div>
	 					</div>
	 						
	 					</div>
	 				</div>
 			</div>			
 		<?php endforeach ?>
 	</div>
