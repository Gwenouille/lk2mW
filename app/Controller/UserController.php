<?php
namespace Controller;

use \W\Controller\Controller;
use Model\UserModel;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class UserController extends Controller
{
  public function inscriptionUser() {
    
    $userLog = new AuthentificationModel();

    // l'utilisateur est connecté ?
    if(!is_null($userLog ->getLoggedUser())) { $connection = true; }
    else { $connection = false; }
    
    // Un post du formulaire d'inscription est soumis ?
    if(!empty($_POST) && $_POST['form_name'] === 'form_inscription') { $submitForm = true; }
    else { $submitForm = false; }

    // on arrive sur la page et un formulaire d'inscription est soumis
    if(!$connection && $submitForm) {
      // Variables qui indiquent si les champs sont bien remplis / si l'adresse mail existe en BDD / si l'inscription est effectuée
      $errorChamp = true;
      $mailExist = true;
      $inscriptionConfirm = false;
      // Vérifie si les champs sont remplis
      if(!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // les champs sont bien remplis
        $errorChamp = false;

        // Vérifie si l'adresse mail indiquée est déjà existante
        $testmail = new UsersModel();
        if (!$testmail -> emailExists($_POST['email'])) {
          // l'email n'est pas déjà enregistré en BDD
          $mailExist = false;

          // inscription des données en BDD
          $user = new UserModel();
          $userData = $user -> inscription();
          $flag = $user -> insert($userData, true);
          // Confirmation de la création en bdd de l'Utilisateur

          if($flag) {
            $inscriptionConfirm = true;
          }
        }
      }
    }

    if(!$connection && !$submitForm) { $this -> show ('user/InscriptionView'); }
    elseif(!$connection && $submitForm) { $this -> show ('user/InscriptionView', ["formAction" =>"inscription","inscriptionConfirm" => $inscriptionConfirm, "inscriptionError" => $errorChamp,"inscriptionMailExist" => $mailExist]); }
    else { $this -> show ('user/UserView',['connectLinkChoice' => true]); }
  }

  public function myaccount()
  {
     $userLog = new AuthentificationModel();
    // l'utilisateur est connecté ?
    if(!is_null($userLog ->getLoggedUser())) { $connection = true; }
    else { $connection = false; }
    if($connection) {
      $this -> show ('user/UserView',['connectLinkChoice' => true]);
    } else {
      $this -> show ('user/InscriptionView');
    }
  }

}
