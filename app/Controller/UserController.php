<?php
namespace Controller;

use \W\Controller\Controller;
use Model\UserModel;
use \W\Model\UsersModel;

class UserController extends Controller
{
  public function inscriptionUser() {
    // Variables qui indiquent si les champs sont bien remplis / si l'adresse mail existe en BDD / si l'inscription est effectuée
    $errorChamp = true;
    $mailExist = true;
    $inscriptionConfirm = false;
    // Vérifie si les champs sont remplis
    if(!empty($_POST['lastname']) && !empty($_POST['firstname'])&& !empty($_POST['email']) && !empty($_POST['password'])) {
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
    $this -> show ('user/UserView', ["formAction" =>"inscription","inscriptionConfirm" => $inscriptionConfirm, "inscriptionError" => $errorChamp,"inscriptionMailExist" => $mailExist]);
  }

  public function espaceMembre()
  {
    $this -> show ('user/UserView');
  }

}
