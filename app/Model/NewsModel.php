<?php

namespace Model;

use \W\Model\Model;
use \W\Model\ConnectionModel;
use Model\NewsPicturesModel;

class NewsModel extends Model {

  //variables de la table correspondante en BDD
  public $id;
  public $title;
  public $content;
  public $users_id;
  public $date_creation;
  public $date_modification;
  public $state;

  public function init($id = 'NULL', $title = "NULL", $content= "NULL", $users_id= "NULL", $date_creation= "NULL", $date_modification= "NULL", $state= "NULL") {
    $this->__set('id',$id);
    $this->__set('title',$title);
    $this->__set('content',$content);
    $this->__set('users_id',$users_id);
    $this->__set('date_creation',$date_creation);
    $this->__set('date_modification',$date_modification);
    $this->__set('state',$state);
  }

  // on recupere une propriete de l'objet
  public function __get($value) {
    if($value==="id") {
      return $this -> id;
    } elseif ($value==="title") {
      return $this -> title;
    } elseif ($value==="content") {
      return $this -> content;
    } elseif ($value==="users_id") {
      return $this -> users_id;
    } elseif ($value==="date_creation") {
      return $this -> date_creation;
    } elseif ($value==="date_modification") {
      return $this -> date_modification;
    } elseif ($value==="state") {
      return $this -> state;
    } else {
      throw new Exception('Propriété invalide !');
    }
  }

  // on modifie une propriete d'un objet
  public function __set($value, $arg) {
    if($value==="id") {
      $this -> id = $arg;
    } elseif ($value==="title") {
      $this -> title = $arg;
    } elseif ($value==="content") {
      $this -> content = $arg;
    } elseif ($value==="users_id") {
      $this -> users_id = $arg;
    } elseif ($value==="date_creation") {
      $this -> date_creation = $arg;
    } elseif ($value==="date_modification") {
      $this -> date_modification = $arg;
    } elseif ($value==="state") {
      $this -> state = $arg;
    }
  }

  public function fulfillForm($dataPost,$dataFiles) {

    // format tolérés pour les images
    $imgExt = array(".jpg",".jpeg",".gif",".png",".bmp");
    // répertoire où sont stockées les images
    $dir = __DIR__;
    $cherche="app/Model";
    $remplace="public/assets/images/news/";
    $imgTargetDir = str_replace($cherche,$remplace,$dir);

    // Vérifie que le champ du titre de l'article est bien rempli
    if(isset($dataPost['article_title']) && empty($dataPost['article_title'])) {
      $errors['title'] = true;
    }

    // Vérifie que le champ du textarea est bien rempli
    if(isset($dataPost['news_content']) && empty($dataPost['news_content'])) {
      $errors['content'] = true;
    }

    if(isset($dataPost['article_id'])) { $formConcern = "modification"; }
    else { $formConcern = "creation"; }

    // les champs sont bien remplis
		if(!isset($errors)) {

      $majArticle = new NewsModel();

      // si une ID est présente alors c'est une mise à jour de l'article
      if(isset($dataPost['article_id'])) {
        // prépare les données qui seront mises en BDD
        $ArticleData = array(
          "title" => htmlentities($dataPost['article_title']),
          "content" => $dataPost['news_content'],
          "date_modification" => date('Y-m-d H:i:s'),
            );
        // mise à jour des données en BDD
        $errorMaj = $majArticle-> update($ArticleData,$dataPost['article_id'],false);
        if($errorMaj == false) { $errors['maj'] = true; }
      }	else { // création d'un article
        // récupération de l'ID de l'utilisateur connecté
        $user_id=$_SESSION['user']['id'];

        $ArticleData = array(
          "title" => htmlentities($dataPost['article_title']),
          "content" => $dataPost['news_content'],
          "users_id" => $user_id,
          "date_creation" => date('Y-m-d H:i:s'),
          "date_modification" => date('Y-m-d H:i:s'),
          "state" => 1
          );
        $errorMaj = $majArticle ->insert($ArticleData,false);
        if($errorMaj == false) {
          $errors['creation'] = true;
        }
      }
      if(isset($errorMaj) && $errorMaj==false) {
					return ["formConcern" => $formConcern, "success" => false, "errors" => true, "errorsChampBDD" => $errors];
			} else {
        // Récupère l'ID de l'article qui vient d'etre créé
				$news_id = $errorMaj['id'];

        //Récupère le nombre d'images déja présentes dans la news
        $pictures = new NewsPicturesModel();
        $offset=count($pictures->search(array('news_id'=>$news_id)));

				// boucle pour examiner chaque input file
				for($i = 0; $i < count($dataFiles['news_files_input']['name']); $i++) {
          // S'il y a des fichiers et pas d'erreur dans la création de l'article
					if($dataFiles['news_files_input']['size'][$i] != 0 && $dataFiles['news_files_input']['error'][$i] != 4 ) {
            // récupère les données des fichiers
						$fileData = array(
							"name" => $dataFiles['news_files_input']['name'][$i],
							"type" => $dataFiles['news_files_input']['type'][$i],
							"tmp_name" => $dataFiles['news_files_input']['tmp_name'][$i],
							"error" => $dataFiles['news_files_input']['error'][$i],
							"size" => $dataFiles['news_files_input']['size'][$i]
						);

            // vérifie que le fichier est bien une image,
						if(!getimagesize($fileData['tmp_name'])) { $errors['fileError'][$i] = "Le fichier ".$fileData['name']." n'est pas une image."; }
            elseif(filesize($fileData["tmp_name"]) == false) { $errors['fileError'][$i] = "le poids de l'image ".$fileData['name']." excède le poids autorisé pour l'upload."; }
            elseif(!in_array(strtolower(strrchr($fileData['name'], '.')), $imgExt)) {$errors['fileError'][$i] = "L'image ".$fileData['name']." n'est pas conforme aux extensions autorisées : ".implode(', ', $imgExt);}
            else {
              // création d'un dossier pour l'article (nom du dossier correspondant à l'ID de l'article)
              $dossier = $imgTargetDir.$news_id;
              if(!is_dir($dossier)){
                mkdir($dossier);
              }
              // enregistre l'image dans le dossier par numero
              $imageFileType = pathinfo(basename($fileData["name"]),PATHINFO_EXTENSION);
              $realFileName = pathinfo($fileData['name'], PATHINFO_FILENAME);
              $nameStorage = ($i+$offset+1).".".$imageFileType;

              $instance=ConnectionModel::getDbh();
              $sql = "INSERT INTO news_pictures(name,real_name,type,size,alt,news_id,state) VALUES(:name,:real_name,:type,:size,:alt,:news_id,:state)";
              $requestImg = $instance ->prepare($sql);
              $requestImgOk = $requestImg->execute(array(
                      "name"=>(string)($i+$offset+1),
                      "real_name"=>$realFileName,
                      "type"=> $imageFileType,
                      "size"=> $fileData['size'],
                      "alt"=> $nameStorage,
                      "news_id"=>$news_id,
                      "state"=> 1,
              ));

              // données image bien entrées dans la BDD
              if(!$requestImgOk) {
                $errors["fileError"][$i] = "Une erreur est survenue lors de l'enregistrement des données de l'image ".$realFileName;
              } else {

                // envoie des images dans le dossier concernant l'article créé
                if (!move_uploaded_file($fileData["tmp_name"], $dossier."/".$nameStorage)) {
                    // récupère l'ID de l'image en BDD
                    $imgMod = new NewsPicturesModel();
                    $imgId = $imgMod->lastInsert();
                    // efface les données de l'image en BDD
                    $imgMod-> delete($imgId);
                  $errors["fileError"][$i] = "Une erreur est survenue lors du transfert de l'image ".$realFileName;
                }
              }
            }
          }
        }
        // si des erreurs dans les images
				if(isset($errors['fileError'])) {
					return ["formConcern" => $formConcern, "success" => true, "errors" => true, "errorsType" => $errors['fileError'] ];
				} else {
					return ["formConcern" => $formConcern, "success" => true, "errors" => false ];
				}
      }
    } else {  // Si les champs titre et contenu ne sont pas remplis correctement
     return ["formConcern" => $formConcern, "success" => false, "errors" => true , "errorsChamp" => $errors];
    }
  }


  /**
   * Récupère toutes les lignes de la table
   * @param $id L'utilisateur dont on veut récupérer les articles
   * @param $articleId L'id de l'article (int) dont on veut récupérer les données // Pas très intuitif...
   */
  public function findNewsFromUser($users_id,$articleId='') {

    $sql = 'SELECT * FROM ' . $this -> table . ' WHERE users_id = '.$users_id;

    if(is_numeric($articleId)) $sql .= " AND ".$this->table.".id=".$articleId;

    $sth = $this -> dbh -> prepare($sql);
    $sth -> execute();

    $listNews = $sth -> fetchAll();

    // Ajout des images liées aux articles dans le tableau, sous la clé 'pictures'
    $pictures = new NewsPicturesModel();
    // $test = $pictures -> findPicturesFromArticle(2);
    // die(var_dump($test));

    foreach ($listNews as $key => $value) {
      $listNews[$key]['pictures'] = $pictures -> findPicturesFromArticle($listNews[$key]['id']);
    }

    return $listNews;
  }

}
