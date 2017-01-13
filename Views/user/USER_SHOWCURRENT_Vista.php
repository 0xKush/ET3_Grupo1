<?php 
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();

	$friends = $view->getVariable("friends");//friendship
	$publications = $view->getVariable("publications");
	$documents = $view->getVariable("documents");
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");

	require_once(__DIR__."/../../Models/USER_Model.php");
	$umapper = new USER_Model();
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 	<div class="col-md-10 col-md-offset-1">
 		<div class="well">
 		<div class="row">
 			<div class="col-md-4">
	 			<div class="container-fluid">
	 			<?php if ($user->getPhoto() != NULL): ?>
	 				<img class="img-circle" id="profileImage" src="media/profileImages/<?=$user->getPhoto()  ?>" alt="profile Image" style="height: 200px;width: 200px">
	 			<?php else: ?>
	 				<img class="img-circle" id="profileImage" src="media/profileImages/default.png"" alt="profile Image" style="height: 200px;width: 200px">
	 			<?php endif ?>
	 				
	 			</div>
 				
 			</div>

 			<div class="col-md-8">
 				<div class="row pfname">
 					<font><?=$user->getName() ?> <?=$user->getSurname() ?></font>
 				</div>
 				<div class="row pfusername">
 					<font >@<?=$user->getUser()  ?></font>
 				</div>
 				
 				
 			</div>
 		</div>
 		</div>



 		<div class="row">
 			<div class="col-md-4">
 				<div class="well">
					<div class="row">
						<i class="fa fa-user fa-fw"></i>   <?= i18n("Friends") ?> 


					</div>
					<div class="row">
							<?php foreach ($friends as $friend): ?>
					 			<div class="well">
						 			<div class="row">
						 				<div class="container-fluid">
						 					<a href="index.php?controller=user&action=showcurrent&id=<?=$friend->getID() ?>"><?= $friend->getName();  ?></a>
						 				</div>
						 				<div class="container-fluid">
						 					<?= $friend->getUser()?><br>
						 					<?= $friend->getPhoto()  ?>
						 				</div>
						 			</div>
					 			</div>
					 		<?php endforeach ?>
					</div>
			
				</div>
				
 			</div>
 			<div class="col-md-8">

				<?php foreach ($publications as $publication): ?>
		 			<div class="well">
			 			<div class="row">
			 				<div class="container-fluid">
			 					<?= $publication->getDescription() ?>
			 				</div>
			 				<div class="container-fluid">
			 					<?= i18n("Author") ?>: <a href="index.php?controller=user&action=showcurrent&id=<?=$publication->getOwner() ?>"><?php $owner = $umapper->showcurrent($publication->getOwner()); echo $owner->getUser();  ?></a>
			 				</div>
			 				<div class="container-fluid">
			 					<?= $publication->getCreationDate();?>
			 					<?= $publication->getHour()  ?>
			 				</div>
			 			</div>
		 			</div>
		 		<?php endforeach ?>


 			</div>
 		</div>	
 		
 	</div>

 	