<?php 

$view = ViewManager::getInstance();
	/*
		View: User profile
		
		Input: showall grupos

	*/

	$events = $view->getVariable("events");

	$lang = 'EN';
	include (__DIR__.'/../../js/datatable/showscript'.$lang.'.js');

 ?>

	

 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("Event Management") ?></h1>
	 			</div>
 				
 			</div>
 		</div>

 		<div class="well">
 			<div class="row" style="padding: 10px">
 				<table id="dataTable" class="table-responsive table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
 					<thead>
 						<tr class="row">
 						<th class='text-center'><?= i18n("Name") ?></th>
 						<th class='text-center'><?= i18n("Owner") ?></th>
 						<th class='text-center'><?= i18n("Private?") ?></th>
 						<th class='text-center'><?= i18n("Status") ?></th>
 						<th class='text-center'><?= i18n("Options") ?></th>
 					</tr>
 					</thead>
 					
 					<tbody>
 						<?php 
 						foreach ($events as $event) {
 							echo '<tr class="row">';
 								echo "<td class='text-center'>".$event->getName()."</td>";
 								echo "<td class='text-center'>".$event->getOwner()."</td>";
 								echo "<td class='text-center'>".$event->getPrivate()."</td>";
 								echo "<td class='text-center'>".$event->getStatus()."</td>";

 								echo "<td class='text-center'>";


 								echo '<div class="row text-center">
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=event&action=showcurrent&id='.
					 						$event->getID().'">
					 							<button class="btn btn-info btn-xs">
					 								<i class="fa fa-eye"></i>
					 							</button>
					 						</a>
					 					</div>
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=event&action=edit&id='.
					 						$event->getID().'">
					 							<button class="btn btn-warning btn-xs">
					 								<i class="fa fa-edit"></i>
					 							</button>
					 						</a>
					 					</div>
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=event&action=delete&id='.
					 						$event->getID().'">
					 							<button class="btn btn-danger btn-xs">
					 								<i class="fa fa-trash-o"></i>
					 							</button>
					 						</a>
					 					</div>
					 				</div>';


 								echo "</td>";
 							echo '</tr>';
 						}


 					 ?>
 					</tbody>
 				
 				
 					
 				</table>
 			</div>
 		</div>
 		
 		
 	</div>
 	