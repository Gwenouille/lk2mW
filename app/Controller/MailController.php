<?php
namespace Controller;

use \W\Controller\Controller;


class MailController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function essai()
	{
		require 'PHPMailerAutoload.php';

		$mail = new PHPMailer();

		$mail->setFrom('list@example.com', 'List manager');
		$mail->Host   = 'smtp1.example.com;smtp2.example.com';
		$mail->Mailer = 'smtp';

		@mysqli_connect('localhost','root','password');
		@mysqli_select_db("my_company");
		$query = "SELECT full_name, email, photo FROM employee";
		$result = @mysqli_query($query);

		while ($row = mysqli_fetch_assoc($result))
		{
		    // HTML body
		    $body  = "Hello <font size=\"4\">" . $row['full_name'] . "</font>, <p>";
		    $body .= "<i>Your</i> personal photograph to this message.<p>";
		    $body .= "Sincerely, <br>";
		    $body .= "phpmailer List manager";

		    // Plain text body (for mail clients that cannot read HTML)
		    $text_body  = 'Hello ' . $row['full_name'] . ", \n\n";
		    $text_body .= "Your personal photograph to this message.\n\n";
		    $text_body .= "Sincerely, \n";
		    $text_body .= 'phpmailer List manager';

		    $mail->Body    = $body;
		    $mail->AltBody = $text_body;
		    $mail->addAddress($row['email'], $row['full_name']);
		    $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');

		    if(!$mail->send())
		        echo "There has been a mail error sending to " . $row['email'] . "<br>";

		    // Clear all addresses and attachments for next loop
		    $mail->clearAddresses();
		    $mail->clearAttachments();
		}
	}
}
