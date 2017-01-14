<?php
	
	require_once(__DIR__."/../../core/ViewManager.php");
	$view = ViewManager::getInstance();
	$user = $view->getVariable("user");
	$group = $view->getVariable("group");
	$users = $view->getVariable("users");
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
					<h1><?= i18n("Edit Group: ")?><?= $group->getName() ?></h1>
				</div>
				<div class="row">
					<form action="index.php?controller=group&action=edit&id=<?=$id ?>" method="post">
						<div class="form-group">
							<label for="name"><?= i18n("Name")?></label>
							<input type="text" class="form-control" id="name" name="name" placeholder="<?= $group->getName()?>" value="<?= $group->getName()?>">
						</div>
						<div class="form-group">
							<label for="description"><?= i18n("Description")?></label>
							<input type="textarea" class="form-control" id="description" name="description" placeholder="<?= $group->getDescription()?>" value="<?= $group->getDescription()?>">
						</div>
						<div class="form-group">
							<label for="private"><?= i18n("Visivility")?></label>
							<select class="form-control" id="private" name="private">
								<option value="0"><?= i18n("Public")?></option>
								<option
									<?php
										if ($group->getPrivate()) {
											echo " selected ";
										}
									?>
								value="1"><?= i18n("Private")?></option>
							</select>
						</div>

						<div class="form-group">
							<label for="status"><?= i18n("Status")?></label>
							<select class="form-control" id="status" name="status">
								<option value="1"><?= i18n("Active")?></option>
								<option
									<?php
										if (!$group->getStatus()) {
											echo " selected ";
										}
									?>
								value="0"><?= i18n("Down")?></option>
							</select>
						</div>
						
						<button type="submit" name="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>