<?php
error_reporting(E_ALL);
set_time_limit(0);
require_once './config.php';
require_once './swiftmailer/lib/swift_required.php';
echo 'Lancement de la campagne: ' . date('r') . ' ...' . PHP_EOL;
$transport = Swift_SmtpTransport::newInstance('localhost', 25);
$mailer = Swift_Mailer::newInstance($transport);
$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(300, 60));
$mailer->registerPlugin(new Swift_Plugins_ThrottlerPlugin(
			70, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE
			));
foreach ($db_file as $email_to) {
	$email_to=trim($email_to);
	if(Swift_Validate::email($email_to)) {
		$tag_unsubscribe = '<a href="http://'.$host.'/'.$callback.'?type=2&email='.base64_encode($email_to).'">'.$phrase_desabonnement.'</a>';
		$tag_opener      = '<img src="http://'.$host.'/'.$callback.'?type=1&email='.base64_encode($email_to).'" alt="" height="1" width="1"></img>';
		$tag_clicker     = 'http://'.$host.'/'.$callback.'?type=3&l='.$landingpage.'&email='.base64_encode($email_to);

		$email_body_final = str_replace('DESABONNEMENT', $tag_unsubscribe, $email_body);
		$email_body_final = str_replace('OPENER', $tag_opener, $email_body_final);
		$email_body_final = str_replace('click', $tag_clicker, $email_body_final);

		$message = Swift_Message::newInstance($email_subject)
			->setFrom(array($source_email => $source_displayname))
			->setTo($email_to)
			->setBody($email_body_final, 'text/html')
			->setCharset('utf-8')
			->setReturnPath($return_path);

		$msgId = $message->getHeaders()->get('Message-ID');
		$msgId->setId(time() .  uniqid() . '@mailjet.com');
		$mailer->send($message, $failures);
		echo "Envoi: ".$email_to.PHP_EOL;

	}
}
