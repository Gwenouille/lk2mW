<?php $this->layout('layout', ['title' => 'Mon espace',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]); ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/UserView.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content'); ?>

<!--navigation  choix de l'user-->
<div class="userChoice">
	<a class="userChoice_icons" href="<?= $this->url("user_home"); ?>"><span class="glyphicon glyphicon-user"></span>MON&nbsp;COMPTE</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("projects_home"); ?>"><span class="glyphicon glyphicon-list-alt"></span>PROJETS</a>&nbsp;&nbsp;
	<a class="userChoice_icons" href="<?= $this->url("news_edit"); ?>"><span class="glyphicon glyphicon-globe"></span>NEWS</a>
</div>

<?php $this->stop('main_content') ?>
