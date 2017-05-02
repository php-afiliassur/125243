<?php
$host = 'regions-departements.com';

$email_subject = 'test';
$return_path = 'root@'.$host;
$source_email = 'contact@'.$host;
$source_displayname  = 'test';

$replyto_email = 'contact@'.$host;
$replyto_displayname = 'test';

$callback = 'handle.php';
$landingpage = 'test';
$phrase_desabonnement = 'suivez ce lien pour votre désinscription.';
$db_file = file('./database/'.$argv[1]);
$email_body = file_get_contents('./template/'.$argv[2].'.htm');
$email_altbody = file_get_contents('./template/'.$argv[2].'.txt');
$pool = fopen('./pool/'.$argv[3], 'r');
$limit_email=2;
