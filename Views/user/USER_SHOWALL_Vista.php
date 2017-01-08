<?php 

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$lang='EN';
include (__DIR__.'/../../js/datatable/showscript'.$lang.'.js');
$user = $view->getVariable("user");
$users = $view->getVariable("users");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>

	

 	<!-- se user = currentuser mostrar edit perfil -->
	

 	<div class="col-md-8 col-md-offset-2">
 		<div class="row">
 			<div class="col-md-3">
	 			<div class="container">
	 				<h1 class="heading"><?= i18n("User Management") ?></h1>
	 			</div>
 				
 			</div>
 		</div>

 		<div class="row">
 		<div class="container-fluid">
 		<div class="pull-right">
 			<a href="index.php?controller=user&action=add"><button class="btn btn-success"><?= i18n("Create New User") ?></button></a>
 		</div>
 		</div> 			
 		</div>

 		<div class="well">
 			<div class="row" style="padding: 10px">
 				<table id="dataTable" class="table-responsive table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
 					<thead>
 						<tr class="row">
 						<th class='text-center'><?= i18n("Username") ?></th>
 						<th class='text-center'><?= i18n("Name") ?></th>
 						<th class='text-center'><?= i18n("Surname") ?></th>
 						<th class='text-center'><?= i18n("Type") ?></th>
 						<th class='text-center'><?= i18n("Options") ?></th>
 					</tr>
 					</thead>
 					
 					<tbody>
 						<?php 
 						foreach ($users as $user) {
 							echo '<tr class="row">';
 								echo "<td class='text-center'>".$user->getUser()."</td>";
 								echo "<td class='text-center'>".$user->getName()."</td>";
 								echo "<td class='text-center'>".$user->getSurname()."</td>";
 								echo "<td class='text-center'>".$user->getType()."</td>";

 								echo "<td class='text-center'>";


 								echo '<div class="row text-center">
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=user&action=showcurrent&id='.
					 						$user->getID().'">
					 							<button class="btn btn-info btn-xs">
					 								<i class="fa fa-eye"></i>
					 							</button>
					 						</a>
					 					</div>
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=user&action=edit&id='.
					 						$user->getID().'">
					 							<button class="btn btn-warning btn-xs">
					 								<i class="fa fa-edit"></i>
					 							</button>
					 						</a>
					 					</div>
					 					<div class="col-xs-3">
					 						<a href="index.php?controller=user&action=delete&id='.
					 						$user->getID().'">
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
 	