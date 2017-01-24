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
		$this->show("DMIcontent/NewsView", ['connectLinkChoice' => true]);
	}

	// affichage d'une news particulière TO DO ?
	public function page($id)
	{
    var_dump($id);
    $newsList = new NewsModel();
    $list = $newsList -> find($id);
		$this->show("admin/AdminNewsView", ['connectLinkChoice' => false]);
	}

	// création/modification d'une news
	public function edit()
	{
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
		$imgExt = array(".jpg",".jpeg",".gif",".png");
		// répertoire où sont stockées les images
		$dir = __DIR__;
		$cherche="app\Controller";
		$remplace="public\assets\images\\";
		$imgTargetDir = str_replace($cherche,$remplace,$dir);


		// Vérifie que le champ du titre de l'article est bien rempli
		if(isset($_POST['article_title']) && empty($_POST['article_title'])) {
			$errors['title'] = true;
		}

		// Vérifie que le champ du textarea est bien rempli
		if(isset($_POST['news_content']) && empty($_POST['news_content'])) {
			$errors['content'] = true;
		}

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
				$errorMaj = $majArticle-> insert($ArticleData,false);

		 		if($errorMaj == false) {
					$errors['creation'] = true;
				} else {

		 			// S'il y a des fichiers et pas d'erreur dans la création de l'article
					if(isset($_FILES['news_files_input']['size']) && ($_FILES['news_files_input']['size']=='0')) {

						// boucle pour examiner chaque input file
						for($i = 0;$i < count($_FILES['news_files_input']['name']); $i++) {
							// récupère les données des fichiers
							$fileData = array(
								"name" => $_FILES['news_files_input']['name'][$i],
								"type" => $_FILES['news_files_input']['type'][$i],
								"tmp_name" => $_FILES['news_files_input']['tmp_name'][$i],
								"error" => $_FILES['news_files_input']['error'][$i],
								"size" => $_FILES['news_files_input']['size'][$i]
							);

							/* GESTION DES ERREURS */
							// le fichier qui vient d'être ajouté est bien une image
							if(getimagesize($fileData['tmp_name'])) {
								// Poids de l'image ne dépasse pas celle autorisé pour l'upload
								if(filesize($fileData["tmp_name"])!=false) {
									//Image conforme aux formats d'image autorisés
									if(in_array(strrchr($fileData['name'], '.'), $imgExt)) {

										// Récupère l'ID de l'article qui vient d'etre créé
										$news_id=$errorMaj['id'];

										// création d'un dossier pour l'article (nom du dossier correspondant à l'ID de l'article)
										$dossier = $imgTargetDir.$news_id;

										if(!is_dir($dossier)){
											mkdir($dossier);
											}

											// enregistre l'image dans le dossier par numero
											$imageFileType = pathinfo(basename($fileData["name"]),PATHINFO_EXTENSION);
											$realFileName = pathinfo($fileData['name'], PATHINFO_FILENAME);
											$nameStorage = ($i+1).".".$imageFileType;

											// envoie des images dans le dossier concernant l'article créé
											if (move_uploaded_file($fileData["tmp_name"], $dossier."/".$nameStorage)) {
					    					// Si la création du fichier est reussi dans le dossier correspondant, entrée en BDD des données concernant l'image:
												$instance=ConnectionModel::getDbh();
												$sql = "INSERT INTO news_pictures(name,real_name,type,size,alt,news_id,state)
														 VALUES(:name,:real_name,:type,:size,:alt,:news_id,:state)";
												$requestImg = $instance ->prepare($sql);
												$requestImgOk = $requestImg->execute(array(
																"name"=>($i+1),
																"real_name"=>$realFileName,
																"type"=> $imageFileType,
																"size"=> $fileData['size'],
																"alt"=>$nameStorage,
																"news_id"=>$news_id,
																"state"=> 1,
												));
												// données image bien entrées dans la BDD
												if(!$requestImgOk) {
													$errors["imgBddError"] = "Une erreur est survenue lors de l'enregistrement des données de l'image";
												}
					    					} else {
					        				$errors["imgUploadError"] = "Une erreur est survenue lors du transfert des images";
										    }

									} else {
										$errors['fileError'][$i] = "L'image ".$fileData['name']." n'est pas conforme aux extensions autorisées : ".implode(', ', $imgExt);
									}
								} else {
									$errors['fileError'][$i] = "le poids de l'image excède le poids autorisé pour l'upload.";
								}
							} else {
								$errors['fileError'][$i] = "Le fichier ".$fileData['name']." n'est pas une image.";
							}
						}//Fermeture de la boucle for

					}// Fin de S'il y a des fichiers et pas d'erreur dans la création de l'article
		 		}
		 	}// Fin de la sectino création.

		}// Fin de "les champs sont bien remplis"

		if(isset($_POST['article_id'])) { $formConcern = "modification";}
		else {$formConcern = "creation";}
		if (isset($errors)) $this->showJson(["formConcern" =>$formConcern, "success"=>false,"errors"=>$errors]);
		else $this->showJson(["formConcern" =>$formConcern, "success"=>true]);

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
			if($articleList[$key]['state']==!0) $bCheck = "checked";
			$refreshData .= 'En ligne : <input id="checkbox'.$articleList[$key]['id'].'" class="newsCheckbox" type="checkbox" name="check" '.$bCheck.'>';
			$refreshData .= '</div><div class="newsListContent">';
			$refreshData .= '<h2>'.$articleList[$key]['title'].'</h2>';
			$refreshData .= '<p>Créé le '.$articleList[$key]['date_creation'].' - Modifié le '.$articleList[$key]['date_modification'].'</p>';
			$refreshData .= '<p>'.$articleList[$key]['content'].'</p></div>';
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
}
