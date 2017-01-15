<?php $this->layout('layout', ['title' => 'Utilisateur','displayConnectLink' =>$connectLinkChoice]) ?>

<?php $this->start('main_content') ?>

<!-- si l'utilisateur n'est pas connecté -->
<?php

 if(!isset($_SESSION['user'])) {
  // (on est sur formulaire inscription et une erreur) OU (on est sur formulaire connexion et une erreur))
  if((isset($inscriptionConfirm) && !$inscriptionConfirm) || (isset($connectionSuccess) && !$connectionSuccess)) { ?>
    <main class="main-login">
      <!--formulaire d'inscription du user -->
      <form class="form-inscription" method="post">
        <h3 class="form_section center">S'incrire</h3>
        <!-- Erreurs dans les données inscrites dans les champs -->
        <?php 
          // si un post est présent et qu'il s'agit de l'inscription
          if($_POST && isset($formAction) && $formAction==="inscription" ) {
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

      <!--formulaire de login du user -->
      <form class="form-connexion" method="post" action="<?= $this->url("userConnect_loginUser") ?>">
        <h3 class="form_section center">Se connecter</h3>

        <?php

            // si un post est présent et qu'il s'agit de la connexion
            if($_POST && isset($formAction) && $formAction==="connexion") {
                  if($connectionError) { ?>
                    <p>Mauvais identifiants</p>
                  <?php 
                  } elseif(!$activeSpace) { ?>
                    <p>Erreur : Compte désactivé</p>
                  <?php
                  } 
            }
        ?>

        <label for="e-mail">Votre E-mail : </label>
        <input type="text" name="e_mail" placeholder="E-Mail" required>

        <label for="password">Votre Mot de passe : </label>
        <input type="password" name="password" placeholder="****" required>

        <input class="input-submit" type="submit" name="connexion" value="Se Connecter">

        <span><a href="#">Mot de passe oublié ?</a></span>
      </form>
    </main>

  <?php
  } elseif(isset($inscriptionConfirm) && $inscriptionConfirm) { 
    # inscription est effectuée  ?>
    <p>Votre compte vient d'être créé.</p>
    <p> Veuillez activer votre compte en validant le lien envoyé à l'adresse mail que vous avez indiquée.</p>
    <p><a href="<?= $this->url("nav_linkNav", ["target" => "fabrication_additive"]); ?>">Fabrication additive</a></p>
  <?php
  }
} else { # utilisateur est déjà connecté

    echo "Espace : ";
} ?>
<?php $this->stop('main_content') ?>
