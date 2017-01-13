<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
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
	 	    <h1><?= i18n("Search Users")?></h1>
	 	</div>
	 	<div class="row">
		    <form action="index.php?controller=user&action=search" method="POST">

		 	<div class="form-group">
			    <label for="user"><?= i18n("Username")?></label>
			    <input type="text" class="form-control" id="user" name="user" placeholder="<?= i18n("Username")?>">
			</div>
		 	<div class="form-group">
			    <label for="name"><?= i18n("Name")?></label>
			    <input type="text" class="form-control" id="name" name="name" placeholder="<?= i18n("Name")?>">
			</div>
			<div class="form-group">
			    <label for="surname"><?= i18n("Surname")?></label>
			    <input type="text" class="form-control" id="surname" name="surname" placeholder="<?= i18n("Surname")?>">
			</div>
			<div class="form-group">
			    <label for="email"><?= i18n("Email")?></label>
			    <input type="email" class="form-control" id="email" name="email" placeholder="<?= i18n("Email") ?>">
			</div>
	
			<div class="form-group">
			    <label for="type"><?= i18n("Privileges")?></label>
			    <select class="form-control" id="type" name="type">
				<option value="0"><?= i18n("Base user")?></option>
				<option value="1"><?= i18n("Admin")?></option>
			    </select>
			</div>

			<div class="form-group">
			    <label for="private"><?= i18n("Visivility")?></label>
			    <select class="form-control" id="private" name="private">
				<option value="public"><?= i18n("Public")?></option>
				<option value="private"><?= i18n("Private")?></option>
			    </select>
			</div>

			<div class="form-group">
			    <label for="status"><?= i18n("Status")?></label>
			    <select class="form-control" id="status" name="status">
				<option value="up"><?= i18n("Active")?></option>
				<option value="down"><?= i18n("Down")?></option>
			    </select>
			</div>

			    
			</div>
			<button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
		    </form>
	 	</div>
 	    </div>
 	</div>
    </div>	
</div>

