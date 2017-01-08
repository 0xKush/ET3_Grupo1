<?php 
$view = ViewManager::getInstance();
$id = $_GET["id"];
$event = $view->getVariable("event");

 ?>

 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Create Event: ")?><?= $event->getName() ?></h1>
	 		</div>
	 		<div class="row">
		 		<form>
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" name="name">
					  </div>
					  <div class="form-group">
					    <label for="description"><?= i18n("Description")?></label>
					    <input type="textarea" class="form-control" id="description" name="description">
					  </div>

					  <div class="form-group">
					    <label for="date"><?= i18n("Start date")?></label>
					    <input type="text" class="form-control" id="date" name="startdate" >
					  </div>
					  <div class="form-group">
					    <label for="date2"><?= i18n("End date")?></label>
					    <input type="text" class="form-control" id="date2" name="enddate" >
					  </div>

					  <div class="form-group">
					    <label for="hour1"><?= i18n("Start hour")?></label>
					    <input type="time" class="form-control" id="hour1" name="starthour" >
					  </div>
					  <div class="form-group">
					    <label for="hour"><?= i18n("End hour")?></label>
					    <input type="time" class="form-control" id="hour" name="endhour" >
					  </div>					   

					  <div class="form-group">
					    <label for="private"><?= i18n("Visivility")?></label>
					    <select class="form-control" id="private" name="private">
					      <option value="public"><?= i18n("Public")?></option>
					      <option value="private"><?= i18n("Private")?></option>
					    </select>
					  </div>

					  <button type="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

