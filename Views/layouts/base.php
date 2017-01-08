<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userid = $view->getVariable("currentuserid");

?><!DOCTYPE html>
<html>
    <head>
	<title>Caralibro!</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">

   <!-- DataTables CSS -->
    <link href="lib/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="lib/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- DataTables JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="lib/datatables-responsive/dataTables.responsive.js"></script>

    <!-- includes for datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false">
        <span class="sr-only"><?= i18n("Toggle navigation") ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?controller=user&action=home">[Caralibro!]</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="collapse-1">
      <ul class="nav navbar-nav">
        <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="media/profileImages/test.jpg" alt="" style="height: 25px;;">  <?=$currentuser ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="index.php?controller=friendship&action=showall"><i class="fa fa-user fa-fw"></i>  <?= i18n("Friends") ?>  <span class="badge pull-right">0</span></a></li>
              <li><a href="index.php?controller=usergroup&action=showall"><i class="fa fa-group fa-fw"></i>  <?= i18n("Groups") ?><span class="badge pull-right">0</span></a></li>
              <li><a href="index.php?controller=guest&action=showall"><i class="fa fa-calendar fa-fw"></i>  <?= i18n("Events") ?><span class="badge pull-right">0</span></a></li>
              <li><a href="index.php?controller=user&action=showUserConversations"><i class="fa fa-envelope fa-fw"></i>  <?= i18n("Conversation") ?>  <span class="badge pull-right">0</span></a></li>

              <li role="separator" class="divider"></li>
              <li><a href="index.php?controller=user&action=admin"><i class="fa fa-cog fa-fw"></i>  <?= i18n("Admin Zone") ?></a></li>
              <li role="separator" class="divider"></li>
              <li><a href="index.php?controller=user&action=logout"><i class="fa fa-sign-out" style="color: blue;"></i>  <?= i18n("Logout") ?></a></li>
          </ul>
        </li>
        <li><li><a href="index.php?controller=user&action=showcurrent&id=<?= $userid ?>"><?= i18n("My Profile") ?></a></li></li>
      </ul>
        <li><a href="index.php?controller=publication&action=showall"><?= i18n("Publications") ?></a></li>

      </ul>
      <ul class="navbar-form navbar-right">
        <div class="form-group">
        </div>
        <a href="index.php?controller=user&action=search"><button type="submit" class="btn btn-primary"><?= i18n("Search") ?></button></a>
        <?php include(__DIR__."/../layouts/language_select_element.php"); ?>
      </form>
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
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
