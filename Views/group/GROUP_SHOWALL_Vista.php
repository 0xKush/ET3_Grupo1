<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$usergroups = $view->getVariable("usergroups");
$groups = $view->getVariable("groups");


?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>




 	<!-- se user = currentuser mostrar edit perfil -->
	


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
			<?php if ($groups == NULL): ?>
				<div class="panel">
					<div class="panel-body">
						<h1><?= i18n("No entries to show") ?></h1>
					</div>
				</div>
			<?php endif ?>
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
							
						</div>
						<div class="panel-footer">
							<div class="row"> 
							<div class="col-md-6">
							<?php if ($group->getOwner() == $currentuserid): ?>
								
					 				<a href="index.php?controller=group&action=delete&id=<?= $group->getID()  ?>">
					 					<button class="btn btn-danger btn-md"><?= i18n("Delete") ?></button>
					 				</a>
					 			
					 		<?php elseif(in_array($group->getID(), $usergroups)): ?>	
					 				
									<form action="index.php?controller=usergroup&action=delete" method="post">
					 					<button type="submit" name="id" value="<?=$group->getID() ?>"	 class="btn btn-warning" btn-md><?= i18n("Unsubscribe") ?></button>
					 				</form>
					 												 			
				 			<?php endif ?>
				 			</div>
								<div class="col-md-6">
									<a href="index.php?controller=group&action=showcurrent&id=<?=$group->getID() ?>">
										<button class="btn btn-info btn-md pull-right">
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
