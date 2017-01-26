<?php $this->layout('layout', ['title' => 'Accueil',
'link1'=>'',
'link2'=>'',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]) ?>

<!-- CSS -->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/master.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

		<main class="main-content">
			<div class="contact">
				<section class="dmi-contact">
					<div class="">
						<h4 style="font-weight:bold;">DMI DIGITAL MANUFACTURE INNOVATION</h4>
						6-10 rue Verdier Monetti <br>
						76880 Arques-la-Bataille <br>
						Tél : 06 25 75 02 26
					</div>
				</section>
				<br>
			<section class="ludo-contact">
				<div class="ludo-role">
					<h4 style="font-weight:bold;">Ludovic Lepetit </h4>
						Responsable du Service Developpement Economique <br> de la  Communauté d'agglomération de la Région Dieppoise :
				</div>

				<div class="ludo-contact-adress">
					<img src="<?= $this->assetUrl('logos/logo-mail.png');?>" alt=""> Ludovic.lepetit@agglodieppe-maritime.com
				 	<br>
					<img src="<?= $this->assetUrl('logos/logoFB.png');?>" alt=""> <a href="#">Ludovic Lepetit - Pro</a></span>
					</div>
			</section>
			<br>
			<section class="pierre-contact">
					<div class="pierre-role">
						<h4 style="font-weight:bold;">Pierre Veron </h4>
							Responsable du pôle Fabrication Additive
					</div>
					<div class="pierre-contact-adress">
						<img src="<?= $this->assetUrl('logos/logo-mail.png');?>" alt=""> PV@FakeAdress.com
						<br>
						<img src="<?= $this->assetUrl('logos/logoFB.png');?>" alt=""> 	<a href="#">Pierre Veron - Pro</a></span>
						</div>
					</section>


					</div>
			<div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3057.3786161785265!2d1.1353949571247612!3d49.88117739354171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDnCsDUyJzUxLjciTiAxwrAwOCcxMi45IkU!5e0!3m2!1sfr!2sfr!4v1485359442721" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
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
