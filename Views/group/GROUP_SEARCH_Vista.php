<?php 
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$users = $view->getVariable("users");
	$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Search Groups: ")?></h1>
	 		</div>
	 		<div class="row">
		 		<form action="index.php?controller=group&action=search" method="post">
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" name="name">
					  </div>

					  <div class="form-group">
					    <label for="description"><?= i18n("Description")?></label>
					    <input type="textarea" class="form-control" id="description" name="description">
					  </div>

					  <div class="form-group">
					  	<label for="date"><?= i18n("Creation Date")?></label>
					  	<input class="form-control" type="text" name="creationdate" id="date">
					  </div>		   

					  <div class="form-group">
					    <label for="private"><?= i18n("Visivility")?></label>
					    <select class="form-control" id="private" name="private">
					    	<option value=""><?=i18n("Not relevant") ?></option>
					      <option value="public"><?= i18n("Public")?></option>
					      <option value="private"><?= i18n("Private")?></option>
					    </select>
					  </div>

					  <div class="form-group">
					    <label for="owner"><?= i18n("Owner")?></label>
					    <select class="form-control" id="owner" name="owner">
					    	<option value=""><?= i18n("Any")?></option>
					     <?php foreach ($users as $u): ?>
					     	<option value="<?=$u->getID() ?>"><?=$u->getUser() ?></option>
					     <?php endforeach ?>
					    </select>
					  </div>
					   <div class="form-group">
					    <label for="status"><?= i18n("Status")?></label>
					    <select class="form-control" id="status" name="status">
					    	<option value=""><?=i18n("Not relevant") ?></option>
					      <option value="1"><?= i18n("Active")?></option>
					      <option value="0"><?= i18n("Deceased")?></option>
					    </select>
					  </div>

					 
					  <button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

