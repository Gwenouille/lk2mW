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

		$myNews = new NewsModel();
		$fulfillMyNews = $myNews ->fulfillForm($_POST,$_FILES);
		$this->showJson($fulfillMyNews);
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
