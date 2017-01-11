<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
$conversations = $view->getVariable("conversations");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<div class="container-fluid">
 		<div class="row">
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
 				<div class="row">
	 				<div class="panel">
	 					<div class="panel-body">
	 						 
	 					</div>
	 					<div class="panel-footer">
	 						<div class="pull-left">
	 							<form action="index.php?controller=conversation&action=delete" method="POST">
	 								<input type="text" name="id" value="<?=$c->getID()  ?>" hidden="hidden">
	 								<button type="submit" name="delete">
	 									<i class="fa fa-trash-o"></i>
	 									<?= i18n("Delete") ?>
	 								</button>
	 							</form>
	 						</div>
	 						<div class="pull">
	 							
	 						</div>
	 					</div>
	 				</div>
 				</div>
 			</div>			
 		<?php endforeach ?>
 	</div>