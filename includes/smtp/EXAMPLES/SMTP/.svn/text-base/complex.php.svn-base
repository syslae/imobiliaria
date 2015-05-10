<?php

// send text/plain and text/html multiple e-mail messages (multipart/alternative)
// send to multiple e-mail addresses (Cc and Bcc)
// attach an embed HTML image (inline) and file (attachment)
// using a relay smtp server with authentication and TLS (SSL) connection
// notice: make sure you have OpenSSL module (extension) enable on your PHP configuration in order to use TLS/SSL connection

// E_ALL -> debugging
// false -> public
error_reporting(E_ALL);
// 0 -> no time limit
set_time_limit(0);

// path to smtp.php from XPM2 package
require_once '../../smtp.php';

$mail = new SMTP;
$mail->Delivery('relay');
$mail->Relay('pop.viavale.com.br', 'v1349404', 'bj9404', 25, 'login', false);
$mail->TimeOut(10);
$mail->Priority('high');
$mail->From('contato@baladajovem.com.br', 'BaladaJovem');
$mail->AddTo('thiago@agenciaweb.net', 'Thiago Genehr');
$mail->AddCc('thiago_genehr@yahoo.com.br', 'EU');
//$mail->AddBcc('hidden@host.com');
$mail->Text('Text version of the message');
//$mail->Html('<font color="red"><b><u>HTML version of the message</u></b></font><br><br><i>Powered by</i> <img src="photo.gif">');
//$mail->AttachFile('image.gif', 'photo.gif', 'autodetect', 'inline');
//$mail->AttachFile('file.zip');
$sent = $mail->Send('Hello World!');

echo $sent ? 'Success' : 'Error';

// for debugging
echo '<br>Result: '.$mail->result;

?>