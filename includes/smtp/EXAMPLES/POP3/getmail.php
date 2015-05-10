<?php

/***************************************************************************************
 *                                                                                     *
 * This file is part of the XPertMailer package (http://xpertmailer.sourceforge.net/)  *
 *                                                                                     *
 * XPertMailer is free software; you can redistribute it and/or modify it under the    *
 * terms of the GNU General Public License as published by the Free Software           *
 * Foundation; either version 2 of the License, or (at your option) any later version. *
 *                                                                                     *
 * XPertMailer is distributed in the hope that it will be useful, but WITHOUT ANY      *
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A     *
 * PARTICULAR PURPOSE.  See the GNU General Public License for more details.           *
 *                                                                                     *
 * You should have received a copy of the GNU General Public License along with        *
 * XPertMailer; if not, write to the Free Software Foundation, Inc., 51 Franklin St,   *
 * Fifth Floor, Boston, MA  02110-1301  USA                                            *
 *                                                                                     *
 * XPertMailer SMTP & POP3 PHP Mail Client. Can send and read messages in MIME Format. *
 * Copyright (C) 2006  Tanase Laurentiu Iulian                                         *
 *                                                                                     *
 ***************************************************************************************/

// get (original) imformation about the last e-mail stored in mail server
// this is the simple example

error_reporting(E_ALL);
set_time_limit(0);

// path to pop3.php from XPM2 package
require_once '../../pop3.php';

// connect to pop3 server: mail.domain.com, port: 995, TLS/SSL: enable
if($conn = POP3::Connect('mail.domain.com', 'username', 'password', 995, 'ssl')){
	$stat = POP3::pStat($conn);
	// die('Messages: '.$stat[0].', in total '.$stat[1].' Bytes');
	if($stat[0] > 0){
		//$data = POP3::pRetr($conn, 1); // <- get first mail
		$data = POP3::pRetr($conn, $stat[0]); // <- get last mail
		POP3::pQuit($conn);
		echo $data ? $data : 'Error';
	}else echo 'Mail is empty';
}else echo 'Can not connect';

?>