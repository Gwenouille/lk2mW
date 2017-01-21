<?php $this->layout('layout', ['title' => 'Mon espace','displayConnectLink' =>$connectLinkChoice]); ?>

<!-- Ajoute un css pour cette page seulement, pour corriger l'affichage de la nav -->
<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/UserView.css') ?>">
<?php $this->stop('css') ?>

<?php $this->start('main_content'); ?>

<!--navigation ckeckbox user-->
<div class="userCheckbox">
	<!-- POURQUOI DES INPUT ? -->
<!-- <label>
  <input type="checkbox" id="cbox1" value="checkbox1">
  MON COMPTE
</label>
<label>
  <input type="checkbox" id="cbox2" value="checkbox2">
  MES PROJETS
</label> -->
<a href="<?= $this->url("user_home"); ?>">MON COMPTE</a>
<a href="<?= $this->url("projects_home"); ?>">MES PROJETS</a>
</div>

<!--Formulaire compte utilisateur  -->
<div class="main-login_connexion">
	<form class="form-inscription" method="post" action="<?= $this->url("user_signin"); ?>">
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
	</form>
</div>

<!-- COMMENTÉ CAR PAS A SA PLACE ? -->
<!--bloc des projets utilisateurs  -->
	<!-- <div>
	<h3>Mes projets</h3>
			<button type="button" name="createProject">Créer un projet</button>
			<button type="button" name="openProject">Ouvrir un projet</button>
</div> -->




<?php $this->stop('main_content') ?>
