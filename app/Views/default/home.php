
<?php $this->layout('layout', ['title' => 'Accueil','displayConnectLink' =>$connectLinkChoice]) ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/header_footer_index.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content') ?>

		<main class="main">

			<h3><p class="center">DMI (Digital Manufacture et Innovation) est un lieu dédié &agrave; l'innovation, &agrave; la création et au développement des entreprises, aux projets individuels et colaboratifs associant entreprises, écoles et laboratoires régionaux.</p>
			<p class="center">Ce lieu, unique en territoire dieppois regroupe 5 p&ocirc;les d'activités.</p></h3>

			<div class="star_wrapper">
				<div class="logo">
					<a class="periph location" href="<?= $this->url("default_nav", ["target" => "location_de_bureaux"]); ?>"><h3>Location de bureaux</h3></a>
					<a class="periph coworking" href="<?= $this->url("default_nav", ["target" => "coworking"]); ?>"><h3>Coworking</h3></a>
					<a class="periph fabrication" href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>"><h3>Fabrication additive</h3></a>
					<a class="periph creation" href="<?= $this->url("default_nav", ["target" => "creation_d_entreprises"]); ?>"><h3>Création d'entreprises</h3></a>
					<a class="periph formation" href="<?= $this->url("default_nav", ["target" => "espace_formation"]); ?>"><h3>Espace formation</h3></a>
				</div>
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
