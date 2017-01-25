<?php

namespace Controller;

use \W\Controller\Controller;
use Model\NewsModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show("default/Home", ['connectLinkChoice' => false]);
	}

	/**
	 * redirection: navigation pure
	 */
	public function nav($target)
	{
		if ($target=="fabrication_additive"){
			$news = new NewsModel();
			$newsList=$news->findNewsFromUser(3); //3 is admin...

			$this->show("DMIcontent/$target", ['connectLinkChoice' => true, 'newsList' => $newsList]);
		} else {
			$this->show("DMIcontent/$target", ['connectLinkChoice' => false]);
		}
	}

	public function news()
	{
		$this->show("default/Home", ['connectLinkChoice' => false]);
	}

	public function contact()
	{
		$this->show("default/ContactView", ['connectLinkChoice' => false]);
	}


}
