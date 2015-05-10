<?php
		include('appConfig.php');
	    include("adodb5/adodb-exceptions.inc.php");
		include('adodb5/adodb.inc.php');
		$DB = NewADOConnection('mysql');
		$DB->Connect($config["server"], $config["user"], $config["pwd"], $config["db"]);
		print_r($config);
?>