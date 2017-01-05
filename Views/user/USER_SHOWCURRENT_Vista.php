<?php 

$view = ViewManager::getInstance();
	/*
		index.php?controller=user&action=view&user=($user)
		View: User profile
		
		Input: 
				- Consult User -> $user
					-tipo perfil

	*/

	$user = $view->getVariable("user");
 ?>

	

 	<!-- se user = currentuser mostrar edit perfil -->

	<div class="col-md-2">
		<div class="well">
			<div class="row">
				Documentos?
			</div>
			
		</div>
	</div>

 	<div class="col-md-8">
 		<div class="well">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<img id="profileImage" src="media/profileImages/test.jpg" alt="profile Image" style="height: 200px;width: 200px">
	 			</div>
 				
 			</div>
 		</div>
 		</div>

 		<div class="well">
 			<div class="row">
 				<div id="data-dump" class="">
 					<?php print_r($user);



 					 ?>
 				</div>
 			</div>
 		</div>
 		
 		
 	</div>
 	