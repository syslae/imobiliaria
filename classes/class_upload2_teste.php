<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require "Upload/class.upload.php";

/**
* @file system/application/libraries/MY_Upload.php
*/
class MY_Upload extends upload
{
	function MY_Upload(){
	}
	function upload_file($file){
		parent::upload($file);
	}


} // END class upload
?>