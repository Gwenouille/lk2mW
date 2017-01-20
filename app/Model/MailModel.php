<?php

namespace Model;

use \W\Model\Model;

class MailModel extends Model {

  public function essai()
  {
    var_dump('class: '.__CLASS__);
		var_dump('method: '.__METHOD__);

		$mail = new \PHPMailer();

		// $mail->setFrom('gwenael@lepage@wanadoo.fr', 'Gwenael Le Page');
		$mail->Host   = 'smtp.orange.fr';
		$mail->Mailer = 'smtp';

    $mail->From = "gwenael.lepage@wanadoo.fr";
    $mail->FromName = "Gwenael Le Page";

    // HTML body
    $body  = "Envoyé depuis la page DMI";

    // Plain text body (for mail clients that cannot read HTML)
    $text_body  = "Hello again";

    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    $mail->addAddress('gwenael.le-page@orange.fr','GLP');
    $mail->addAddress('mouq_s@yahoo.fr','Poulette');

    if(!$mail->send())
        echo "There has been a mail error : ".$mail->ErrorInfo;

    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();

  }
}
