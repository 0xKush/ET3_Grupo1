<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>

<div class="container">
		<div style="margin-bottom: 10px; text-shadow: 3px 3px 3px #aaa;" class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<font face="Lobster" color="white" size="30">
					<?= i18n("Wlcome to") ?> Caralibro!
				</font>
			</div>
		</div>

		
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link"><?= i18n("Login") ?></a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link"><?= i18n("Register") ?></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="index.php?controller=user&action=login" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="user" id="user" tabindex="1" required class="form-control" placeholder="<?= i18n("Username") ?>" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" required class="form-control" placeholder="<?= i18n("Password") ?>">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="<?= i18n("Log In") ?>">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="index.php?controller=user&action=register" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input required type="text" name="user" id="user" tabindex="1" class="form-control" placeholder="<?= i18n("Username") ?>" value="">
									</div>
									<div class="form-group">
										<input required type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="<?= i18n("Email Adress") ?>" value="">
									</div>
									<div class="form-group">
										<input required type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="<?= i18n("Password") ?>">
									</div>
									<div class="form-group">
										<input required type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="<?= i18n("Confirm Password") ?>">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="<?= i18n("Register") ?> <?= i18n("now") ?>">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="pull-right" style="padding-right: 10px">
				    <?php include(__DIR__."/../layouts/language_select_element.php"); ?>
				</div>
			</div>
		</div>
	</div>
