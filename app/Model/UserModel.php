<?php

namespace Model;

use \W\Model\UsersModel;
use \W\Model\ConnectionModel;
use \W\Security\AuthentificationModel;

class UserModel extends UsersModel {

  public function inscription()
  {
    $mdp = new AuthentificationModel();

    $userData = array(
      "lastname" => $_POST['lastname'],
      "firstname" => $_POST['firstname'],
      "mail" => $_POST['email'],
      "password" => $mdp->hashPassword($_POST['password']),
      "phone" => $_POST['numTel']
    );
    return $userData;
  }
}
