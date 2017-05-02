<?php
$email_from = $argv[5];
$email_subject = $argv[4];
$source_displayname = $argv[6];

$callback = 'handle.php';
$landingpage = 'test';

$phrase_desabonnement = 'suivez ce lien pour votre désinscription.';
$db_file = file('./database/'.$argv[1]);
$template = fopen('./template/'.$argv[2], 'r');
$pool = fopen('./pool/'.$argv[3], 'r');
$limit_email=4;
