<?php 

$view = ViewManager::getInstance();
	/*
		View: Administrador


	*/

 ?>



 	<div class="col-md-8 col-md-offset-2">
 		<div class="well">
 		<div class="row">
 			<a href="index.php?controller=user&action=showall"><button class="btn btn-primary"><?= i18n("Users") ?></button></a>
 		</div>
 		</div>

 		<div class="well">
 		<div class="row">
				<a href="index.php?controller=group&action=showall"><button class="btn btn-primary"><?= i18n("Groups") ?></button></a>
 		</div>
 		</div>

 		<div class="well">
 		<div class="row">
		<a href="index.php?controller=event&action=showall"><button class="btn btn-primary"><?= i18n("Events") ?></button></a>
 		</div>
 		</div>
 		
 	</div>
 	