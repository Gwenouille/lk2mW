<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ProjectsModel;
use Model\FilesModel;
use Model\MessagesModel;
use \W\Model\Model;
use \W\Model\ConnectionModel;

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
			$listOfProjects[$key]['files']=$files->findFilesFromProjects($listOfProjects[$key]['projects_id']);
		}

		//Récupération des messages le concernant
		$message = new MessagesModel();
		$messages = $message -> search(array('users_id'=>$user_id, 'to_users_id'=>$user_id));

		//Passage de ces arguments à la view
		$this -> show("user/UserProjectsView", ['connectLinkChoice' => true,'projectsList' => $listOfProjects,'messages' => $messages]);
	}


	public function projectsShow() {
		$projectId=substr($_POST['id'],9,strlen($_POST['id'])-9 );

		$projectModel = new ProjectsModel();
		$projectData = $projectModel -> find($projectId);

		$this->showJson(["Success" => true,"projectData" => $projectData ]);
	}

	public function projectsModify() {

		$myProject = new ProjectsModel();
		$fulfillMyProject = $myProject ->fulfillForm($_POST,$_FILES);
		$this->showJson($fulfillMyProject);
	}

	public function projectsAjaxModify() {
		//Récupération de l'ID du user en session actuellement
		$user_id=$_SESSION['user']['id'];

		//Récupération des projets à son actif
		$project = new ProjectsModel();
		$listOfProjects = $project->findAllProjectsFromUser($user_id);

		//Ajout des fichiers liés au projet dans le tableau, sous l'indice 'files'
		$files = new FilesModel();
		foreach ($listOfProjects as $key => $value) {
			$listOfProjects[$key]['files']= $files -> findFilesFromProjects($listOfProjects[$key]['projects_id']);
		}

		$newLeftMenu = "";

		foreach ($listOfProjects as $key => $value) {
			$newLeftMenu .= "<div class='project'>";
			$newLeftMenu .= "<h4><span id='projectID".$listOfProjects[$key]['id']."' class='glyphicon glyphicon-eye-open'></span>&nbsp;".$listOfProjects[$key]['name']."</h4>";
			$newLeftMenu .= "<p><em>".$listOfProjects[$key]['date']."</em></p>";
			$newLeftMenu .= "<p>".$listOfProjects[$key]['description']."</p>";
			$newLeftMenu .= "<ul>";
			if (isset($listOfProjects[$key]['files']) && !empty ($listOfProjects[$key]['files'])) {
				$files=$listOfProjects[$key]['files'];

				foreach ($files as $key2 => $value2) {
					$newLeftMenu .= "<li id=lifileID".$files[$key2]['id']." >";

					$app = getApp();
		 			$dir = $this->generateUrl($app->getCurrentRoute());
					$cherche = "public/fabrication_additive/projects/projectsAjaxModify";
					$remplace = "private/projects/".$files[$key2]['projects_id']."/";
					$projectTargetDir = str_replace($cherche,$remplace,$dir);
					$newLeftMenu .= "<a href='".$projectTargetDir.$files[$key2]['name'].".".$files[$key2]['type']."' download='".$files[$key2]['real_name'].".".$files[$key2]['type']."'>";
					$newLeftMenu .= $files[$key2]['real_name'].".".$files[$key2]['type'];
					$newLeftMenu .= "</a>";
					$newLeftMenu .= "<span id=fileID".$files[$key2]['id'].' class="glyphicon glyphicon-trash">';

					$newLeftMenu .= "</li>";
				}
			}
			$newLeftMenu .= "</ul>";
			$newLeftMenu .= "</div>";
		}
		echo $newLeftMenu;
	}

//Fonction d'envoi de message du point de vue utilisateur lambda
	public function sendmsg($to_users_id='3'){

		//Récupération du contenu de POST et passage à la moulinette htmlspecialchars
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
		if($newMessage -> insert($data)) $success = true;
		else $success= false;

		$this->showJson(["Success" =>$success]);
	}

	// Fonction de reload du chat pour les utilisateurs lambda
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

		if($messages != false) {
			foreach ($messages as $key => $value) {
				$class = ($messages[$key]['users_id']!=='3') ? 'chat_users' : 'chat_admin';
				$newChat .= "<li>";
				$newChat .= "<div class='chat_message ". $class."'>";
				$newChat .= "<p>".$messages[$key]['content']."</p>";
				$newChat .= "<p class='chat_date'>".$messages[$key]['date']."</p>";
				$newChat .= "</div>";
				$newChat .= "</li>";
			}
			$success = true;
		} else {
			$newChat .= "Une erreur s'est produite lors de l'affichage des messages";
			$success = false;
		}
		$this->showJson(["Success" =>$success,'reloadChat' => $newChat]);
	}

	// Fonction de suppression d'un fichier d'un projet de l'utilisateur
	public function deleteFile() {
		$file = new FilesModel();
		$fileId=substr($_POST['id'],6,strlen($_POST['id'])-6 );
		try {
			$file->delete($fileId);
			$this->showJson(["Success"=>true,'id' => $fileId]);
		} catch(PDOException $e){
			$this->showJson(["Success"=>false,'id' => $fileId]);
		}
	}

}
