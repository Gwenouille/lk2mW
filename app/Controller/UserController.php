<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\UserModel;
use Model\ProjectsModel;
use Model\MessagesModel;
use Model\MailModel;

class UserController extends Controller
{

	public function getUserData()
	{

		$user_id = substr($_POST['id'],6,strlen($_POST['id'])-6 );

		//Inscription en session de l'id du user avec lequel l'admin converse
		$_SESSION['to_user']=array('to_users_id'=>$user_id);

		//Récupération des données personnelles de l'utilisateur
		$user = new UserModel();
		$userData = $user->find($user_id);

		$coordsContent='<p class="usercoordinate">';
		$coordsContent.=$userData['firstname']." ".$userData['lastname'];
		$coordsContent.='</p>';
		$coordsContent.='<p class="usercoordinate">';
		$coordsContent.=$userData['mail'];
		$coordsContent.='</p>';
		$coordsContent.='<p class="usercoordinate">';
		$coordsContent.=$userData['phone'];
		$coordsContent.='</p>';

		//Récupération des projets à son actif
		$project = new ProjectsModel();
		$projectsList = $project->findAllProjectsFromUser($user_id);

		// die(var_dump())
		$projectsContent='';
		foreach ($projectsList as $key => $value){

			$projectsContent.='<div class="project">';
		  $projectsContent.="<h4>".$projectsList[$key]['name']."</h4>";
		  $projectsContent.="<p><em>".$projectsList[$key]['date']."</em></p>";
		  $projectsContent.="<p>".$projectsList[$key]['description']."</p>";
		  $projectsContent.="<ul>";
	        if (isset($projectsList[$key]['files']) && !empty ($projectsList[$key]['files'])) {
	          $files=$projectsList[$key]['files'];

		        foreach ($files as $key2 => $value){
						  $projectsContent.="<li>";
						  $projectsContent.=$files[$key2]['name'].".".$files[$key2]['type'];
						  $projectsContent.="</li>";
					}
		    }
		    $projectsContent.="</ul>";
		  $projectsContent.="</div>";
		}
		$content= array("coords" =>$coordsContent,"projects"=>$projectsContent);

		$this->showJson(["coords" =>$coordsContent,"projects"=>$projectsContent]);
	}

	public function getMessagesFromUser($user_id='')
	{
		//Récupération des messages le concernant
		$message = new MessagesModel();
		return($message->search(array('users_id'=>$user_id, 'to_users_id'=>$user_id)));
	}

	// récupère la liste des utilisateurs
	public function showUsers()
	{
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
		//destruction du contenu de la variable superglobale $_SESSION
		$_SESSION = array();

    $userLog = new AuthentificationModel();
    // l'utilisateur est connecté
    if(!is_null($userLog ->getLoggedUser())) {
        $userLog->logUserOut();
        $this->show("default/SignInView",["deconnection" => true,"connectLinkChoice" => true]);
    } else {
        $this->redirectToRoute('user_login');
    }
		//Remise à zéro de la super-globale $_SESSION
  }

	public function validateSignIn()
	{
		$temphash=$_GET['temphash'];
		$user=new UserModel();
		//On cherche le hash temporaire chez l'un des utilisateurs
		$userFound=$user->findMemberFromHash($temphash);
		//Si on trouve un user, on passe son state à 1 et on efface le hash temporaire
		if (!empty($userFound)){
			//Si le compte n'est pas encore activé
			if ($userFound['state']==0){
				$user->update(array('state'=>1),$userFound['id']);
				//On le renvoie sur la page de sign-in pour qu'il effectue sa connexion
				$this->show("default/SignInView",['validateSignIn'=>1]);
			} else {
				$this->show("default/SignInView",['validateSignIn'=>0]);
			}
		} else {
			$this->show("default/SignInView",['validateSignIn'=>-1]);
		}
	}

  public function signIn()
  {
		$temp = $this->generateRandomString(16);
    $userLog = new AuthentificationModel();
		$temphash = $userLog -> hashPassword($temp);

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
						"temp_hash" => $temphash,
            "phone" => htmlentities($_POST['numTel']),
        );

        $userLog = new UserModel();
        $errors = $userLog -> signIn($userData);

        // pas d'erreur lors de l'inscription donc renvoi vers la view d'inscription avec la donnée de réussite d'inscription. Envoi du mail.
        if(is_null($errors)) {

					$text_body="Bienvenue sur le site DMI, section Fabrication additive. Vous trouverez ci-dessous un lien pour valider votre inscription sur notre site.";
					$text_body.="http://lk2m.fredericnoel.com/fabrication_additive/validate?temphash=$temphash";
					$text_body.="Bien cordialement, l'équipe de DMI";

					$body="<p>Bienvenue sur le site DMI, section Fabrication additive.</p>
					<p>Vous trouverez ci-dessous un lien pour valider votre inscription sur notre site.</p>";
					$body.="<a href='http://lk2m.fredericnoel.com/fabrication_additive/validate?temphash=$temphash'>Cliquez ici pour valider votre inscription</a>";
					$body.="<p>Bien cordialement,</p>
					<p>L'equipe de DMI</p>";

					$mail=new MailModel();
					$mail->setSubject('Inscription DMI');
					$mail->setBody($body);
					$mail->setTextBody($text_body);
					$mail->addTarget(htmlentities($_POST['email']));
					$mail->sendmail();

 					$this->show("default/SignInView",['successSignIn'=>true]);
				}
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


	//Fonction d'envoi de message du point de vue admin
	public function sendmsg($to_users_id='3'){

		//Récupération du contenu de POST et passage a la moulinette htmlspecialchars
		$message=htmlspecialchars($_POST['newMessage']);

		//Récupération de l'ID du user en session actuellement
		$user_id=$_SESSION['user']['id'];
		if ($user_id=='3'){
			$to_users_id=$_SESSION['to_user']['to_users_id'];
		}

		//Création de la chaine de date actuelle
		$now = date('Y-m-d H:i:s');

		$newMessage = new MessagesModel();
		$newMessage->init(NULL, $message, $now, $user_id, $to_users_id);

		$data = array(
				'content'=>$newMessage->content,
				'date'=>$newMessage->date,
				'users_id'=>$newMessage->users_id,
				'to_users_id'=>$newMessage->to_users_id );

		//insertion dudit message en BDD
		$newMessage -> insert($data);

		//mise a jour en BDD sur la table du user concerné de la date du dernier message envoyé.
		$userModel = new UserModel();
		$last_message_time = array(
				'last_message_time'=>$now);
		$userModel -> update($last_message_time, $to_users_id);


		//Récupération des messages le concernant
		$message = new MessagesModel();
		$messages = $message -> searchMessages(array('users_id'=>$user_id, 'to_users_id'=>$to_users_id));

		$this->showJson(["Success" =>true]);
	}

	//Fonction de reload des messages du point de vue admin
	public function reloadmsg($to_users_id='3') {

		//Récupération de l'ID du user en session actuellement
		$user_id=$_SESSION['user']['id'];
		if ($user_id=='3'){
			$to_users_id=$_SESSION['to_user']['to_users_id'];
		}

		//Récupération des messages le concernant
		$message = new MessagesModel();
		$messages = $message -> searchMessages(array('users_id'=>$user_id, 'to_users_id'=>$to_users_id));

		$newChat ="";
		foreach ($messages as $key => $value) {
			$class = ($messages[$key]['users_id']!=='3') ? 'chat_users' : 'chat_admin';
			$newChat .= "<li>";
			$newChat .= "<div class='chat_message ". $class."'>";
			$newChat .= "<p>".$messages[$key]['content']."</p>";
			$newChat .= "<p class='chat_date'>".$messages[$key]['date']."</p>";
			$newChat .= "</div>";
			$newChat .= "</li>";
		}

		$this->showJson(["Success" =>true,'reloadChat' => $newChat]);
	}

	public function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
	}

}
