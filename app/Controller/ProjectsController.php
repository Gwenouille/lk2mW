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
		// format tolérés pour les images
		$projectExt = array(".pdf",".zip",".rar");
		// répertoire où sont stockées les images
		$dir = __DIR__;
		$cherche="app\Controller";
		$remplace="private\\projects\\";
		$projectTargetDir = str_replace($cherche,$remplace,$dir);

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

				if (!$sth->execute()) {
					$errorLiaison = false;
				} else {
					$errorLiaison = $modelProject->find($modelProject->lastInsertId());
				}
		 		if($createProject == false || $errorLiaison == false) {
					$errors['creation'] = true;
				}
			}

			if( (isset($errors['creation']) && $errors['creation'] === true ) || ( isset($errors['update']) && $errors['update'] === true ) ) {
				$this->showJson(["actionProject" =>$actionProject, "success"=>false,"errors"=>true,"errorsChampBDD"=>$errors]);
			} else {
				// Récupère l'ID de l'article concerné
				if($actionProject === "modification") $project_id=$updateProject['id'];
				else $project_id = $idProject;
				// boucle pour examiner chaque input file
				for($i = 0; $i < count($_FILES['fileProject']['name']); $i++) {
					if($_FILES['fileProject']['size'][$i] != 0 && $_FILES['fileProject']['error'][$i] != 4 ) {
												// récupère les données des fichiers
						$fileData = array(
							"name" => $_FILES['fileProject']['name'][$i],
							"type" => $_FILES['fileProject']['type'][$i],
							"tmp_name" => $_FILES['fileProject']['tmp_name'][$i],
							"error" => $_FILES['fileProject']['error'][$i],
							"size" => $_FILES['fileProject']['size'][$i]
						);

						// Poids du fichier ne dépasse pas celui autorisé pour l'upload
						if(filesize($fileData["tmp_name"]) != false) {
							// fichier conforme aux formats autorisés
							if(in_array(strtolower(strrchr($fileData['name'], '.')), $projectExt)) {
								// création d'un dossier pour le projet (nom du dossier correspondant à l'ID du projet)
								$dossier = $projectTargetDir.$project_id;
								if(!is_dir($dossier)){
									mkdir($dossier);
								}
								// enregistre l'image dans le dossier par numero
								$projectFileType = pathinfo(basename($fileData["name"]),PATHINFO_EXTENSION);
								$projectFileName = pathinfo($fileData['name'], PATHINFO_FILENAME);
								$nameStorage = ($i+1).".".$projectFileType;

								$instance=ConnectionModel::getDbh();
								$sql = "INSERT INTO news_pictures(name,real_name,type,size,alt,news_id,state) VALUES(:name,:real_name,:type,:size,:alt,:news_id,:state)";
								$requestImg = $instance ->prepare($sql);
								$requestImgOk = $requestImg->execute(array(
									"name"=>(string)($i+1),
									"real_name"=>$realFileName,
									"type"=> $imageFileType,
									"size"=> $fileData['size'],
									"alt"=> $nameStorage,
									"news_id"=>$news_id,
									"state"=> 1,
								));




							} else {
								$errors['fileError'][$i] = "Le fichier ".$fileData['name']." n'est pas conforme aux extensions autorisées : ".implode(', ', $projectExt);
							}
						} else {
							$errors['fileError'][$i] = "le poids du fichier ".$fileData['name']." excède le poids autorisé pour l'upload.";
						}
					}
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
