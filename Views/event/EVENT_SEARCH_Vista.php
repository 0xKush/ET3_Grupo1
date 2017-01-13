<?php
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$errors = $view->getVariable("errors");
	$users = $view->getVariable("users");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Search Events: ")?></h1>
	 		</div>
	 		<div class="row">
		 		<form action="index.php?controller=event&action=search" method="post">
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" name="name">
					  </div>
					  <div class="form-group">
					    <label for="description"><?= i18n("Description")?></label>
					    <input type="textarea" class="form-control" id="description" name="description">
					  </div>

					  <div class="form-group">
					    <label for="date"><?= i18n("Start date")?></label>
					    <input type="text" class="form-control" id="date" name="startdate" >
					  </div>
					  <div class="form-group">
					    <label for="date2"><?= i18n("End date")?></label>
					    <input type="text" class="form-control" id="date2" name="enddate" >
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
					    <label for="hour1"><?= i18n("Start hour")?></label>
					    <input type="time" class="form-control" id="hour1" name="starthour" >
					  </div>
					  <div class="form-group">
					    <label for="hour"><?= i18n("End hour")?></label>
					    <input type="time" class="form-control" id="hour" name="endhour" >
					  </div>	

					  <button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

