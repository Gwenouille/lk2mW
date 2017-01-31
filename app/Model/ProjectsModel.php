<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;
use Model\FilesModel;


class ProjectsModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $name;
  public $date;
  public $description;

  //Méthode init de peuplement des propriétés
  public function init($id = 'NULL', $name='', $date='', $description='')
  {
    $this -> __set('id',$id);
    $this -> __set('name',$name);
    $this -> __set('date',$date);
    $this -> __set('description',$description);
  }

  //Getters: on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="name") {
      return $this -> name;
    } elseif ($value==="date") {
      return $this -> date;
    } elseif ($value==="description") {
      return $this -> description;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  //Setters: on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="name") {
      $this -> name = $arg;
    } elseif ($value==="date") {
      $this -> date = $arg;
    } elseif ($value==="description") {
      $this -> description = $arg;
    }
  }

	/**
	 * Récupère tous les projets de l'utilisateur passé en parametre
	 * @param $id L'utilisateur dont on veut récupérer les projets
	 */
	public function findAllProjectsFromUser($id)
	{
		$sql = 'SELECT projects.*,projects_has_users.projects_id,projects_has_users.users_id,projects_has_users.chief_id FROM ' . $this -> table . ' INNER JOIN projects_has_users ON '.$this -> table.'.id=projects_has_users.projects_id';
		$sql .= ' WHERE projects_has_users.users_id = '.$id;

		$sth = $this -> dbh -> prepare($sql);
		$sth -> execute();

		return $sth -> fetchAll();
	}

  public function fulfillForm($dataPost,$dataFiles) {

    // format tolérés pour les fichiers
    $projectExt = array(".pdf",".zip",".rar");

    // répertoire où sont stockées les fichiers
    $dir = __DIR__;
    $cherche="app/Model";
    $remplace="private/projects/";
    $remplace="public/projects/";
    $projectTargetDir = str_replace($cherche,$remplace,$dir);

    // Vérifie que le champ du titre du projet est bien rempli
    if(isset($dataPost['titleProject']) && empty($dataPost['titleProject'])) {
      $errors['title'] = true;
    }

    // Vérifie que le champ du textarea est bien rempli
    if(isset($dataPost['contentProject']) && empty($dataPost['contentProject'])) {
      $errors['content'] = true;
    }

    // fait la différence entre modification et création
    if(isset($dataPost['action']) && $dataPost['action']==='modifyProject') {
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
          "name" => htmlentities($dataPost['titleProject']),
          "description" => htmlentities($dataPost['contentProject']),
            );
        // mise à jour des données en BDD
        $updateProject = $modelProject-> update($dataProject,$dataPost['idProject'],true);
        if($updateProject == false) {
          $errors['update'] = true;
        }
      } else {
        // création d'un article dans la table projects
        $user_id=$_SESSION['user']['id'];

        $dataProject = array(
          "name" => htmlentities($dataPost['titleProject']),
          "description" => htmlentities($dataPost['contentProject']),
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

        if($createProject == false || !$sth->execute()) {
          $errors['creation'] = true;
        }
      }
      // la mise en BDD ne s'est pas bien déroulée
      if( (isset($errors['creation']) && $errors['creation'] === true ) || ( isset($errors['update']) && $errors['update'] === true ) ) {
        return ["actionProject" => $actionProject, "success" => false, "errors" => true, "errorsChampBDD" => $errors];
      } else {
        // Récupère l'ID de l'article concerné
        if($actionProject === "modification") $project_id = $updateProject['id'];
        else $project_id = $idProject;

        // boucle pour examiner chaque input file
        for($i = 0; $i < count($dataFiles['fileProject']['name']); $i++) {
          if($dataFiles['fileProject']['size'][$i] != 0 && $dataFiles['fileProject']['error'][$i] != 4 ) {
            // récupère les données des fichiers
            $fileData = array(
              "name" => $dataFiles['fileProject']['name'][$i],
              "type" => $dataFiles['fileProject']['type'][$i],
              "tmp_name" => $dataFiles['fileProject']['tmp_name'][$i],
              "error" => $dataFiles['fileProject']['error'][$i],
              "size" => $dataFiles['fileProject']['size'][$i]
            );

            // Poids du fichier ne dépasse pas celui autorisé pour l'upload
            if(filesize($fileData["tmp_name"]) == false) { $errors['fileError'][$i] = "le poids du fichier ".$fileData['name']." excède le poids autorisé pour l'upload."; }
            // fichier conforme aux formats autorisés
            elseif(!in_array(strtolower(strrchr($fileData['name'], '.')), $projectExt)) { $errors['fileError'][$i] = "Le fichier ".$fileData['name']." n'est pas conforme aux extensions autorisées : ".implode(', ', $projectExt); }
            else {
              // création d'un dossier pour le projet (nom du dossier correspondant à l'ID du projet)
              $dossier = $projectTargetDir.$project_id;
              // var_dump($dir,$projectTargetDir,$project_id);
              // var_dump($dossier);
              if(!is_dir($dossier)){
                mkdir($dossier);
              }
                // enregistre le fichier dans le dossier par numero
              $projectFileType = pathinfo(basename($fileData["name"]),PATHINFO_EXTENSION);
              $realFileName = pathinfo($fileData['name'], PATHINFO_FILENAME);
              $nameStorage = ($i+1).".".$projectFileType;

              $instance=ConnectionModel::getDbh();
              $sql = "INSERT INTO files(name,real_name,type,size,projects_id) VALUES(:name,:real_name,:type,:size,:projects_id)";
              $requestProject = $instance ->prepare($sql);
              $requestProjectOk = $requestProject->execute(array(
                  "name"=>(string)($i+1),
                  "real_name"=>$realFileName,
                  "type"=> $projectFileType,
                  "size"=> $fileData['size'],
                  "projects_id"=>$project_id,
              ));

              // données fichier bien entrées dans la BDD
              if($requestProjectOk) {
                  // envoie des fichiers dans le dossier concernant le projet créé
                  if (!move_uploaded_file($fileData["tmp_name"], $dossier."/".$nameStorage)) {
                    // récupère l'ID du fichier en BDD
                    $projectMod = new FilesModel();
                    $projectId = $projectMod->lastInsert();
                    // efface les données du fichier en BDD
                    $projectMod-> delete($projectId);
                    $errors["fileError"][$i] = "Une erreur est survenue lors du transfert du fichier ".$realFileName;
                  }
              } else {
                $errors["fileError"][$i] = "Une erreur est survenue lors de l'enregistrement des données du fichier ".$realFileName;
              }
            }
          }
        }

        // si des erreurs dans les fichiers
        if(isset($errors['fileError'])) {
          return ["actionProject" => $actionProject, "success" => true, "errors" => true, "errorsType" => $errors['fileError'] ];
        } else {
          return ["actionProject" => $actionProject, "success" => true, "errors" => false ];
        }
      }
    } else {  // Si les champs titre et contenu ne sont pas remplis correctement
      return ["actionProject" => $actionProject, "success" => false,"errors" => true,"errorsChamp" => $errors];
    }
  }

}
