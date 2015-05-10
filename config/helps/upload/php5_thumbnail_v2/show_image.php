<?php

//http://www.gen-x-design.com/projects/php-thumbnailer-class/
/**
 * show_image.php
 * 
 * Example utility file for dynamically displaying images
 * 
 * @author      Ian Selby
 * @version     1.0 (php 5 version)
 */

//reference thumbnail class
include_once('thumbnail.inc.php');

//$thumb = new Thumbnail($_GET['filename']);
//$thumb->resize($_GET['width'],$_GET['height']);
$thumb = new Thumbnail('sample.jpg');
//$thumb->resize(640,4801);
//$thumb->cropFromCenter(800);
//$thumb->resize(60,45);
$thumb->createReflection(40,40,80,true,'#a4a4a4');
$thumb->show();
exit;
?>