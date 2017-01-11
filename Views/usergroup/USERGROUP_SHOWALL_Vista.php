<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$groups = $view->getVariable("groups");

$umapper = new USER_Model();
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<!-- se user = currentuser mostrar edit perfil -->
	


	<div class="container-fluid">
		<div class="row">
			<?php foreach ($groups as $group): ?>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body">
							<div class="row text-center">
								<font class="pfname"><?=$group->getName() ?></font>
							</div>
							<div class="row text-center" style="padding-left: 5px: padding-right: 5px">
								<font class="user"><?=$group->getDescription() ?></font>
							</div>
							<div class="row" style="margin-top: 15px">
								<div class="col-md-4 text-center">

									<?php $owner = $umapper->showcurrent($group->getOwner())?>
									<a href="index.php?controller=user&action=showcurrent&id=<?=$owner->getID() ?>">
						 				<?php if ($owner->getPhoto() != NULL): ?>
						 					<img class="img-circle smallPhoto" src="media/profileImages/<?=$owner->getPhoto() ?>" alt="">
						 				<?php else: ?>
						 					<img class="img-circle smallPhoto" src="media/profileImages/default.png" alt="">
						 				<?php endif ?>
					 				</a>
					 				<font class="user">  @<?=$owner->getUser() ?></font>
								</div>
								<div class="col-md-4 text-center">
									<?php if ($owner->getID() == $currentuserid): ?>
						 				
							 				<a href="index.php?controller=group&action=delete&id=<?= $group->getID()  ?>">
							 					<button class="btn btn-danger"><?= i18n("Delete") ?></button>
							 				</a>
							 			
							 		<?php else: ?>
							 			
							 				<form action="index.php?controller=usergroup&action=delete" method="post">
							 					<button type="submit" name="id" value="<?=$group->getID() ?>"	 class="btn btn-warning"><?= i18n("Unsubscribe") ?></button>
							 				</form>
							 			
						 			<?php endif ?>
								</div>
								<div class="col-md-4 text-center">
									<a href="index.php?controller=group&action=showcurrent&id=<?=$group->getID() ?>">
										<button class="btn btn-info">
											<?= i18n("View") ?>
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
