<?php
require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../Models/USER_Model.php");
require_once(__DIR__."/../../Models/MESSAGE_Model.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$conversation = $view->getVariable("conversation");
$currentuserid = $view->getVariable("currentuserid");

$mmapper = new MESSAGE_Model();
$umapper = new USER_Model();

$messages = $mmapper->showall($conversation->getID());
?>

<?= isset($errors["general"])?$errors["general"]:"" ?> 
<?php $view->moveToDefaultFragment(); ?>

<?php print_r($errors) ?>

<?php if ($umapper->showcurrent($conversation->getMember())->getID() == $currentuserid): ?>
	<?php $receiver = $umapper->showcurrent($conversation->getSecondaryMember())?>
<?php else: ?>
	<?php $receiver = $umapper->showcurrent($conversation->getMember())?>
<?php endif ?>

					<div class="panel">
						<div class="panel-heading text-center" style="font-size: 35px">
							<?= i18n("Chat with") ?>: <font class="user">@<?=$receiver->getUser() ?></font>
						</div>
						<div class="panel-body" id="panel-body">
						        <?php $messages = $mmapper->showall($conversation->getID()); ?>
							<?php foreach ($messages as $msg): ?>
								<?php if ($msg->getOwner() == $currentuserid): ?>
										<div class="col-xs-10 col-xs-offset-2">
											<div class="panel">
												<div class="panel-body sent">
									<?php else: ?>
										<div class="col-xs-10">
											<div class="panel">
												<div class="panel-body received">
									<?php endif ?>
								

									
												<div class="col-xs-10">
													<?=$msg->getContent() ?>
												</div>
												<div class="col-xs-2">
													<font class="user"><?=$msg->getSendHour() ?></font>
												</div>

												</div>
											</div>
										</div>
								
							<?php endforeach ?>
						</div>

						<div class="panel-footer">
							<form action="index.php?controller=message&action=add" method="post">
								<div class="row">
									<div class="col-md-6 pull-right">
										<div class="input-group">

										<input hidden type="text" name="conversation" value="<?= $conversation->getID() ?>">
										<input hidden type="text" name="senddate" value="<?= date('Y-m-d') ?>">
										<input hidden type="text" name="sendhour" value="<?= date('h:i:s') ?>">
										<input hidden type="text" name="owner" value="<?=$currentuserid ?>">
										<input hidden type="text" name="status" value="0">

								    	<input autofocus="" type="textarea" class="form-control" name="content">
								      <span class="input-group-btn">
								        <button class="btn btn-success" type="submit" name="submit">
								        	<i class="fa fa-send"></i>
								        </button>
								      </span>
								      
								    </div>
									</div>
								   
								 </div>
							</form>
						</div>
					</div>
