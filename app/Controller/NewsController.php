<?php

namespace Controller;

use \W\Controller\Controller;
use Model\NewsModel;
use Model\NewsPicturesModel;
use \W\Model\Model;
use \W\Security\AuthentificationModel;
use \W\Model\ConnectionModel;

class NewsController extends Controller
{
	// affichage de la liste des news dans la vue idoine
	public function home()
	{
		$news = new NewsModel();
		$newsList=$news->findNewsFromUser(3); //3 is admin...

		$this->show("DMIcontent/NewsView", ['connectLinkChoice' => true, 'newsList' => $newsList]);
	}

	// affichage d'une news particulière TO DO ?
	// public function page($id)
	// {
  //   var_dump($id);
  //   $newsList = new NewsModel();
  //   $list = $newsList -> find($id);
	// 	$this->show("admin/AdminNewsView", ['connectLinkChoice' => false]);
	// }

	// création/modification d'une news
	public function edit() {
    // cette page n'est accessible qu'à l'admin ou superadmin
    $this-> AllowTo(['1','2']);

		// Récupération de l'ID du user en session actuellement
		$user = new AuthentificationModel();
		$userId = $user -> getLoggedUser()['id'];

		// Récupération des articles (content + images) à son actif
    $newsList = new NewsModel();
    $listArticles = $newsList -> findNewsFromUser($userId,"");

    $article[0] = [
    	"id" => null,
    	"title" => "",
    	"content" => "",
     ];

		$this->show("admin/AdminNewsView", ['connectLinkChoice' => true, "articleList" => $listArticles, "showArticleData" => $article[0]]);

	}

	// récupère les données du formulaire de gauche pour les renvoyer vers le formulaire de droite (voir l'article à droite pour le modifier)
	public function showNews() {

		// Récupération de l'ID du user en session actuellement
		$user = new AuthentificationModel();
		$userId = $user -> getLoggedUser()['id'];

		// Récupération de l'article (content + images) à afficher
	  $newsList = new NewsModel();
    $listArticles = $newsList -> findNewsFromUser($userId,$_POST['articleId'])[0];

		$this->showJson(["ArticleData"=>$listArticles]);
	}

	// récupère les données de l'article modifié pour faire une mise à jour de l'article en BDD
	public function newsModify() {
		// format tolérés pour les images
		$imgExt = array(".jpg",".jpeg",".gif",".png",".JPG",".JPEG",".GIF",".PNG");
		// répertoire où sont stockées les images
		$dir = __DIR__;
		$cherche="app\Controller";
		$remplace="public\assets\images\\news\\";
		$imgTargetDir = str_replace($cherche,$remplace,$dir);


		// Vérifie que le champ du titre de l'article est bien rempli
		if(isset($_POST['article_title']) && empty($_POST['article_title'])) {
			$errors['title'] = true;
		}

		// Vérifie que le champ du textarea est bien rempli
		if(isset($_POST['news_content']) && empty($_POST['news_content'])) {
			$errors['content'] = true;
		}

		if(isset($_POST['article_id'])) { $formConcern = "modification";}
		else {$formConcern = "creation";}

		// // les champs sont bien remplis
		if(!isset($errors)) {
			$majArticle = new NewsModel();

			// si une ID est présente alors c'est une mise à jour de l'article
			if(isset($_POST['article_id'])) {
				// prépare les données qui seront mises en BDD
				$ArticleData = array(
					"title" => htmlentities($_POST['article_title']),
					"content" => $_POST['news_content'],
      				"date_modification" => date('Y-m-d H:i:s'),
      			);
				// mise à jour des données en BDD
				$errorMaj = $majArticle-> update($ArticleData,$_POST['article_id'],false);
				if($errorMaj == false) { $errors['maj'] = true; }
		 	}	else { // création d'un article
	 			// récupération de l'ID de l'utilisateur connecté
				$user_id=$_SESSION['user']['id'];

				$ArticleData = array(
					"title" => htmlentities($_POST['article_title']),
					"content" => $_POST['news_content'],
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
					$this->showJson(["formConcern" =>$formConcern, "success"=>false,"errors"=>true,"errorsChampBDD"=>$errors]);
			} else {

				// Récupère l'ID de l'article qui vient d'etre créé
				$news_id=$errorMaj['id'];
				// boucle pour examiner chaque input file
				for($i = 0; $i < count($_FILES['news_files_input']['name']); $i++) {
					// S'il y a des fichiers et pas d'erreur dans la création de l'article
					if($_FILES['news_files_input']['size'][$i] != 0 && $_FILES['news_files_input']['error'][$i] != 4 ) {

						// récupère les données des fichiers
						$fileData = array(
							"name" => $_FILES['news_files_input']['name'][$i],
							"type" => $_FILES['news_files_input']['type'][$i],
							"tmp_name" => $_FILES['news_files_input']['tmp_name'][$i],
							"error" => $_FILES['news_files_input']['error'][$i],
							"size" => $_FILES['news_files_input']['size'][$i]
						);

						// le fichier qui vient d'être ajouté est bien une image
						if(getimagesize($fileData['tmp_name'])) {
							// Poids de l'image ne dépasse pas celle autorisé pour l'upload
							if(filesize($fileData["tmp_name"]) != false) {
								//Image conforme aux formats d'image autorisés
								if(in_array(strtolower(strrchr($fileData['name'], '.')), $imgExt)) {
									// création d'un dossier pour l'article (nom du dossier correspondant à l'ID de l'article)
									$dossier = $imgTargetDir.$news_id;
									if(!is_dir($dossier)){
										mkdir($dossier);
									}
									// enregistre l'image dans le dossier par numero
									$imageFileType = pathinfo(basename($fileData["name"]),PATHINFO_EXTENSION);
									$realFileName = pathinfo($fileData['name'], PATHINFO_FILENAME);
									$nameStorage = ($i+1).".".$imageFileType;

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
									// données image bien entrées dans la BDD
									if($requestImgOk) {
										// envoie des images dans le dossier concernant l'article créé
										if (!move_uploaded_file($fileData["tmp_name"], $dossier."/".$nameStorage)) {
												// récupère l'ID de l'image en BDD
												$imgMod = new NewsPicturesModel();
												$imgId = $imgMod->lastInsert();
												// efface les données de l'image en BDD
												$imgMod-> delete($imgId);
											$errors["fileError"][$i] = "Une erreur est survenue lors du transfert de l'image ".$realFileName;
											}
									} else {
										$errors["fileError"][$i] = "Une erreur est survenue lors de l'enregistrement des données de l'image ".$realFileName;
									}
								}	else {
									$errors['fileError'][$i] = "L'image ".$fileData['name']." n'est pas conforme aux extensions autorisées : ".implode(', ', $imgExt);
								}
							} else {
									$errors['fileError'][$i] = "le poids de l'image ".$fileData['name']." excède le poids autorisé pour l'upload.";
							}
						} else {
								$errors['fileError'][$i] = "Le fichier ".$fileData['name']." n'est pas une image.";
						}
					}
				}
				// si des erreurs dans les images
				if(isset($errors['fileError'])) {
					$this->showJson(["formConcern" =>$formConcern, "success"=>true, "errors" =>true, "errorsType" =>$errors['fileError']]);
				} else {
					$this->showJson(["formConcern" =>$formConcern, "success"=>true, "errors" =>false]);
				}



		 		}
		 	}// Fin de la section création.
			else {  // Si les champs titre et contenu ne sont pas remplis correctement
			$this->showJson(["formConcern" =>$formConcern, "success"=>false,"errors"=>true,"errorsChamp" => $errors]);
			}
	}

	// Mise à jour du menu de gauche de la page d'éition de news
	public function newsAjaxModify() {
		// Récupération de l'ID du user en session actuellement
		$user = new AuthentificationModel();
		$userId = $user -> getLoggedUser()['id'];

		// Récupération de l'article (content + images) à afficher
		$newsList = new NewsModel();
		$articleList = $newsList -> findNewsFromUser($userId,"");
		$refreshData="";
		foreach ($articleList as $key => $value) {
			$refreshData .= '<li>';
			$refreshData .= "<form action='".$this->generateUrl('news_edit')."' method='post' class='form_listArticle'>";
			$refreshData .= '<div class="newsListCheckbox">';
			$bCheck ="";
			if($articleList[$key]['state']!=0) $bCheck = "checked";
			$refreshData .= 'En ligne : <input id="checkbox'.$articleList[$key]['id'].'" class="newsCheckbox" type="checkbox" name="check" '.$bCheck.'>';
			$refreshData .= '</div><div class="newsListContent">';
			$refreshData .= '<h2>'.$articleList[$key]['title'].'</h2>';
			$refreshData .= '<p>Créé le '.$articleList[$key]['date_creation'].' - Modifié le '.$articleList[$key]['date_modification'].'</p>';
			$refreshData .= '<p>'.$articleList[$key]['content'].'</p></div>';
			if (!empty($articleList[$key]['pictures'])) {
				$refreshData .= "<div class='newsListImgCheckbox'>";
				$pictures = $articleList[$key]['pictures'];
				foreach ($pictures as $key2 => $value2) {
					$bCheck2 ="";
					// var_dump($pictures[$key2]['state']);
					if($pictures[$key2]['state']!=0)	{	$bCheck2 = "checked"; }
						$refreshData .= "<p><input id='imgcheckbox'". $articleList[$key]['id'] . "_" . $pictures[$key2]['id'] . " class='newsImgCheckbox' type='checkbox' name='check' ". $bCheck2 .">". $pictures[$key2]['real_name'] . "</p>";
				}
				$refreshData .= "</div>";
			}
			$refreshData .= '<div class="newsListAction">';
			$refreshData .= '<p><input type="submit" name="modifyNews" value="Modifier"></p>';
			$refreshData .= '<input type="hidden" value="'.$articleList[$key]['id'].'" name="articleId">';
			$refreshData .= '</div>';
			$refreshData .= '</form>';
			$refreshData .= '</li>';
		}
		echo $refreshData;
	}

	// Bascule de la visibilité d'une news qd on presse le checkbox: changement de state en BDD dans la table news.
	public function newsToggleCheckbox() {

		$news_id=$_POST['id'];
		$news_id=substr($_POST['id'],8,strlen($news_id)-8 );
		if ($_POST['state']==='true'){$state=1;}
		else {$state=0;}

		$data= array(
			'state'=>$state
		);
		$majArticle = new NewsModel();
		$errorMaj = $majArticle-> update($data,$news_id,true);
		if($errorMaj == false) { $errors['maj'] = true; }
	}

	// Bascule de la visibilité d'une news qd on presse le checkbox: changement de state en BDD dans la table news.
	public function newsToggleImgCheckbox() {
		$data=$_POST['id'];
		$data=substr($_POST['id'],11,strlen($data)-11 );
		$news_id=explode('_',$data)[0];
		$img_id=explode('_',$data)[1];
		// die(var_dump($news_id,$img_id));

		if ($_POST['state']==='true'){$state=1;}
		else {$state=0;}

		$data= array(
			'state'=>$state
		);
		$majImage = new NewsPicturesModel();
		$errorMaj = $majImage-> update($data,$img_id,true);
		if($errorMaj == false) { $errors['maj'] = true; }
	}
}
