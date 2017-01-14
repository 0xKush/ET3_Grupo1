<?php
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");
	$id = $_GET["id"];
	$event = $view->getVariable("event");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Edit Event: ")?><?= $event->getName() ?></h1>
	 		</div>
	 		<div class="row">
		 		<form method="post" action="index.php?controller=event&action=edit">
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event->getName()?>">
					  </div>
					  <div class="form-group">
					    <label for="description"><?= i18n("Description")?></label>
					    <input type="textarea" class="form-control" id="description" name="description" placeholder="<?= $event->getDescription()?>">
					  </div>
					  

					  <div class="form-group">
					    <label for="private"><?= i18n("Visivility")?></label>
					    <select class="form-control" id="private" name="private">
					      <option value="public"><?= i18n("Public")?></option>
					      <option
							<?php 
								if ($event->getPrivate()) {
									echo " selected ";
								}
							 ?>
					       value="private"><?= i18n("Private")?></option>
					    </select>
					  </div>

					  <div class="form-group">
					    <label for="status"><?= i18n("Status")?></label>
					    <select class="form-control" id="status" name="status">
					      <option value="up"><?= i18n("Active")?></option>
					      <option
							<?php
								if (!$event->getStatus()) {
								 	echo " selected ";
								 } 
							 ?>
					       value="down"><?= i18n("Down")?></option>
					    </select>
					  </div>
					  <input type="text" name="id" value="<?= $event->getID() ?>" hidden>
					 
					  <button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

