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

// show (text/html) information about the last e-mail stored in mail server
// you can download attachments and read messages in MIME format
// this is the complex example

error_reporting(E_ALL);
set_time_limit(0);

// config --------
$cdir = 'attachments'; // string - directory where the attachments will be write/read, must have: create+read+write+delete permissions
$host = 'mail.domain.com'; // string
$user = 'username'; // string
$pass = 'password'; // string
$port = 110; // integer
$vssl = false; // boolean, string - tls, string - ssl
// config --------

// HTML tags and properties banned from security reason, add more if you want
$btags = array('html', 'title', 'head', 'body', 'script', 'frame', 'iframe', 'embed', 'applet', 'object');
$bprop = array('onclick', 'ondbclick', 'onmouseover', 'onmouseout', 'onload', 'onunload');

$csep = "#TypE~DatA#";
$unique = 0;
// show/download attachment
if(isset($_GET['down'], $_GET['fl']) && ($_GET['down'] == "inline" || $_GET['down'] == "attachment") && trim($_GET['fl']) != ""){
	$file = trim($_GET['fl']);
	$exp1 = explode('/', $file);
	$file = $exp1[count($exp1)-1];
	$exp2 = explode('\\', $file);
	$file = $exp1[count($exp2)-1];
	$path = $cdir.'/'.$file;
	if(file_exists($path) && is_readable($path)){
		$data = file_get_contents($path);
		$exp3 = explode($csep, $data);
		if(count($exp3) == 2){
			$desc = strstr($file, '.') ? $_GET['down'].'; filename="'.$file.'"' : $_GET['down'];
			header('Content-Type: '.$exp3[0]);
			header('Content-Length: '.strlen($exp3[1]));
			header('Content-Disposition: '.$desc);
			echo $exp3[1];
		}else echo 'Error 2: can\'t read!';
	}else echo 'Error 1: can\'t read!';
	exit;
}

// path to pop3.php from XPM2 package
require_once '../../pop3.php';

// get e-mail
$conn = POP3::Connect($host, $user, $pass, $port, $vssl) or die('Error 1: Can not connect!');
$stat = POP3::pStat($conn) or die('Error 2: Can not get number of e-mails!');
if($stat[0] == 0) die('Notice 1: Mail is empty, try to send an e-mail to this account.');
$data = POP3::pRetr($conn, $stat[0]) or die('Error 3: Can not read the last e-mail!');
POP3::pQuit($conn);

// if you can't connect to POP3 server, then uncomment this line to read from file
// $data = file_get_contents('mail.txt');

// show e-mail
$msg = FUNC::split_content($data);
if(!($msg && isset($msg['header'], $msg['body']))) die('Error 4: Invalid e-mail message!');

$show = array();
foreach($msg['header'] as $harr){
	// prevent duplicate values
	foreach($harr as $hname => $hvalue){
		$cname = strtolower($hname);
		if($cname == "subject")  $show['Subject'] = $hvalue;
		elseif($cname == "from") $show['From'] = $hvalue;
		elseif($cname == "to")   $show['To'] = $hvalue;
		elseif($cname == "date") $show['Date'] = $hvalue;
		// add more if you want :)
	}
}

$info = '';
if(count($show) > 0){
	foreach($show as $hnam => $hval) $info .= '<b>'.$hnam.'</b>: '.htmlentities($hval)."<br>\n";
}

function tag_ban($html, $tags, $prop){
	$tfind1 = $trepl1 = $tfind2 = $trepl2 = $pfind = $prepl = array();
	foreach($tags as $tname){
		$tfind1[] = '<'.$tname;
		$trepl1[] = '<X'.$tname;
		$tfind2[] = '</'.$tname;
		$trepl2[] = '</X'.$tname;
	}
	foreach($prop as $pname){
		$pfind[] = ' '.$pname.'=';
		$prepl[] = ' X'.$pname.'=';
	}
	$html = str_ireplace($tfind1, $trepl1, $html);
	$html = str_ireplace($tfind2, $trepl2, $html);
	return str_ireplace($pfind, $prepl, $html);
}

function save_file($file, $data){
	$open = fopen($file, 'w');
	fwrite($open, $data);
	fclose($open);
}

/**
 * @function    size_readable
 * @author      Aidan Lister <aidan@php.net>
 * @link        http://aidanlister.com/repos/v/function.size_readable.php
 */
function size_readable($size, $unit = null, $retstring = null, $si = true){
    if($si === true){
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        $mod   = 1000;
    }else{
        $sizes = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
        $mod   = 1024;
    }
    $ii = count($sizes) - 1;
    $unit = array_search((string) $unit, $sizes);
    if($unit === null || $unit === false) $unit = $ii;
    if($retstring === null) $retstring = '%01.2f %s';
    $i = 0;
    while($unit != $i && $size >= 1024 && $i < $ii){
        $size /= $mod;
        $i++;
    }
    return sprintf($retstring, $size, $sizes[$i]);
} // End size_readable() ---------

function put_embed($html, $src){
	$find1 = $repl1 = $find2 = $repl2 = array();
	foreach($src as $rimg){
		if($rimg['type'] == "cid"){
			$find1[] = ' src="cid:'.$rimg['value'].'"';
			$find2[] = ' src=cid:'.$rimg['value'];
			$repl1[] = ' src="?down=inline&fl='.$rimg['value'].'"';
			$repl2[] = ' src="?down=inline&fl='.$rimg['value'].'"';
		}elseif($rimg['type'] == "name"){
			$find1[] = ' src="'.$rimg['value'].'"';
			$find2[] = ' src='.$rimg['value'];
			$repl1[] = ' src="?down=inline&fl='.$rimg['value'].'"';
			$repl2[] = ' src="?down=inline&fl='.$rimg['value'].'"';
		}
	}
	$html = str_ireplace($find1, $repl1, $html);
	return str_ireplace($find2, $repl2, $html);
}

$content = '';
if($msg['multipart'] == "no"){
	// simple message
	foreach($msg['body'] as $barr){
		$ishtml = $encode = $data = false;
		foreach($barr as $bname => $bvalue){
			$sname = strtolower($bname);
			if($sname == "content-type"){
				if(substr($bvalue, 0, 9) == "text/html") $ishtml = true;
			}elseif($sname == "content-transfer-encoding") $encode = $bvalue;
		}
		if(isset($barr['Data'])){
			$content = $encode ? FUNC::decode_content($barr['Data'], $encode) : $barr['Data'];
			$content = $ishtml ? tag_ban($content, $btags, $bprop) : nl2br(htmlentities($content));
		}
	}
}elseif($msg['multipart'] == "yes"){
	// multipart message
	$part = $attid = array();
	foreach($msg['body'] as $barr){
		$ctype = $encode = $disp = $fname = $cid = false;
		foreach($barr as $bname => $bvalue){
			$sname = strtolower($bname);
			if($sname == "content-type"){
				$exp = explode('; ', $bvalue);
				$ctype = strtolower($exp[0]);
			}elseif($sname == "content-transfer-encoding"){
				$encode = $bvalue;
			}elseif($sname == "content-disposition"){
				$exp = explode('; ', $bvalue);
				$disp = strtolower($exp[0]);
				if(count($exp) > 1){
					foreach($exp as $ifile){
						$fget = substr($ifile, 0, 9);
						if($fget == "filename="){
							$fname = substr($ifile, 9);
							$fname = str_replace('"', '', $fname);
						}
					}
				}
			}elseif($sname == "content-id") $cid = str_replace(array('<', '>'), '', $bvalue);
		}
		if(isset($barr['Data'])){
			$decode = $encode ? FUNC::decode_content($barr['Data'], $encode) : $barr['Data'];
			$part[] = array('multipart' => $barr['Multipart'], 'type' => $ctype, 'disp' => $disp, 'name' => $fname, 'cid' => $cid, 'data' => $decode);
		}
	}
	if(count($part) > 0){
		$mixed = $related = $alternative = false;
		foreach($part as $carr){
			if(substr($carr['multipart'], -11) == "alternative"){
				if($carr['type']){
					if($carr['type'] == "text/plain") $alternative['text'] = $carr['data'];
					elseif($carr['type'] == "text/html") $alternative['html'] = $carr['data'];
				}
			}elseif(substr($carr['multipart'], -7) == "related"){
				if($carr['type']){
					if($carr['type'] == "text/plain") $related['text'] = $carr['data'];
					elseif($carr['type'] == "text/html") $related['html'] = $carr['data'];
					elseif($carr['disp'] && $carr['disp'] == "inline" && substr($carr['type'], 0, 6) == "image/"){
						if($carr['cid']){
							$related['image'][] = array('type' => 'cid', 'value' => $carr['cid']);
							save_file($cdir.'/'.$carr['cid'], $carr['type'].$csep.$carr['data']);
						}elseif($carr['name']){
							$related['image'][] = array('type' => 'name', 'value' => $carr['name']);
							save_file($cdir.'/'.$carr['name'], $carr['type'].$csep.$carr['data']);
						}
					}
				}
			}elseif(substr($carr['multipart'], -5) == "mixed"){
				if($carr['type'] && $carr['type'] == "text/plain") $mixed['text'] = $carr['data'];
				elseif($carr['type'] && $carr['type'] == "text/html") $mixed['html'] = $carr['data'];
				else{
					$ctype = $carr['type'] ? $carr['type'] : 'application/octet-stream';
					$cname = $carr['name'] ? $carr['name'] : md5(microtime(1).$unique++);
					$cdisp = $carr['disp'] ? $carr['disp'] : 'inline';
					$mixed['attach'][] = array('type' => $ctype, 'name' => $cname, 'size' => strlen($carr['data']));
					save_file($cdir.'/'.$cname, $ctype.$csep.$carr['data']);
				}
			}
		}
		if($alternative){
			if(isset($alternative['html'])){
				if($related && isset($related['image'])) $alternative['html'] = put_embed($alternative['html'], $related['image']);
				$content .= tag_ban($alternative['html'], $btags, $bprop);
			}elseif(isset($alternative['text'])) $content .= nl2br(htmlentities($alternative['text']));
		}
		if($related){
			if($content == ""){
				if(isset($related['html'])){
					if(isset($related['image'])) $related['html'] = put_embed($related['html'], $related['image']);
					$content .= tag_ban($related['html'], $btags, $bprop);
				}elseif(isset($related['text'])) $content .= nl2br(htmlentities($related['text']));
			}
		}
		if($mixed){
			if($content == ""){
				if(isset($mixed['html'])) $content .= tag_ban($mixed['html'], $btags, $bprop);
				if(isset($mixed['text'])){
					if($content != "") $content .= "<hr>\n";
					$content .= nl2br(htmlentities($mixed['text']));
				}
			}else{
				if(isset($mixed['html'])){
					$mixed['attach'][] = array('type' => 'text/html', 'name' => 'mixed.html', 'size' => strlen($mixed['html']));
					save_file($cdir.'/mixed.html', 'text/html'.$csep.$mixed['html']);
				}
				if(isset($mixed['text'])){
					$mixed['attach'][] = array('type' => 'text/plain', 'name' => 'mixed.txt', 'size' => strlen($mixed['text']));
					save_file($cdir.'/mixed.txt', 'text/plain'.$csep.$mixed['text']);
				}
			}
			if(isset($mixed['attach'])){
				$detatt = array();
				foreach($mixed['attach'] as $dattch){
					$descatth = strstr($dattch['name'], '.') ? $dattch['name'] : $dattch['type'];
					$detatt[] = '<a style="font-family: Verdana;font-size: 10pt" href="?down=attachment&fl='.$dattch['name'].'">'.$descatth.'</a> [ '.size_readable($dattch['size']).' ]';
				}
				$info .= '<b>Attachments:</b> '.implode(" | \n", $detatt)."<br>\n";
			}
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>XPM2 - POP3 E-Mail Reader</title>
</head>
<body>

<font style="font-family: Verdana;font-size: 10pt">
<?php echo $info; ?>
</font>
<hr color="gray" size="3">
<?php echo $content; ?>

</body>
</html>