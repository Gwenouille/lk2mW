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
		if ($target=="fabrication_additive"){
		$this->show("DMIcontent/$target", ['connectLinkChoice' => true]);
		} else {
		$this->show("DMIcontent/$target", ['connectLinkChoice' => false]);
		}
	}

}
