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

<div class="userContent">
	<!--navigation  choix de l'user-->
	<div class="userChoice">
	<a href="<?= $this->url("user_home"); ?>"><span class="glyphicon glyphicon-user"></span>MON COMPTE</a>&nbsp;&nbsp;
	<a href="<?= $this->url("projects_home"); ?>"><span class="glyphicon glyphicon-list-alt"></span>MES PROJETS</a>
	</div>

	<?php if (isset($errorModifyCoordinates)){
		$feedback='Problème lors de la mise à jour de vos coordonnées. Veuillez réessayer.';
	} else {
		$feedback='';
	}?>

	<!--Formulaire compte utilisateur  -->
	<div class="main-login_connexion">
		<form class="form-inscription" method="post" action="<?= $this->url("user_modifyCoordinates"); ?>">
		 	<h3 class="form_section center">Mes données utilisateur</h3>

			<span class="asterix obligatoire center">* Champs Obligatoires</span>

			<label for="lastname">Votre Nom<span class="asterix">*</span> : </label>
			<input type="text" name="lastname" placeholder="Nom" value="<?= $_SESSION['user']['lastname']?>" required>

			<label for="firstname">Votre Prénom<span class="asterix">*</span> : </label>
			<input type="text" name="firstname" placeholder="Prénom" value="<?= $_SESSION['user']['firstname']?>" required>

			<label for="email">Votre E-mail<span class="asterix">*</span> : </label>
			<input type="email" name="email" placeholder="E-Mail" value="<?= $_SESSION['user']['mail']?>" required>

			<label for="numTel">Votre Numéro de Téléphone : </label>
			<input type="text" name="numTel" placeholder="Téléphone (Optionnel)" value="<?= $_SESSION['user']['phone']?>">

			<input type="hidden" name="form_name" value="modifyCoordinates">
			<input class="input-submit" type="submit" name="inscription" value="Modifier">

			<p class="center">
				<?=$feedback?>
			</p>
		</form>
	</div>
</div>

<?php $this->stop('main_content') ?>
