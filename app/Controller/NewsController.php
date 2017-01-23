<?php

namespace Controller;

use \W\Controller\Controller;
use Model\NewsModel;
use Model\NewsPicturesModel;
use \W\Model\Model;
use \W\Security\AuthentificationModel;

class NewsController extends Controller
{
	// affichage de la liste des news
	public function home()
	{
	$this->show("news/NewsView", ['connectLinkChoice' => false]);
	}

	// affichage d'une news particulière
	public function page($id)
	{
    var_dump($id);
    $newsList = new NewsModel();
    $list = $newsList -> find($id);
	$this->show("news/NewsView", ['connectLinkChoice' => false]);
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

	$this->show("news/NewsView", ['connectLinkChoice' => false, "articleList" => $listArticles, "showArticleData" => $article[0]]);

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

		// Vérifie que le champ du titre de l'article est bien rempli
		if(isset($_POST['article_title']) && empty($_POST['article_title'])) {
			$errors['title'] = true;
		}

		// Vérifie que le champ du textarea est bien rempli
		if(isset($_POST['news_content']) && empty($_POST['news_content'])) {
			$errors['content'] = true;
		}

		// les champs sont bien remplis
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

		 	} else { // création d'un article
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
		 	}
<<<<<<< HEAD
			if($errorMaj != false) { $success = true; }
			else { $success = false; }
=======
			if($errorMaj != true) { $errors['creation'] = true; }
>>>>>>> e41d93e63db6a2bc6be10ca819e8f9a3f1ac2c1a
		}

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
						$refreshData .= '<input type="checkbox" name="check" '.$bCheck.'>';
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

}
