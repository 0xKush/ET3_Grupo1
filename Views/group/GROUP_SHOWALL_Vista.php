<?php 

$view = ViewManager::getInstance();
	/*
		View: User profile
		
		Input: showall grupos

	*/

	$groups = $view->getVariable("groups");
 ?>

	

 	<!-- se user = currentuser mostrar edit perfil -->


 	<div class="col-md-8 col-md-offset-2">
 		<div class="well">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<p>Group showall</p>
	 			</div>
 				
 			</div>
 		</div>
 		</div>

 		<div class="well">
 			<div class="row">
 				<div id="data-dump" class="">
 					<?php print_r($groups);



 					 ?>
 				</div>
 			</div>
 		</div>
 		
 		
 	</div>
 	