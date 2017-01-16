<?php $this->layout('layout', ['title' => 'Utilisateur','displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<?php if(!$_SESSION) {

  if(!$confirm) { ?>

  <main class="main-login">

<!--formulaire d'inscription du user -->

<div class="main-login_connexion">
  <form class="form-inscription" method="post">

    <h3 class="form_section center">S'incrire</h3>
    <?php if($error && isset($_POST['inscription'])) { ?>
      <p>Ce compte existe déjà !</p>
    <?php } ?>
    <span class="asterix obligatoire center">* Champs Obligatoires</span>

    <label for="lastname">Votre Nom<span class="asterix">*</span> : </label>
    <input type="text" name="lastname" placeholder="Nom" required="">

    <label for="firstname">Votre Prénom<span class="asterix">*</span> : </label>
    <input type="text" name="firstname" placeholder="Prénom" required="">

    <label for="email">Votre E-mail<span class="asterix">*</span> : </label>
    <input type="email" name="email" placeholder="E-Mail" required="">

    <label for="password">Votre Mot de passe<span class="asterix">*</span> : </label>
    <input type="password" name="password" placeholder="Mot De Passe" required="">

    <label for="numTel">Votre Numéro de Téléphone : </label>
    <input type="text" name="numTel" placeholder="Téléphone (Optionnel)">

    <input class="input-submit" type="submit" name="inscription" value="Inscription">

  </form>
</div>
  <div class="main-login_inscription">
  <!--formulaire de login du user -->
  <form class="form-connexion" method="post">
      <h3 class="form_section center">Se connecter</h3>

      <label for="e-mail">
        Votre E-mail : </label>
      <input type="text" name="e-mail" placeholder="E-Mail">

      <label for="password">Votre Mot de passe : </label>
      <input type="text" name="password" placeholder="Mot De Passe">

      <input class="input-submit" type="submit" name="connexion" value="Se Connecter">

      <span><a href="#">Mot de passe oublié ?</a></span>
    </form>
  </div>
  </main>

<?php } else { ?>
  <p>Bravo, vous venez de vous inscrire.</p>
  <?php }
} else {
    echo "Retour à la page DMI";
} ?>

<?php $this->stop('main_content') ?>
