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
    die();
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

	// Récupération des articles à son actif
    $newsList = new NewsModel();
    $listArticles = $newsList -> findNewsFromUser($userId);

	// Ajout des images liées aux articles dans le tableau, sous la clé 'pictures'
	$pictures = new NewsPicturesModel();
	foreach ($listArticles as $key => $value) {
		$listArticles[$key]['pictures'] = $pictures -> findPicturesFromArticle($listArticles[$key]['id']);
	}

	$this->show("news/NewsView", ['connectLinkChoice' => false, "articleList" => $listArticles]);

	}

}
