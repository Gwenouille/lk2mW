<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ProjectsModel;
use Model\FilesModel;
use Model\MessagesModel;

class ProjectsController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home() {

		//Récupération de l'ID du user en session actuellement
		$user_id=$_SESSION['user']['id'];

		//Récupération des projets à son actif
		$project = new ProjectsModel();
		$listOfProjects = $project->findAllProjectsFromUser($user_id);

		//Ajout des fichiers liés au projet dans le tableau, sous l'indice 'files'
		$files = new FilesModel();
		foreach ($listOfProjects as $key => $value) {
			$listOfProjects[$key]['files']=$files->findFilesFromProjects(	$listOfProjects[$key]['projects_id']);
		}

		//Récupération des messages le concernant
		$message = new MessagesModel();
		$messages = $message -> search(array('users_id'=>$user_id, 'to_users_id'=>$user_id));

		//Passage de ces arguments à la view
		$this -> show("projects/home", ['connectLinkChoice' => true,'projectsList' => $listOfProjects,'messages' => $messages]);
	}


	public function sendmsg($to_users='3'){

		//Récupération du contenu de POST et passage a la moulinette htmlspecialchars
		$message=htmlspecialchars($_POST['newMessage']);

		//Récupération de l'ID du user en session actuellement
		$user_id=$_SESSION['user']['id'];

		//Création de la chaine de date actuelle
		$now = date('Y-m-d H:i:s');

		$newMessage = new MessagesModel();
		$newMessage->init(NULL, $message, $now, $user_id, $to_users);

		$data = array(
				'content'=>$newMessage->content,
				'date'=>$newMessage->date,
				'users_id'=>$newMessage->users_id,
				'to_users_id'=>$newMessage->to_users_id );

		//insertion dudit message en BDD
		$newMessage -> insert($data);

		$this->redirectToRoute('projects_home');
	}

}
