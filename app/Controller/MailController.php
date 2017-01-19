<?php

namespace Controller;

use \W\Controller\Controller;
require ('../testfile.php');


class MailController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function test()
	{
		// require '../testfile.php';
		// require 'PHPMailerAutoload.php';

		$mail = new PHPMailer();

		$this->show("default/home", ['connectLinkChoice' => false]);
	}

}
