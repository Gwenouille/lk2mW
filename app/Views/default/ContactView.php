<?php $this->layout('layout', ['title' => 'Accueil',
'link1'=>'',
'link2'=>'',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>
<main class="main">

</main>
<div class="partenaires">
  <img src="<?= $this->assetUrl('logos/partenaires/europe.png');?>" alt="logo de l'Europe">
  <img src="<?= $this->assetUrl('logos/partenaires/normandie.jpg');?>" alt="logo de la région Normandie">
  <img src="<?= $this->assetUrl('logos/partenaires/dieppe.png');?>" alt="logo de Dieppe Maritime">
  <img src="<?= $this->assetUrl('logos/partenaires/pdtc.jpg');?>" alt="logo de Pays Dieppois Terroir de Caux">
  <img src="<?= $this->assetUrl('logos/partenaires/CCISMN');?>" alt="logo de la CCI SEINE MER NORMANDIE">
  <img src="<?= $this->assetUrl('logos/partenaires/cmasm.gif');?>" alt="logo de la Chambre des métiers et de l'Artisanat">
  <img src="<?= $this->assetUrl('logos/partenaires/SME.jpg');?>" alt="logo de Seine-Maritime Expansion">
  <img src="<?= $this->assetUrl('logos/partenaires/ADNormandie.jpg');?>" alt="logo de l'Agence de Développement Normandie">
</div>

<?php $this->stop('main_content') ?>
