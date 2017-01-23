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

<!--navigation  ckeckbox admin-->
<div>
<label>
  <input type="checkbox" id="cbox1" value="checkbox1">
  MON COMPTE
</label>
<label>
  <p>
		<a href="<?= $this->url("news_edit") ?>">NEWS</a>
	</p>
  </label>
<label>
  <input type="checkbox" id="cbox2" value="checkbox2">
  UTILISATEURS
</label>
</div>
<?php $this->stop('main_content') ?>
