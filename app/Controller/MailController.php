<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\MailModel;

class MailController extends Controller
{

	/**
	 * Test envoi de mail
	 */
	public function essai()
	{
		var_dump('class: '.__CLASS__);
		var_dump('method: '.__METHOD__);
		$mail=new MailModel();
		$mail->essai();
	}
	
	/**
	 * Test envoi de mail
	 */
	public function essai()
	{
		var_dump('class: '.__CLASS__);
		var_dump('method: '.__METHOD__);
		$mail=new MailModel();
		$mail->essai();
	}
}
