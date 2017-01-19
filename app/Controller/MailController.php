<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MailModel;

class MailController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function essai()
	{
		var_dump('class: '.__CLASS__);
		var_dump('method: '.__METHOD__);
		$mail=new MailModel();
		$mail->essai();
	}
}
