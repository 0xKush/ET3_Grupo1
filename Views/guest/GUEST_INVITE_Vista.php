<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuserid = $view->getVariable("currentuserid");
$errors = $view->getVariable("errors");
$friends = $view->getVariable("friends");
$event = $view->getVariable("event");


?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<div class="container-fluid">
<div class="row">
	<form action="index.php?controller=guest&action=invite" method="post">
	<?php foreach ($friends as $friend): ?>
		<div class="col-md-4">
			<div class="panel">
				<div class="panel-body">
					<div class="container-fluid">
 						<a href="index.php?controller=user&action=showcurrent&id=<?=$friend->getID() ?>">
 						<?php if ($friend->getPhoto() != NULL): ?>
 							<img class="smallPhoto img-circle" src="<?= $friend->getPhoto()?>" alt="">
 						<?php else:  ?>
 							<img class="smallPhoto img-circle" src="media/profileImages/default.png" alt="">
 						<?php endif ?></a>

 							<?= $friend->getName() ?><?= $friend->getSurname() ?>
 							<div class="row pull-right">
 								<font class="user">@<?= $friend->getUser()  ?></font>
 							</div>
 						</div>
				</div>
				<div class="panel-footer">
				<div class="row">
				<div class="pull-right" style="padding-right: 15px">
					<span><input  type="checkbox" name="invites[]" value="<?=$friend->getID()  ?>"><?= i18n("Invite?") ?></span>
				</div>
					
				</div>
					
				</div>
			</div>
		</div>		
	<?php endforeach ?>
	</div>
	<div class="row" >
				<input type="text" hidden  name="id" value="<?= $event->getID() ?>">
		
					<div class="row pull-right" style="padding-right: 15px">
						<button class="btn btn-success" type="submit" name="submit">
							<?= i18n("Invite") ?> 
							<i class="fa fa-send fa-fw"></i>
						</button>
					</div>
			
	</div>

	</form>
</div>
