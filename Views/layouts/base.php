<?php

require_once(__DIR__ . "/../../core/ViewManager.php");
require_once(__DIR__ . "/../../Models/USER_Model.php");
$view        = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$userid = $view->getVariable("currentuserid");
$umapper = new USER_Model();
$photo = $umapper->showcurrent($userid)->getPhoto();


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

    <!-- includes for datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- body font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="lib/datatables-responsive/dataTables.responsive.js"></script>

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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <?php if ($photo != NULL): ?>
            <img class="img-circle profileThumbnail" src="media/profileImages/<?=$photo ?>" alt=""> 
          <?php else:  ?>
            <img class="img-circle profileThumbnail" src="media/profileImages/default.png" alt="">
          <?php endif ?>

           <?=$currentuser ?>
          

          <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="index.php?controller=friendship&action=showall&id=<?=$userid ?>"><i class="fa fa-user fa-fw"></i>  <?= i18n("Friends") ?></a></li>
              <li><a href="index.php?controller=usergroup&action=showall&id=<?= $userid ?>"><i class="fa fa-group fa-fw"></i>  <?= i18n("Groups") ?></a></li>
              <li><a href="index.php?controller=guest&action=showall&id=<?= $userid ?>"><i class="fa fa-calendar fa-fw"></i>  <?= i18n("Events") ?></a></li>
              <li><a href="index.php?controller=conversation&action=showall"><i class="fa fa-envelope fa-fw"></i>  <?= i18n("Conversation") ?>  </a></li>
              
              <?php if (true): ?>
                  <li role="separator" class="divider"></li>
                    <li>
                    <a href="index.php?controller=user&action=admin"><i class="fa fa-cog fa-fw"></i>  <?= i18n("Admin Zone") ?></a>
                    </li>
              <?php endif ?>
              

              <li role="separator" class="divider"></li>
              <li><a href="index.php?controller=user&action=logout"><i class="fa fa-sign-out" style="color: blue;"></i>  <?= i18n("Logout") ?></a></li>
          </ul>
        </li>
        <li><li><a href="index.php?controller=user&action=showcurrent&id=<?= $userid ?>"><?= i18n("My Profile") ?></a></li></li>
      </ul>
        <li><a href="index.php?controller=publication&action=showall&id=<?= $userid ?>&type=user"><?= i18n("Publications") ?></a></li>

      </ul>
      <ul class="navbar-form navbar-right">
        <div class="form-group">
        </div>
        <a href="index.php?controller=user&action=search">
          <button type="submit" class="btn btn-primary"><?= i18n("Search") ?>
            
          </button>
        </a>
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

	    <div class="col-xs-12 col-md-8 col-md-offset-2" >
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

    

    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>    
    <script src="js/datepicker/datepicker_scripts.js"></script>
    <!-- DataTables JavaScript -->
    


    </body>
</html>
