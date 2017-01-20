<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\UserModel;

class UserController extends Controller
{

	public function login()
	{

        $userLog = new AuthentificationModel();
        // si utilisateur connecté
        if(!is_null($userLog ->getLoggedUser())) { $this->show("user/UserView",['connectLinkChoice' => true]); }
        // si pas de post ou un post mais pas du formulaire connexion
        else if(!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'connection')) {
            $this->show("user/SignInView");
        }
        // utilisateur non connecté et un post du formulaire de connexion
        else {

            $userData = array(
                "mail" => htmlentities($_POST['e_mail']),
                "password" => htmlentities($_POST['password']),
            );

            $userLog = new UserModel();
            $errors = $userLog -> login($userData);
            if(is_null($errors)) { $this->show("user/SignInView",['successLogin'=>true]); }
            else {$this->show("user/SignInView",['errorLogin'=>$errors]); }
        }
	}

	public function logout()
	{
        $userLog = new AuthentificationModel();
        // l'utilisateur est connecté ?
        if(!is_null($userLog ->getLoggedUser())) {
           $userLog->logUserOut();
           $this->show("user/SignInView",['connectLinkChoice' => true,"deconnexion" => true]);
        } else {
            $this->show("DMIcontent/fabrication_additive",['connectLinkChoice' => true]);
        }
    } 

    public function signIn()
    {

        $userLog = new AuthentificationModel();

        // l'utilisateur est connecté ?
        if(!is_null($userLog ->getLoggedUser())) { $this->show("user/UserView",['connectLinkChoice' => true]); }
        else if (!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'signIn')) {
            $this->show("user/SignInView");
        } else {
            $userData = array(
                "lastname" => htmlentities($_POST['lastname']),
                "firstname" => htmlentities($_POST['firstname']),
                "mail" => htmlentities($_POST['email']),
                "password" => htmlentities($_POST['password']),
                "phone" => htmlentities($_POST['numTel']),
            );

            $userLog = new UserModel();
            $errors = $userLog -> signIn($userData);
            if(is_null($errors)) { $this->show("user/SignInView",['successSignIn'=>true]); }
            else { $this -> show("user/SignInView",['errorSignIn'=>$errors]); }
        }
    }
}