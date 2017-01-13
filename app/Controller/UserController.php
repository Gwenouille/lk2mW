<?php
namespace Controller;

use \W\Controller\Controller;
use Model\UserModel;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;


class UserController extends \W\Controller\Controller
{
    public function inscriptionUser() {

// Variables qui précise si les champs sont bien remplis / si le mail existe / si l'inscription est effectuée
    $errorChamp = true;
    $emailExist = true;
    $inscriptionConfirm = false;

// Vérifie si les champs sont remplis
if(!empty($_POST['lastname']) && !empty($_POST['firstname'])&& !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['numTel'])) {

$errorChamp = false;
$testmail = new UsersModel();

// Vérifie si l'adresse mail indiquée est déjà existante
if ($testmail -> emailExist($_POST['email'])) {
  $emailExist = false;
  $user = new UserModel();
  $userDate = $user -> inscription();
// récupère la confirmation de la création en bdd de l'Utilisateur
$flag = $user -> insert($userData, true);
if($flag) {
  $inscriptionConfirm = true;
    }
  }
}
      $this -> show ('user/UserView', ["confirm" => $inscriptionConfirm, "error" => $errorChamp,"mail" => $emailExist]);
    }
  }
