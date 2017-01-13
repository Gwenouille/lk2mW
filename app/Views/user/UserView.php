<?php $this->layout('layout', ['title' => 'Utilisateur']) ?>

<?php $this->start('main_content') ?>

<!--formulaire d'inscription du user -->
<main class="main-login">

<form class="form-connexion" action="index.html" method="post">
    <h3>Se Connecter</h3>
    <br>
    <label for="e-mail">
      Votre E-mail : </label>
      <input type="text" name="e-mail" placeholder="E-Mail">
      <br>
    <label for="password">Votre Mot de passe : </label>
    <input type="text" name="password" placeholder="Mot De Passe">
    <br>
    <input class="input-submit" type="submit" name="connexion" value="Se Connecter">
    <br>
    <span><a href="#">Mot de passe oublié ?</a></span>
  </form>


  <form class="form-inscription" action="index.html" method="post">
    <h3>S'incrire</h3>
    <span class="asterix obligatoire">* Champs Obligatoires</span>
    <br>
    <label for="lastname">
      Votre Nom<span class="asterix">*</span> : </label>
      <input type="text" name="lastname" placeholder="Nom" required="">
    <label for="firstname">
      Votre Prénom<span class="asterix">*</span> : </label>
      <input type="text" name="firstname" placeholder="Prénom" required="">
    <label for="e-mail">
      Votre E-mail<span class="asterix">*</span> : </label>
      <input type="text" name="e-mail" placeholder="E-Mail" required="">

    <label for="password">Votre Mot de passe<span class="asterix">*</span> : </label>
    <input type="text" name="password" placeholder="Mot De Passe" required="">
    <label for="password">Votre Numéro de Téléphone : </label>
    <input type="text" name="password" placeholder="Téléphone (Optionnel)">
    <br>
    <input class="input-submit" type="submit" name="inscription" value="Inscrpition">


  </form>
</main>


 <?php $this->stop('main_content') ?>
