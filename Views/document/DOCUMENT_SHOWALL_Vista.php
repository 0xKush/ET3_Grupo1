<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$user = $view->getVariable("user");
$documents = $view->getVariable("documents");
$errors = $view->getVariable("errors");
$currentuserid = $view->getVariable("currentuserid");
$isAdmin = $view->getVariable("isadmin");
?>
<?= isset($errors["general"])?$errors["general"]:"" ?>
<?php $view->moveToDefaultFragment(); ?>
<?php print_r($errors) ?>


<div class="container-fluid">

	<div class="row text-center" style="padding-left: 15px;padding-right: 15px">
		<div class="panel">
			<div class="panel-body">
				<font class="title"><?= i18n("Documents") ?></font>
			</div>
		</div>
	</div>



	<div class="row">
 		<div class="container-fluid">
 		<div class="pull-right">
 			<a href="index.php?controller=document&action=add"><button class="btn btn-success"><?= i18n("Upload a new document") ?></button></a>
 		</div>
 		</div> 			
 		</div>

 		<div class="well">
 			<div class="row" style="padding: 10px">
 				<table id="dataTable" class="table-responsive table-hover" style="width:80%; margin-right: 10%; margin-left: 10%">
 					<thead>
 						<tr class="row">
 						<th class='text-center'><?= i18n("File") ?></th>
 						<th class='text-center'><?= i18n("Upload Date") ?></th>
 						<th class='text-center'><?= i18n("Options") ?></th>
 					</tr>
 					</thead>
 					
 					<tbody>
 						<?php 
 						foreach ($documents as $document) {
 							echo '<tr class="row">';
 								echo "<td class='text-center'><a href=".$document->getLocation().">".$document->getLocation()."</a></td>";
 								echo "<td class='text-center'>".$document->getUploadDate()."</td>";
 							
 								echo "<td class='text-center'>";
 								if ($document->getOwner() == $currentuserid || $document->getOwner() == $isAdmin ){

 								echo'	<div class="col-xs-3">
					 						<a href="index.php?controller=document&action=delete&id='.
					 						$document->getID().'">
					 							<button class="btn btn-danger btn-xs">
					 								<i class="fa fa-trash-o"></i>
					 							</button>
					 						</a>
					 					</div>';
 								}

 								echo '<div class="row text-center">';
								
					 			echo	'</div>';
 								echo "</td>";
 							echo '</tr>';
 						}


 					 ?>
 					</tbody>
 				
 				
 					
 				</table>
 			</div>
 		</div>

 			