<?php

namespace Model;

use \W\Model\Model;

class MailModel extends Model {

  private $subject;
  private $body;
  private $text_body;
  private $targets=array();

  public function setSubject($subject){
    $this->subject=$subject;
  }
  public function setBody($body){
    $this->body=$body;
  }
  public function setTextBody($text_body){
    $this->text_body=$text_body;
  }
  public function addTarget($target){
    array_push($this->targets,$target);
  }

  public function sendmail()
  {
		$mail = new \PHPMailer();

    //Enable SMTP debugging.
    $mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();

    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password
    $mail->Username = "gwenael.lepage@wanadoo.fr";
    $mail->Password = "140979";

		// $mail->setFrom('gwenael@lepage@wanadoo.fr', 'Gwenael Le Page');
		$mail->Host   = 'smtp.orange.fr';
		$mail->Mailer = 'smtp';

    $mail->From = "gwenael.lepage@wanadoo.fr";
    $mail->FromName = "DMI";

    // Mail subject
    $subject = $this->subject;

    // HTML body
    $body  = $this->body;

    // Plain text body (for mail clients that cannot read HTML)
    $text_body  = $this->text_body;


    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $text_body;
    foreach ($this->targets as $key => $value) {
      $mail->addAddress($this->targets[$key]);
    }
    $mail->SMTPDebug=0;
    if(!$mail->send())
        echo "There has been a mail error : ".$mail->ErrorInfo;

    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();

  }
}
