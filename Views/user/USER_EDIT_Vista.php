<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
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
	 	    <h1><?= i18n("Edit User: ")?><?= $user->getUser() ?></h1>
	 	</div>
	 	<div class="row">
		    <form action="index.php?controller=user&action=edit" method="POST" enctype="multipart/form-data">
		 	<div class="form-group">
			    <label for="name"><?= i18n("Name")?></label>
			    <input type="text" class="form-control" id="name" name="name" value="<?= $user->getName()?>">
			</div>
			<div class="form-group">
			    <label for="surname"><?= i18n("Surname")?></label>
			    <input type="text" class="form-control" id="surname" name="surname" value="<?= $user->getSurname()?>">
			</div>

			<div class="form-group">
			    <label for="password"><?= i18n("Password")?></label>
			    <input type="password" class="form-control" id="password" name="password">
			</div>
			<div class="form-group">
			    <label for="phone"><?= i18n("Phone")?></label>
			    <input type="number" class="form-control" id="phone" name="phone" value="<?= $user->getPhone()?>">
			</div>
			<div class="form-group">
			    <label for="address"><?= i18n("Adress")?></label>
			    <input type="text" class="form-control" id="address" name="address" value="<?= $user->getAddress()?>">
			</div>
			<div class="form-group">
			    <label for="birthday"><?= i18n("Birth Date")?></label>
			    <input type="text" class="form-control" id="birthday" name="birthday" value="<?=$user->getBirthday() ?>"
			</div>
			<div class="form-group">
			    <label for="email"><?= i18n("Email")?></label>
			    <input type="email" class="form-control" id="email" name="email" value="<?= $user->getEmail() ?>">
			</div>
			

			<div class="form-group">
			    <label for="type"><?= i18n("Privileges")?></label>
			    <select class="form-control" id="type" name="type">
				<option value="0"><?= i18n("Base user")?></option>
				<option
				    <?php 
				    if ($user->getType()) {
					echo " selected ";
				    } ?>
value="1"><?= i18n("Admin")?></option>
			    </select>
			</div>

			<div class="form-group">
			    <label for="private"><?= i18n("Visivility")?></label>
			    <select class="form-control" id="private" name="private">
				<option value="public"><?= i18n("Public")?></option>
				<option
				    <?php 
				    if ($user->getPrivate()) {
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
				    if (!$user->getStatus()) {
					echo " selected ";
				    } 
				    ?>
value="down"><?= i18n("Down")?></option>
			    </select>
			</div>
			<div class="form-group">
			    <label for="file"><?= i18n("Profile Image")?></label>
			    <input type="file" class="form-control-file" id="file" name="file">
			    
			</div>
			<input type ="hidden" name="id" value="<?= $user->getID()?>">
			<input type ="hidden" name="user" value="<?= $user->getUser()?>">
			<button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
		    </form>
	 	</div>
 	    </div>
 	</div>
    </div>	
</div>

