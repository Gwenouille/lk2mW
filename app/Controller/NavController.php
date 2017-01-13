<?php

namespace Controller;

use \W\Controller\Controller;

class NavController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function linkNav($target)
	{
		$this->show("DMIcontent/$target");
	}

}
