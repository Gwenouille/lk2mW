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
	<!-- <title><?php echo $title; ?></title> -->

	<title><?= $this->e($title) ?></title>
</head>
<body>
	<div class="page container">
		<header>
			<div class="logo_container">
				<a href="/lk2m/index.php">
					<img src="/lk2m/assets/logos/logoFerme.png" alt="page accueil">
				</a>
			</div>
			<div class="title"><h1>Digital Manufacture<br>INNOVATION</h1></div>
			<div class="connection">
			<h3>Dieppe - Normandie</h3>
			<h3><a href="login_membre.php">Se connecter</a></h3>
			</div>
		</header>

		<nav>
			<div class='nav-container'>
					<ul>
						<li><a class="nav" href="/lk2m/pages/fabrication_additive.php">Fabrication additive</a></li>
						<li><a class="nav" href="/lk2m/pages/creation_d_entreprises.php">Création d'entreprises</a></li>
						<li><a class="nav" href="/lk2m/pages/espace_formation.php">Espace formation</a></li>
						<li><a class="nav" href="/lk2m/pages/coworking.php">Coworking</a></li>
						<li><a class="nav" href="/lk2m/pages/location_de_bureaux.php">Location de bureaux</a></li>
					</ul>
			</div>
		</nav>

		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>
</body>
</html>
