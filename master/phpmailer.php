<?php
error_reporting(E_ALL);
set_time_limit(0);
require_once './config.php';
require_once './lib/PHPMailer/PHPMailerAutoload.php';

$host=fgets($pool);

$mail = new PHPMailer;
$mail->Host = $host;
//$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->SMTPAuth = false;
$mail->Port = 25; 
$mail->SMTPKeepAlive = true;
$email_counter=0;


foreach($db_file as $email_to) {

$mail->setFrom('contact@'.$host, $source_displayname);
$mail->addReplyTo('contact@'.$host, $replyto_displayname);
$mail->sender = 'root@'.$host;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

echo "Envoi en cours ...".PHP_EOL;
$tag_unsubscribe = '<a href="http://'.$host.'/'.$callback.'?type=2&email='.base64_encode($email_to).'">'.$phrase_desabonnement.'</a>';
$tag_opener      = '<img src="http://'.$host.'/'.$callback.'?type=1&email='.base64_encode($email_to).'" alt="" height="1" width="1"></img>';
$tag_clicker     = 'http://'.$host.'/'.$callback.'?type=3&l='.$landingpage.'&email='.base64_encode($email_to).'';

$email_body_final = str_replace('DESABONNEMENT', $tag_unsubscribe, $email_body);
$email_body_final = str_replace('OPENER', $tag_opener, $email_body_final);
$email_body_final = str_replace('click', $tag_clicker, $email_body_final);

$mail->addAddress(trim($email_to));
$mail->Subject = $email_subject;
$mail->Body    = $email_body_final;
$mail->AltBody = $email_altbody;
$mail->send();
$mail->clearAddresses();
echo $email_to.PHP_EOL;

$email_counter++;

if($email_counter>$limit_email){

  $host=fgets($pool);
  $mail = new PHPMailer;
  $mail->Host = $host;
  $mail->isSMTP();
  $mail->SMTPAuth = false;
  $mail->Port = 25;
  $mail->SMTPKeepAlive = true;
  $email_counter=0;

  print_r($host);
}
}
