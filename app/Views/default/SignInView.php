<?php $this->layout('layout', ['title' => 'Utilisateur',
'link1'=>'',
'link2'=>'link2',
'link3'=>'',
'link4'=>'',
'link5'=>'',
'displayConnectLink' =>$connectLinkChoice]); ?>

<?php $this->start('main_content'); ?>

<?php if(isset($deconnection) && $deconnection === true) { ?>
  <main class="main">
    <p class="big center">Vous êtes maintenant déconnecté.</p>
    <p class="center"><strong><a href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>">Retour à l'accueil</a></strong></p>
  </main>

<?php } else if(isset($successSignIn) && $successSignIn === true ) { ?>
  <main class="main">
    <p class="big center">Votre compte vient d'être créé.</p>
    <p class="big center"> Veuillez activer votre compte en validant le lien envoyé à l'adresse mail que vous avez indiquée.</p>
    <p class="center"><strong><a href="<?= $this->url("default_nav", ["target" => "fabrication_additive"]); ?>">Page d'accueil</a></strong></p>
  </main>

<?php } else { ?>

  <?php if (isset($validateSignIn)) {
    if ($validateSignIn==1){?>
      <p class="big center">Votre compte est activé. Vous pouvez désormais vous connecter.</p>
    <?php
  } else if ($validateSignIn==0){?>
      <p class="big center">Votre compte est déjà activé. Veuillez vous connecter.</p>
    <?php
  } else if ($validateSignIn==-1){?>
      <p class="big center">Votre compte n'a pas pu être activé.</p>
    <?php
    }
  }?>

  <main class="main-login">

    <!--formulaire d'inscription du user -->
    <div class="main-login_inscription">
      <form class="form-inscription" method="post" action="<?= $this->url("user_signin"); ?>">
        <h3 class="form_section center">S'inscrire</h3>
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

<?php } ?>

<?php $this->stop('main_content') ?>
