<?php
$host = '';

$email_subject = '';
$return_path = 'root@'.$host;
$source_email = 'contact@'.$host;
$source_displayname  = '';

$replyto_email = 'contact@'.$host;
$replyto_displayname = '';

$callback = 'handle.php';
$landingpage = '';
$phrase_desabonnement = 'suivez ce lien pour votre désinscription.';
$db_file = file('./database/'.$argv[1]);
$email_body = file_get_contents('./template/'.$argv[2].'.htm');
$email_altbody = file_get_contents('./template/'.$argv[2].'.txt');
