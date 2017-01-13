<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

		<main class="main">

			<p class="center">DMI (Digital Manufacture et Innovation) est un lieu dédié &agrave; l'innovation, &agrave; la création et au développement des entreprises, aux projets individuelset colaboratifs associant entreprises, écoles et laboratoires régionaux.</p>
			<p class="center">Ce lieu, unique en territoire dieppois regroupe 5 p&ocirc;les d'activités :</p>

			<div class="star_wrapper">
				<div class="logo">
					<a class="periph location" href="<?= $this->url("nav_linkNav", ["target" => "location_de_bureaux"]); ?>">Location de bureaux</a>
					<a class="periph coworking" href="<?= $this->url("nav_linkNav", ["target" => "coworking"]); ?>">Coworking</a>
					<a class="periph fabrication" href="<?= $this->url("nav_linkNav", ["target" => "fabrication_additive"]); ?>.php">Fabrication additive</a>
					<a class="periph creation" href="<?= $this->url("nav_linkNav", ["target" => "creation_d_entreprises"]); ?>">Création d'entreprises</a>
					<a class="periph formation" href="<?= $this->url("nav_linkNav", ["target" => "espace_formation"]); ?>">Espace formation</a>
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
