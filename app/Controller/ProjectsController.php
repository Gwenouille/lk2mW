<?php

namespace Controller;

use \W\Controller\Controller;
use Model\ProjectsModel;
use Model\FilesModel;
use Model\MessagesModel;
use W\Model\Model;
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
			$listOfProjects[$key]['files']=$files->findFilesFromProjects(	$listOfProjects[$key]['projects_id']);
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

				// Vérifie que le champ du titre de l'article est bien rempli
		if(isset($_POST['titleProject']) && empty($_POST['titleProject'])) {
			$errors['title'] = true;
		}

		// Vérifie que le champ du textarea est bien rempli
		if(isset($_POST['contentProject']) && empty($_POST['contentProject'])) {
			$errors['content'] = true;
		}

		// fait la différence entre modification et création
		if(isset($_POST['action']) && $_POST['action']==='modifyProject') {
			$actionProject = "modification";
		} else  {
			$actionProject = "creation";
		}

		// // les champs sont bien remplis
		if(!isset($errors)) {
			$modelProject = new ProjectsModel();
			// si on effectue une mise à jour
			if($actionProject === 'modification') {
				// prépare les données qui seront mises en BDD
				$dataProject = array(
					"name" => htmlentities($_POST['titleProject']),
					"description" => htmlentities($_POST['contentProject']),
      			);
				// mise à jour des données en BDD
				$updateProject = $modelProject-> update($dataProject,$_POST['idProject'],true);
				if($updateProject == false) {
					$errors['update'] = true;
				}
		 	} else {
				// création d'un article dans la table projects
				$user_id=$_SESSION['user']['id'];

				$dataProject = array(
					"name" => htmlentities($_POST['titleProject']),
					"description" => htmlentities($_POST['contentProject']),
					"date" => date('Y-m-d H:i:s'),
    			);
				$createProject = $modelProject ->insert($dataProject,true);

				// récupère l'ID du projet qui vient d'être créé
				$idProject = $createProject['id'];

				// crée une entrée dans la table projects_has_users pour le projet qui vient d'être créé
				$sth = 'INSERT INTO projects_has_users(projects_id,users_id,chief_id) VALUES(:projects_id,:users_id,:chief_id)';
				$sth = ConnectionModel::getDbh() -> prepare($sth);
				$sth->bindValue(':projects_id', $idProject);
				$sth->bindValue(':users_id', $user_id);
				$sth->bindValue(':chief_id', $user_id);
		 		if($createProject == false || !$sth -> execute()) {
					$errors['creationLiaison'] = true;
				}
			}

		} else {  // Si les champs titre et contenu ne sont pas remplis correctement
			$this->showJson(["actionProject" =>$actionProject, "success"=>false,"errors"=>true,"errorsChamp" => $errors]);
		}

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
		$newMessage -> insert($data);

		//Récupération des messages le concernant
		$message = new MessagesModel();
		$messages = $message -> searchMessages(array('users_id'=>$user_id, 'to_users_id'=>$to_users_id));

		$this->showJson(["Success" =>true]);
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
}
