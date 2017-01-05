<?php 
	/*
		View: showall

		input->user->showall()


	*/
$view = ViewManager::getInstance();
$users = $view->getVariable("users");

 ?>

	

 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="well">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="page-header">Showall users</h1>
	 			</div>
 				
 			</div>
 		</div>
 		</div>

 		<div class="well">
 			<div class="row">
 				<div id="data-dump" class="">
 					<?php print_r($users);



 					 ?>
 				</div>
 			</div>
 		</div>
 		
 		
 	</div>
 	