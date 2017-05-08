<?php

error_reporting(E_ALL);
set_time_limit(0);

require_once './config.php';
require_once './lib/PHPMailer/PHPMailerAutoload.php';

$email_counter=0;
$email_body = file_get_contents('./template/'.trim(fgets($template)));
$host = trim(fgets($pool));

foreach($email_file as $email_to) {
$email_to=trim($email_to);

$mail = new PHPMailer;
$mail->Host = "localhost";
$mail->isSMTP();
$mail->SMTPAuth = false;
$mail->Port = 25;
$mail->SMTPKeepAlive = true;
$mail->setFrom($email_from, $source_displayname);
$mail->addReplyTo($email_from, $source_displayname);
$mail->sender = $email_from;
$mail->isHTML(true);
$mail->XMailer = 'mail';
$mail->CharSet = 'UTF-8';

echo "Envoi en cours ...".PHP_EOL;

$tag_unsubscribe = '<a href="http://'.$host.'/'.$callback.'?type=2&email='.base64_encode($email_to).'">'.$phrase_desabonnement.'</a>';
$tag_opener      = '<img src="http://'.$host.'/'.$callback.'?type=1&email='.base64_encode($email_to).'" alt="" height="1" width="1"></img>';
$tag_clicker     = 'http://'.$host.'/'.$callback.'?type=3&l='.$landingpage.'&email='.base64_encode($email_to).'';

$email_body_final = str_replace('DESABONNEMENT', $tag_unsubscribe, $email_body);
$email_body_final = str_replace('OPENR', $tag_opener, $email_body_final);
$email_body_final = str_replace('CLICKR', $tag_clicker, $email_body_final);

echo $host." : ".$email_to;

$mail->addAddress($email_to);
$mail->Subject = $email_subject;
$mail->Body    = $email_body_final;
$mail->AltBody = "";
$mail->send();
$mail->clearAddresses();
$email_counter++;

/*
if($email_counter>$limit_email){
  $host=fgets($pool);
  $mail = new PHPMailer;
  $mail->Host = $host;
  $mail->isSMTP();
  $mail->SMTPAuth = false;
  $mail->Port = 25;
  $mail->SMTPKeepAlive = true;

  $email_body = file_get_contents('./template/'.fgets($template));
  $email_counter=0;
}
*/
}
