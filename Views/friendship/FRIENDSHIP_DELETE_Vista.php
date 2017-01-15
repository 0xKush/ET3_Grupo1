<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$friendship = $view->getVariable("friendship");

if ($friendship->getMember() == $currentuserid) {
								$friendid = $friendship->getSecondaryMember();
							}else{							
							 	$friendid = $friendship->getMember();
							}

?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>



 	<div class="container-fluid">
 		<div class="row">
 			<div class="panel">
 				<div class="panel-body">
 					<div class="row text-center">
 						<?= i18n("Are you sure you wanna unfriend this user")?>?
 					</div>
 					<div class="pull-right">
 						<form action="index.php?controller=friendship&action=delete" method="post">
 							<input hidden="hidden" type="text" name="id" value="<?=$friendid?>">
 							<a href="index.php?controller=user&action=login">
						<button type="button" class="btn btn-default">
							<?= i18n("No, go back") ?>
						</button>
					</a>    
 							<button class="btn btn-danger" value="yes" type="submit" name="submit">
 								<?= i18n("Yes") ?>
 							</button>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>