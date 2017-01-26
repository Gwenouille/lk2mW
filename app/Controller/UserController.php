<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\UserModel;
use Model\ProjectsModel;

class UserController extends Controller
{

	public function getProjectsFromUser($user_id=''){
		$user_id=$_POST['id'];
		$user_id=substr($_POST['id'],6,strlen($user_id)-6 );

		//Inscription en session de l'id du user avec lequel l'admin converse
		$_SESSION['to_user']=array('to_users_id'=>$user_id);

		//Récupération des projets à son actif
		$project = new ProjectsModel();
		$this->showJson(["projects" =>$project->findAllProjectsFromUser($user_id)]);
		// return ($project->findAllProjectsFromUser($user_id));
	}

	public function getMessagesFromUser($user_id=''){
		//Récupération des messages le concernant
		$message = new MessagesModel();
		return($message->search(array('users_id'=>$user_id, 'to_users_id'=>$user_id)));
	}

	// récupère la liste des utilisateurs
	public function showUsers() {
		unset($_SESSION['to_user']);

		// cette page est accessible si on est admin ou superadmin seulement.
		$this-> AllowTo(['1','2']);

		// Récupération de l'ID du user en session actuellement
		$user = new AuthentificationModel();
		$userId = $user -> getLoggedUser()['id'];

		// Récupération de l'article (content + images) à afficher
	  $usersList = new UserModel();
    $listUsers = $usersList -> findAllConfirmedMembers();

		// die(var_dump($listUsers));
		$this->show("admin/adminUsersView",['usersList'=>$listUsers,"connectLinkChoice" => true]);
	}

	public function login()
	{
    $userLog = new AuthentificationModel();

    // si utilisateur connecté, redirige vers la page utilisateur
    if(!is_null($userLog ->getLoggedUser())) { $this->redirectToRoute('user_home'); }
    // Pas de post ou un post mais pas du formulaire "connexion" donc affichage de la page par défaut du login
    else if(!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'connection')) { $this->show("default/SignInView"); }
    // utilisateur non connecté et un post du formulaire de connexion
    else {
        // prépare et envoie les données au modèle pour vérification
        $userData = array(
            "mail" => htmlentities($_POST['e_mail']),
            "password" => htmlentities($_POST['password']),
        );

        $userLog = new UserModel();
        $errors = $userLog -> login($userData);

        // pas d'erreur lors de la connexion donc renvoi vers la page utilisateur
        if(is_null($errors)) { $this->redirectToRoute('user_home'); }
        // retourne les erreurs à la page par défaut de la connexion
        else { $this->show("default/SignInView",['errorLogin'=>$errors]); }
    }
	}

	public function logout()
	{
    $userLog = new AuthentificationModel();

    // l'utilisateur est connecté
    if(!is_null($userLog ->getLoggedUser())) {
        $userLog->logUserOut();
        $this->show("default/SignInView",["deconnection" => true,"connectLinkChoice" => true]);
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
    else if (!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'signIn')) { $this->show("default/SignInView"); }
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
        if(is_null($errors)) { $this->show("default/SignInView",['successSignIn'=>true]); }
        // Erreur lors de l'inscription donc renvoi vers la view d'inscription avec la donnée des erreurs
        else { $this -> show("default/SignInView",['errorSignIn'=>$errors]); }
    }
  }

  public function home()
  {
    // cette page est accessible si on est membre, admin ou superadmin
    $this-> AllowTo(['1','2','3']);

    $userGrant = new AuthorizationModel();
    if($userGrant->isGranted('1') || $userGrant->isGranted('2')) { // l'utilisateur connecté est un (super-)administrateur donc redirige vers la view admin
       $this->show("admin/AdminView",['connectLinkChoice' => true]);
    } else {    // l'utilisateur connecté est un simple membre donc redirige vers la view utilisateur simple
       $this->show("user/UserView",['connectLinkChoice' => true]);
    }
  }

  public function modifyCoordinates()
  {
    $userLog = new AuthentificationModel();

    // Si aucun utilisateur n'est connecté, redirige vers la page de login
    if(is_null($userLog ->getLoggedUser()))
			{$this->redirectToRoute('user_home');}
    // Pas de post ou un post mais pas du formulaire "modifycoordinates" donc affichage de la page par défaut de l'inscription
    else if (!isset($_POST['form_name']) || (isset($_POST['form_name']) && $_POST['form_name'] !== 'modifyCoordinates'))
			{$this->show("default/SignInView");}

    else {
        // prépare et envoie les données au modèle pour modification
        $userData = array(
            "lastname" => htmlspecialchars($_POST['lastname']),
            "firstname" => htmlspecialchars($_POST['firstname']),
            "mail" => htmlspecialchars($_POST['email']),
            "phone" => htmlspecialchars($_POST['numTel']),
        );

		// Récupération de l'ID de l'utilisateur connecté
		$user_id=$_SESSION['user']['id'];

		//Mise a jour des infos en BDD
    $userModel = new UserModel();
    $errors = $userModel -> update($userData, $user_id);

		// Pas d'erreur lors de l'inscription donc renvoi vers la view de modification avec la donnée de réussite d'inscription
    if($errors != false){
			$userLog->refreshUser(); // rafraichissement de la session
      $this->redirectToRoute('user_home');
    }

    // Erreur lors de l'inscription donc renvoi vers la view de modification avec la donnée des erreurs
    else {
			$this -> show("user/UserView",['errorModifyCoordinates'=>$errors]);}
    }
  }
}
