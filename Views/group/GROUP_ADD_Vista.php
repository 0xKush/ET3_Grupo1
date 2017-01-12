<?php 
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$group = $view->getVariable("group");
	$users = $view->getVariable("users");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$errors = $view->getVariable("errors");
	$id = $_GET["id"];
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>


 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Add Group: ")?><?= $group->getName() ?></h1>
	 		</div>
	 		<div class="row">
		 		<form action="index.php?controller=group&action=add" method="post">
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" name="name">
					  </div>

					  <div class="form-group">
					    <label for="description"><?= i18n("Description")?></label>
					    <input type="textarea" class="form-control" id="description" name="description">
					  </div>		   

					  <div class="form-group">
					    <label for="private"><?= i18n("Visivility")?></label>
					    <select class="form-control" id="private" name="private">
					      <option value="public"><?= i18n("Public")?></option>
					      <option value="private"><?= i18n("Private")?></option>
					    </select>
					  </div>

					 
					  <button type="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

