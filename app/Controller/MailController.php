<?php

namespace Controller;

use \W\Controller\Controller;
use Model\MailModel;
use Model\MessagesModel;

class MailController extends Controller
{

	/**
	 * Test envoi de mail
	 */
	// public function essai()
	// {
	// 	var_dump('class: '.__CLASS__);
	// 	var_dump('method: '.__METHOD__);
	// 	$mail=new MailModel();
	// 	$mail->essai();
	// }

	/**
	 * Test messageModel
	 */
	public function essai()
	{
		var_dump('class: '.__CLASS__);
		var_dump('method: '.__METHOD__);
		$message=new MessagesModel(1,'ceci est mon message','la date',3);
		var_dump($message);
		var_dump($message->__get('id'));
	}
}
