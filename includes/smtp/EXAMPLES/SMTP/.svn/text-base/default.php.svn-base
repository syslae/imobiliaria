<?php

// send text/html e-mail message
// 1'st using the mail server from localhost, if fail,
// 2'nd sending directly to the client smtp server

// E_ALL -> debugging
// false -> public
error_reporting(E_ALL);
// 0 -> no time limit
set_time_limit(0);

// path to smtp.php from XPM2 package
require_once '../../smtp.php';

$mail = new SMTP;
$mail->Delivery('local-client');
$mail->From('me@domain.com', 'my name');
$mail->AddTo('client@destination.com', 'user name');
$mail->Html('<font color="red"><b><u>It is simple to use XPM2</u></b></font>');
$sent = $mail->Send('Hello World!');

echo $sent ? 'Success' : 'Error';

// for debugging
echo $mail->result;

?>