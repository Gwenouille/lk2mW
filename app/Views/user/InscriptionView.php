<?php $this->layout('layout', ['title' => 'Utilisateur','displayConnectLink' =>$connectLinkChoice]); ?>

<?php $this->start('main_content'); ?>

<?php 
// Affichage du formulaire si (pas de post ni de deconnexion)  ou (un post mais inscription non réalisée) ou (un post mais connexion non réalisée)
if((!isset($formAction) && !isset($deconnexion)) || (isset($formAction) && isset($inscriptionConfirm) && !$inscriptionConfirm) || (isset($formAction) && isset($connectionSuccess) && !$connectionSuccess)) {
?>
<main class="main-login">

  <!--formulaire d'inscription du user -->
  <div class="main-login_connexion">
    <form class="form-inscription" method="post" action="<?= $this->url("user_inscriptionUser"); ?>">
      <h3 class="form_section center">S'incrire</h3>
      <!-- Erreurs dans les données inscrites dans les champs -->
      <?php
        // si un post inscription est présent
        if(isset($formAction) && $formAction==="inscription" ) {
          if($inscriptionError) { ?>
              <p>Vos champs n'ont pas été remplis correctement !</p>
            <?php
          } elseif($inscriptionMailExist) { ?>
              <p>Ce compte existe déjà !</p>
            <?php
          }
        }
      ?>
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

      <input type="hidden" name="form_name" value="form_inscription">
      <input class="input-submit" type="submit" name="inscription" value="Inscription">
    </form>
  </div>
  
  <div class="main-login_inscription">
    <!--formulaire de login du user -->
    <form class="form-connexion" method="post" action="<?= $this->url("userConnect_loginUser"); ?>">
      <h3 class="form_section center">Se connecter</h3>
      <?php
        // si un post de connexion est présent
        if(isset($formAction) && $formAction==="connexion") {
          if($connectionError) { ?>
            <p>Mauvais identifiants</p>
          <?php } elseif(!$activeSpace) { ?>
            <p>Erreur : Compte désactivé</p>
          <?php }
          }
      ?>
      <label for="e-mail">Votre E-mail : </label>
      <input type="email" name="e_mail" placeholder="E-Mail" required>
      <label for="password">Votre Mot de passe : </label>
      <input type="password" name="password" placeholder="Mot De Passe" required>
      <input type="hidden" name="form_name" value="form_connection">
      <input class="input-submit" type="submit" name="connexion" value="Se connecter">
      <span><a href="#">Mot de passe oublié ?</a></span>
    </form>
  </div>
</main>
<?php
} elseif (isset($formAction) && $formAction==="inscription") { ?>
    <p>Votre compte vient d'être créé.</p>
    <p> Veuillez activer votre compte en validant le lien envoyé à l'adresse mail que vous  avez indiquée.</p>
    <p><a href="<?= $this->url("nav_linkNav", ["target" => "fabrication_additive"]); ?>">Fabrication additive</a></p>
<?php
} elseif (isset($formAction) && $formAction==="connexion") {
?>
    <p>Vous êtes connecté.</p>
    <p><a href="<?= $this->url("user_myaccount",['connectLinkChoice' => true]); ?>">Mon espace</a></p>
<?php
} elseif(isset($deconnexion)) { // déconnexion de l'utilisateur ?>
    <p>Vous êtes déconnecté.</p>
    <p><a class="nav" href="<?= $this->url("nav_linkNav", ["target" => "fabrication_additive",'connectLinkChoice' => true]); ?>">Fabrication additive</a></p>
<?php
}
?>

<?php $this->stop('main_content') ?>
