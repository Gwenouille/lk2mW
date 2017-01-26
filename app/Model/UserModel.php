<?php

namespace Model;

use \W\Model\UsersModel;
use \W\Model\ConnectionModel;
use \W\Security\AuthentificationModel;


class UserModel extends UsersModel {

  /**
	 * Récupère tous les users dont le statut est confirmé.
	 */
	public function findAllConfirmedMembers()
	{
		$sql = 'SELECT * FROM ' . $this -> table;

		$sql .= ' WHERE state = 1 and roles_id = 3';

		$sth = $this -> dbh -> prepare($sql);
		$sth -> execute();

		return $sth -> fetchAll();
	}

  public function login(array $data) {

    // les champs sont remplis ?
    if(!empty($data['mail']) && !empty($data['password'])) {
      $userLog = new AuthentificationModel();
      // L'utilisateur existe en BDD
      if($userLog->isValidLoginInfo($data['mail'], $data['password']) != 0) {
        $userConnect = new UsersModel();
        $userData = $userConnect -> getUserByUsernameOrEmail($data['mail']);
        //si le compte est activé
        if($userData['state'] != 0) {
          $userLog -> logUserIn($userData);
          // vérifie que l'utilisateur a bien sa session
          if(is_null($userLog ->getLoggedUser())) {
            $errors = "Erreur de session !";
          }
        } else {
            $errors = "Compte désactivé !";
        }
      } else {
          $errors = "Mauvais identifiants !";
      }
    } else {
        $errors = "Champs mal renseignés !";
    }

    if(isset($errors)) return $errors;
    else return null;
  }



  public function signIn(array $data)
  {

    // Vérifie si les champs sont remplis
    if(!empty($data['lastname']) && !empty($data['firstname']) && !empty($data['mail']) && !empty($data['password'])) {

      $testmail = new UsersModel();
        // Vérifie si l'adresse mail indiquée est déjà existante
        if (!$testmail -> emailExists($data['mail'])) {

          // inscription des données en BDD
          $mdp = new AuthentificationModel();
          $data['password'] = $mdp->hashPassword($data['password']);

          $user = new UserModel();
          $flag = $user -> insert($data, true);
          if($flag === false) {
            $errors = "Echec de l'inscription !";
          }
        } else {
          $errors = "Compte existant !";
        }
    } else {
      $errors = "Champs mal renseignés !";
    }

    if(isset($errors)) return $errors;
    else return null;
  }
}
