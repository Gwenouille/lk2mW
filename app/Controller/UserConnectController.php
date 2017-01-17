<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;

class UserConnectController extends Controller
{

	public function loginUser()
	{
   // l'utilisateur est connecté ?
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { $connection = true; }
    else { $connection = false; }
    
    // Un post du formulaire login est soumis ?
    if(!empty($_POST) && $_POST['form_name'] === 'form_connection') { $submitForm = true; }
    else { $submitForm = false; }

    // on arrive sur la page sans qu'un formulaire de connexion est soumis
    if(!$connection && $submitForm) {
	
    	// variables indiquant champs mal remplis, compte existant mais pas activé, ou mauvais identifiants
		$errorChamp = true;
		$activeSpace = false;
		$connectionSuccess = false;

		if(!empty($_POST['e_mail']) && !empty($_POST['password'])) {

			$user = new AuthentificationModel();
			$userExist = $user->isValidLoginInfo($_POST['e_mail'], $_POST['password']);
			// L'utilisateur existe en BDD
        	if($userExist!= 0) {
				$errorChamp = false;        		
        		$userConnect = new UsersModel();
        		$userData = $userConnect -> getUserByUsernameOrEmail($_POST['e_mail']);
        	  	// si le compte n'est pas activé
        	  	if($userData['status'] != 0) { $activeSpace = true; }
       	  		if($activeSpace==true) {
        	  		$user->logUserIn($userData);
        	  		$connectionSuccess = true;
        	  	}
        	}
		}
	}
    if(!$connection && !$submitForm) { $this -> show ('user/InscriptionView'); }
    elseif(!$connection && $submitForm) { $this -> show ('user/InscriptionView', ["formAction" => "connexion" ,"connectionSuccess"=>$connectionSuccess ,"connectionError" => $errorChamp,"activeSpace" => $activeSpace]); }
    else { $this -> show ('user/UserView',['connectLinkChoice' => true]); }
	}

	public function logoutUser()
	{
		$user = new AuthentificationModel();
	    $user->logUserOut();
    	$this->show("DMIcontent/fabrication_additive",['connectLinkChoice' => true]);
	}
}