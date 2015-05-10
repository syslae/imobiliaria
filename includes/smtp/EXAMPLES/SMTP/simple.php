<?php

// send text/palin e-mail message
// using the mail server from localhost

// path to smtp.php from XPM2 package
require_once '../../smtp.php';

$mail = new SMTP;
$mail->From('me@domain.com');
$mail->AddTo('client@destination.com');
$mail->Text('It is simple to use XPM2');
$sent = $mail->Send('Hello World!');

echo $sent ? 'Success' : 'Error';

?>