<?php $this->layout('layout', ['title' => 'Utilisateur','displayConnectLink' =>$connectLinkChoice]); ?>

<?php $this->start('main_content'); ?>

<?php if(!isset($successSignIn) || !isset($successSignIn) || isset($errorSignIn) || isset($errorLogin)) { ?>
<main class="main-login">
  <!--formulaire d'inscription du user -->
  <div class="main-login_inscription">
    <form class="form-inscription" method="post" action="<?= $this->url("user_signin"); ?>">
      <h3 class="form_section center">S'incrire</h3>
      <!-- Erreurs dans les données inscrites dans les champs -->
      <?php if(isset($errorSignIn)) {
        echo ($errorSignIn);
      } ?>

      <span class="asterix obligatoire center">* Champs Obligatoires</span>

      <label for="lastname">Votre Nom<span class="asterix">*</span> : </label>
      <input type="text" name="lastname" placeholder="Nom" required>

      <label for="firstname">Votre Prénom<span class="asterix">*</span> : </label>
      <input type="text" name="firstname" placeholder="Prénom" required>

      <label for="email">Votre E-mail<span class="asterix">*</span> : </label>
      <input type="email" name="email" placeholder="E-Mail" required>

      <label for="password">Votre Mot de passe<span class="asterix">*</span> : </label>
      <input type="password" name="password" placeholder="Mot De Passe" required>

      <label for="numTel">Votre Numéro de Téléphone : </label>
      <input type="text" name="numTel" placeholder="Téléphone (Optionnel)">

      <input type="hidden" name="form_name" value="signIn">
      <input class="input-submit" type="submit" name="inscription" value="Inscription">
    </form>
  </div>

  <!--formulaire de login du user -->
  <div class="main-login_connexion">
    <form class="form-connexion" method="post" action="<?= $this->url("user_login"); ?>">
      <h3 class="form_section center">Se connecter</h3>
      <?php if(isset($errorLogin)) {
        echo ($errorLogin);
      } ?>
      <label for="e-mail">Votre E-mail : </label>
      <input type="email" name="e_mail" placeholder="E-Mail" required>
      <label for="password">Votre Mot de passe : </label>
      <input type="password" name="password" placeholder="Mot De Passe" required>
      <input type="hidden" name="form_name" value="connection">
      <input class="input-submit" type="submit" name="connexion" value="Se connecter">
      <span><a href="#">Mot de passe oublié ?</a></span>
    </form>
  </div>
</main>
<?php
} else { ?>
    <p>Votre compte vient d'être créé.</p>
    <p> Veuillez activer votre compte en validant le lien envoyé à l'adresse mail que vous  avez indiquée.</p>
    <p><a href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>">Fabrication additive</a></p>

<?php }
 ?>
<?php $this->stop('main_content') ?>
