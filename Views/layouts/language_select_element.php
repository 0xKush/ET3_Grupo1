<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
  <?= i18n("Language") ?> <span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu">
  <li><a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a></li>
  <li><a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a></li>
  <li><a href="index.php?controller=language&amp;action=change&amp;lang=gal"><?= i18n("Galician") ?></a></li>
</ul>
</div>