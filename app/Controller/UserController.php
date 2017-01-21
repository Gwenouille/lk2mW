<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\UserModel;

class UserController extends Controller
{

	public function login()
	{
    $userLog = new AuthentificationModel();

    // si utilisateur connecté, redirige vers la page utilisateur
    if(!is_null($userLog ->getLoggedUser())) { $this->redirectToRoute('user_home'); }
    // Pas de post ou un post mais pas du formulaire "connexion" donc affichage de la page par défaut du login
    else if(!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'connection')) { $this->show("user/SignInView"); }
    // utilisateur non connecté et un post du formulaire de connexion
    else {
        // prépare et envoie les données au modèle pour vérification
        $userData = array(
            "mail" => htmlentities($_POST['e_mail']),
            "password" => htmlentities($_POST['password']),
        );

        $userLog = new UserModel();
        $errors = $userLog -> login($userData);

        // pas d'erreur lors de la connexion donc rennvoi vers la page utilisateur
        if(is_null($errors)) { $this->redirectToRoute('user_home'); }
        // retourne les erreurs à la page par défaut de la connexion
        else { $this->show("user/SignInView",['errorLogin'=>$errors]); }
    }
	}

	public function logout()
	{
    $userLog = new AuthentificationModel();

    // l'utilisateur est connecté
    if(!is_null($userLog ->getLoggedUser())) {
        $userLog->logUserOut();
        $this->show("user/SignInView",["deconnection" => true]);
    } else {
        $this->redirectToRoute('user_login');
    }
  }

  public function signIn()
  {
    $userLog = new AuthentificationModel();

    // si utilisateur connecté, redirige vers la page utilisateur
    if(!is_null($userLog ->getLoggedUser())) { $this->redirectToRoute('user_home'); }
    // Pas de post ou un post mais pas du formulaire "inscription" donc affichage de la page par défaut de l'inscription
    else if (!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'signIn')) { $this->show("user/SignInView"); }
    else {
        // prépare et envoie les données au modèle pour vérification
        $userData = array(
            "lastname" => htmlentities($_POST['lastname']),
            "firstname" => htmlentities($_POST['firstname']),
            "mail" => htmlentities($_POST['email']),
            "password" => htmlentities($_POST['password']),
            "phone" => htmlentities($_POST['numTel']),
        );

        $userLog = new UserModel();
        $errors = $userLog -> signIn($userData);
        // pas d'erreur lors de l'inscription donc renvoi vers la view d'inscription avec la donnée de réussite d'inscription
        if(is_null($errors)) { $this->show("user/SignInView",['successSignIn'=>true]); }
        // Erreur lors de l'inscription donc rennvoi vers la view d'inscription avec la donnée des erreurs
        else { $this -> show("user/SignInView",['errorSignIn'=>$errors]); }
    }
  }

  public function home()
  {
    // cette page est accessible si on est membre, admin ou superadmin
    $this-> AllowTo(['1','2','3']);

    $userGrant = new AuthorizationModel();
    if($userGrant->isGranted('1') || $userGrant->isGranted('2')) { // l'utilisateur connecté est un (super-)administrateur donc redirige vers la view admin
       $this->show("user/AdminView",['connectLinkChoice' => true]);
    } else {    // l'utilisateur connecté est un simple membre donc redirige vers la view utilisateur simple
       $this->show("user/UserView",['connectLinkChoice' => true]);
    }
  }
}
