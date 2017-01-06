<?php 

$view = ViewManager::getInstance();
	/*
		index.php?controller=user&action=view&user=($user)
	*/

	$user = $view->getVariable("user");
	$friends = $view->getVariable("friends");//friendship
	$publications = $view->getVariable("publications");
	$documents = $view->getVariable("documents");
 ?>

 	<div class="col-md-10 col-md-offset-1">
 		<div class="well">
 		<div class="row">
 			<div class="col-md-4">
	 			<div class="container">
	 				<img class="img-circle" id="profileImage" src="media/profileImages/test.jpg" alt="profile Image" style="height: 200px;width: 200px">
	 			</div>
 				
 			</div>

 			<div class="col-md-8">
 				<div id="dataDump">
 					<div class="container">
 						<?php 
 							echo $user->getName();
 							echo $user->getSurname();
 							echo $user->getUser();
 							echo $user->getPhoto();
 						 ?>
 					</div>
 				</div>
 				
 			</div>
 		</div>
 		</div>



 		<div class="row">
 			<div class="col-md-4">
 				<div class="well">
					<div class="row">
						<i class="fa fa-user fa-fw"></i>   <?= i18n("Friends") ?> 


					</div>
					<div class="row">
							<?php print_r($friends) ?>
					</div>
			
				</div>
				<div class="well">
					<div class="row">
						<i class="fa fa-user fa-fw"></i>   <?= i18n("Documents") ?> 


					</div>
					<div class="row">
							<?php print_r($documents) ?>
					</div>
			
				</div>
 			</div>
 			<div class="col-md-8">

				<!-- 1 por publicación -->
				<div class="well">
					<div class="row">
						Publicación 1
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod incidunt rem quis perspiciatis dolore, maxime, ratione eum voluptas laudantium voluptatibus modi quam sequi culpa. Quia quae, eius incidunt tenetur magni.
					</div>
				</div>

				<!-- 1 por publicación -->
				<div class="well">
					<div class="row">
						Publicación 2
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde ipsam vel illo, doloribus repellat asperiores maiores aliquam quos a modi amet fugiat deserunt consequuntur, delectus cumque, repellendus laborum reiciendis hic.
					</div>
				</div>

				<!-- 1 por publicación -->
				<div class="well">
					<div class="row">
						<?php print_r($publications) ?>
					</div>
				</div>


 			</div>
 		</div>	
 		
 	</div>

 	