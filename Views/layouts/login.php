<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../Controllers/LANGUAGE_Controller.php");
$lc = new LANGUAGE_controller();
$idioma = $lc->getLanguage();
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
    <head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/login/login.css" type="text/css">
	<link rel="stylesheet" href="lib/parsley/parsley.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

	<!--FAVICON-->
    <link rel="icon"
          type="image/ico"
          href="media/images/favicon.ico">

	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
	
    </head>
    <body>

	<main>
	    <div id="flash">
		<?= $view->popFlash() ?>
	    </div>

	    <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>
	
	<link rel="stylesheet" href="lib/parsley/parsley/parsley.css">

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Login style -->
	<script src="js/login/login.js"></script>

	<!-- Bootstrap core JavaScript
	     ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

  	<!-- validation js's -->
  	<script src="lib/parsley/parsley.min.js"></script>

  	<?php 
  	switch ($idioma) {
  		case 'es':
  			echo '<script src="lib/parsley/language/es.js"></script>';
  			break;

  		case 'gl':
  			echo '<script src="lib/parsley/language/gl.js"></script>';
  			break;

  	}
  	 ?>

    </body>
</html>
