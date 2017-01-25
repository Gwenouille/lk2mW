<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<!-- import de la police Rajdhani depuis google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/normalize.css') ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/local_bootstrap.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/master.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/header_footer.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/user_view.css') ?>">
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
			<div class="title">
				<h1>Digital Manufacture<br>INNOVATION</h1>
			</div>
			<div class="connection">
			<?php
			if (isset($displayConnectLink) && $displayConnectLink) {
			//Récupération d'une variable via la view, qui la tient du controlleur. Cette variable est un booleen qui controle l'affichage ou non des possibilités de connections dans le header (seulement pour la page fabrication additive)
				$linkConnect= '<a class="connectLink" href="'.$this->url("user_signin").'" tabindex=1>Se connecter/S\'inscrire</a>';
				$linkDeconnect = '<a class="connectLink" href="'.$this->url("user_logout").'" tabindex=1>> Se deconnecter</a>';
				$linkAccount = '<a class="connectLink" href="'.$this->url("user_home").'" tabindex=1>> Mon espace</a>';
				if(isset($_SESSION['user']) && !empty($_SESSION['user'])) $userAccount = $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];
				$connectLink= !empty($_SESSION['user']) ? '<h4>'.$userAccount.'</h4><p>'.$linkDeconnect.'</p><p>'.$linkAccount.'</p>':'<h3>Dieppe - Normandie</h3><p>'.$linkConnect.'</p>';
				echo ($connectLink);
			}
			?>
			</div>
		</header>

<?php echo $w_current_route; ?>

		<nav class='navigation'>
			<div class='nav-container'>
					<ul>
						<li><a class="nav <?=$link1?>" href="<?= $this->url("default_nav", ["target" => "creation_d_entreprises"]); ?>">Création d'entreprises</a></li>
						<li><a class="nav <?=$link2?>" href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>">Fabrication additive</a></li>
						<li><a class="nav <?=$link3?>" href="<?= $this->url("default_nav", ["target" => "espace_formation"]); ?>">Espace formation</a></li>
						<li><a class="nav <?=$link4?>" href="<?= $this->url("default_nav", ["target" => "coworking"]); ?>">Coworking</a></li>
						<li><a class="nav <?=$link5?>" href="<?= $this->url("default_nav", ["target" => "location_de_bureaux"]); ?>">Location de bureaux</a></li>
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
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- PERMET D'AJOUTER DES JS ICI -->
	<?= $this->section('js') ?>

</body>
</html>
