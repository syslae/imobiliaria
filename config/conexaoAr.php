<?php
		include('appConfig.php');
		include("adodb5/adodb-exceptions.inc.php");
		include('adodb5/adodb.inc.php');
		include('adodb5/adodb-active-record.inc.php');
		
		$DB = NewADOConnection($config["db_tipo"].'://'.$config["user"].':'.$config["pwd"].'@'.$config["server"].'/'.$config["db"]);
		
		$DB->SetFetchMode(ADODB_FETCH_ASSOC);
		//$DB->debug=1;
    	ADOdb_Active_Record::SetDatabaseAdapter($DB);
?>