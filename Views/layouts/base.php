<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userid = $view->getVariable("currentuserid");

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
        <span class="sr-only"><?= i18n("Toggle navigation") ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?controller=user&action=home">[Caralibro!]</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="media/profileImages/test.jpg" alt="" style="height: 25px;;">  <?=$currentuser ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="index.php?controller=user&action=showUserFriends"><i class="fa fa-user fa-fw"></i>  <?= i18n("Friends") ?>  </a></li>
              <li><a href="index.php?controller=user&action=showUserGroups"><i class="fa fa-group fa-fw"></i>  <?= i18n("Groups") ?></a></li>
              <li><a href="index.php?controller=user&action=showUserEvents"><i class="fa fa-calendar fa-fw"></i>  <?= i18n("Events") ?></a></li>
              <li><a href="index.php?controller=user&action=showUserConversations"><i class="fa fa-envelope fa-fw"></i>  <?= i18n("Conversation") ?>  </a></li>

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
        <button type="submit" class="btn btn-default"><?= i18n("Search") ?></button>
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
	<script src="js/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>
