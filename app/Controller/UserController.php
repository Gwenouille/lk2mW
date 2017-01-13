<?php
namespace Controller;

use \W\Controller\Controller;
use Model\UserModel;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;


class UserController extends \W\Controller\Controller
{
    public function inscriptionUser() {

// Variables qui précisent si les champs sont bien remplis / si le mail existe / si l'inscription est effectuée

    $errorChamp = true;
    $emailExist = true;
    $inscriptionConfirm = false;

//


      $this -> show ('user/UserView');

    }

  }
