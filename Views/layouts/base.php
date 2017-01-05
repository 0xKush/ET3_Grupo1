<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
    <head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
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
		<nav class="navbar navbar-inverse">
  <div class="container-fluid col-md-10 col-md-offset-1">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?controller=user&action=home">[Logo]</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Amigos<span class="sr-only">(current)</span></a></li>
        <li><a href="index.php?controller=group&action=showall">Grupos</a></li>
        <li><a href="index.php?controller=event&action=showall">Eventos</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="media/profileImages/test.jpg" alt="" style="height: 25px;width: 25px;">  <?=$_SESSION['currentuser'] ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?controller=user&action=showcurrent&id=<?= $_SESSION['currentuserid']?>">Ver perfil</a></li>
            <li><a href="index.php?controller=">Mensaxes</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="index.php?controller=user&action=logout"><i class="fa fa-exit">Sair</i></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	</header>

	<main>
	    <div id="flash">
		      <?= $view->popFlash() ?>
	    </div>

	    <div class="col-xs-12 col-md-10 col-md-offset-1" >
        <div class="container-fluid">
          <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
        </div>
	    </div>

	    
	</main>

	<footer>

	</footer>

	<!-- Bootstrap core JavaScript
	     ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
