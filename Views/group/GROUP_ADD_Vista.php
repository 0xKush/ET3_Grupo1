
 <div class="container-fluid">
 	
 	<div class="col-md-8 col-md-offset-2" >
 		<div class="well">
 		<div class="container-fluid">
	 		<div class="row">
	 			<h1><?= i18n("Create User")?></h1>
	 		</div>
	 		<div class="row">
		 		<form action="index.php?controller=user&action=add" method="POST">
		 			<div class="form-group">
					    <label for="name"><?= i18n("Name")?></label>
					    <input type="text" class="form-control" id="name" placeholder="<?= i18n("Name")?>">
					  </div>
					  <div class="form-group">
					    <label for="surname"><?= i18n("Surname")?></label>
					    <input type="text" class="form-control" id="surname" placeholder="<?= i18n("Surname")?>">
					  </div>
					  <div class="form-group">
					    <label for="phone"><?= i18n("Phone")?></label>
					    <input type="number" class="form-control" id="phone" placeholder="<?= i18n("Surname")?>">
					  </div>
					  <div class="form-group">
					    <label for="adress"><?= i18n("Adress(City, Country)")?></label>
					    <input type="text" class="form-control" id="adress" placeholder="<?= i18n("Adress")?>">
					  </div>
					  <div class="form-group">
					    <label for="birthday"><?= i18n("Birth Date")?></label>
					    <input type="text" class="form-control" id="birthday">
					  </div>
					  <div class="form-group">
					    <label for="email"><?= i18n("Email")?></label>
					    <input type="email" class="form-control" id="email" placeholder="<?= i18n("Email") ?>">
					   
					  <div class="form-group">
					    <label for="type"><?= i18n("Privileges")?></label>
					    <select class="form-control" id="type">
					      <option value="0"><?= i18n("Base user")?></option>
					      <option value="1"><?= i18n("Admin")?></option>
					    </select>
					  </div>

					  <div class="form-group">
					    <label for="private"><?= i18n("Visivility")?></label>
					    <select class="form-control" id="private">
					      <option value="public"><?= i18n("Public")?></option>
					      <option value="private"><?= i18n("Private")?></option>
					    </select>
					  </div>

					  <div class="form-group">
					    <label for="status"><?= i18n("Status")?></label>
					    <select class="form-control" id="status">
					      <option value="up"><?= i18n("Active")?></option>
					      <option value="down"><?= i18n("Down")?></option>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="file"><?= i18n("Profile Image")?></label>
					    <input type="file" class="form-control-file" id="file" >
					    
					  </div>
					  <button type="submit" class="btn btn-primary pull-right"><?= i18n("Submit")?></button>
					</form>
	 		</div>
 		</div>
 		</div>
 	</div>	
 </div>

 	<script>
  $(document).ready(function(){
    $('#birthday').datepicker({
  format: "yyyy-mm-dd",
  startDate: "-100y",
  endDate: "0d",
  changeMonth: true,
        changeYear: true
    });
});
  </script>