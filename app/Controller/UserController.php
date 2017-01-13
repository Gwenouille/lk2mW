<?php
namespace Controller;

use \W\Controller\Controller;
// appeler notre model que l'on a creer
use Model\UserModel;
use \W\Model\ConnectionModel;


class UserController extends \W\Controller\Controller
{
    public function inscriptionUser() {

      $this -> show ('user/UserView');
      
    }

  }
