<?php
require_once('class.phpmailer.php');


$mail = new PHPMailer(true);

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "blogit.technofox.co.in"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "blogit.technofox.co.in"; // sets the SMTP server
  $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "info@blogit.technofox.co.in"; // SMTP account username
  $mail->Password   = ";V4_73r!qb_)";        // SMTP account password
  $mail->AddAddress('amitsmakkar@gmail.com', 'John Doe');
  $mail->SetFrom('info@blogit.technofox.co.in', 'First Last');
  $mail->AddReplyTo('amitsmakkar@gmail.com', 'First Last');
  $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML("<h1>Haiiiiii</h1>");
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>
