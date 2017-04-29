<?php
if ( isset($_GET['email']) &&
    !empty($_GET['email']) &&
     isset($_GET['type'])  &&
    !empty($_GET['type'])  ) {
        if ($_GET['type']==1) {
            $email=trim(base64_decode($_GET['email']));
            $hfile = fopen('/var/log/ouvreur', 'a');
            fwrite($hfile, $email.PHP_EOL);
            fclose($hfile);
        }
        if ($_GET['type']==2) {
            $email=trim(base64_decode($_GET['email']));
            $hfile = fopen('/var/log/desabonnement', 'a');
            fwrite($hfile, $email.PHP_EOL);
            fclose($hfile);
            header('Location: /vous-remercie.htm');
        }
        if ($_GET['type']==3) {
            $email=trim(base64_decode($_GET['email']));
            $hfile = fopen('/var/log/cliqueur', 'a');
            fwrite($hfile, $email.PHP_EOL);
            fclose($hfile);
            header('Location: /'.$_GET['l']);
        }
}
