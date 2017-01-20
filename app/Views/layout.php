<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<!-- import de la police Rajdhani depuis google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/normalize.css') ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/localBootstrap.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/master.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/header_footer.css') ?>">
	<!-- PERMET D'AJOUTER DES CSS ICI -->
	<?= $this->section('css') ?>
	<title><?= $this->e($title) ?></title>
</head>
<body>
	<div class="page container">
		<header>
			<div class="logo_container">
				<a href="<?= $this->url("default_home"); ?>">
					<img src="<?= $this->assetUrl('logos/logoFerme.png');?>" alt="page accueil">
				</a>
			</div>
			<div class="title"><h1>Digital Manufacture<br>INNOVATION</h1></div>
			<div class="connection">
			<?php
			if (isset($displayConnectLink) && $displayConnectLink) {
			//Récupération d'une variable via la view, qui la tient du controlleur. Cette variable est un booleen qui controle l'affichage ou non des possibilités de connections dans le header (seulement pour la page fabrication additive)
				$linkConnect= '<a class="connectLink" href="'.$this->url("user_signin").'" tabindex=1>Se connecter/S\'inscrire</a>';
				$linkDeconnect = '<a class="connectLink" href="'.$this->url("user_logout").'" tabindex=1>> Se deconnecter</a>';
				$linkAccount = '<a class="connectLink" href="'.$this->url("user_account").'" tabindex=1>> Mon compte</a>';
				if(isset($_SESSION['user']) && !empty($_SESSION['user'])) $userAccount = $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];
				$connectLink= !empty($_SESSION['user']) ? '<p><h4>'.$userAccount."</h4></p>".$linkDeconnect.'<p>'.$linkAccount.'</p>':'<h3>Dieppe - Normandie</h3><p>'.$linkConnect.'</p>';
				echo ($connectLink);
			}
			?>
			</div>
		</header>

<?php echo $w_current_route; ?>

		<nav class='navigation'>
			<div class='nav-container'>
					<ul>
						<li><a class="nav" href="<?= $this->url("default_nav", ["target" => "creation_d_entreprises"]); ?>">Création d'entreprises</a></li>
						<li><a class="nav" href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>">Fabrication additive</a></li>
						<li><a class="nav" href="<?= $this->url("default_nav", ["target" => "espace_formation"]); ?>">Espace formation</a></li>
						<li><a class="nav" href="<?= $this->url("default_nav", ["target" => "coworking"]); ?>">Coworking</a></li>
						<li><a class="nav" href="<?= $this->url("default_nav", ["target" => "location_de_bureaux"]); ?>">Location de bureaux</a></li>
					</ul>
			</div>
		</nav>

		<section class="section">
			<?= $this->section('main_content') ?>
		</section>

		<footer>
			<p>&copy;LK2M - 2017</p>
			<address class="adresse">
				DMI Digital Manufacture et Innovation :
				6&#x2011;10&nbsp;Rue&nbsp;Verdier&nbsp;Monetti&nbsp;76880&nbsp;Arques&#x2011;la&#x2011;Bataille
			</address>
			<address class="adresse">
				Coordonnées GPS :
				49°52'51"&nbsp;Nord 1°08'13"&nbsp;Est
			</address>
		</footer>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
	<!-- PERMET D'AJOUTER DES JS ICI -->
	<?= $this->section('js') ?>

</body>
</html>
