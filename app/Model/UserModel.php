<?php

use \W\Model;
use \W\Model\ConnectionModel;
use \W\Security\AuthentificationModel;

class UserModel extends \W\Model\Model {

  public function inscription() {

      $mdp = new AuthentificationModel();

      $userData = array(
        "lastname" => $_POST['lastname'],
        "firstname" => $_POST['firstname'],
        "mail" => $_POST['email'],
        "password" => $_POST['password'],
        "phone" => $_POST['numTel']
      );

      return $userData;

  }
}
