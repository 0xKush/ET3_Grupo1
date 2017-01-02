<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
    <head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<!--FAVICON-->
    <link rel="icon"
          type="image/ico"
          href="media/images/favicon.ico">

	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
	
    </head>
    <body>
	<!-- header -->
	<header>
	<h1>Welcome bitch</h1>
		<h2>isto está no layout</h2>
	</header>

	<main>
	    <div id="flash">
		<?= $view->popFlash() ?>
	    </div>

	    <div class="col-xs-12 col-md-8 col-md-offset-2">
	    	<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	    </div>

	    
	</main>

	<footer>

	</footer>

	<!-- Bootstrap core JavaScript
	     ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

    </body>
</html>
