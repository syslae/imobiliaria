<?php
		include('appConfig.php');
		/*
		arquivo de conexao para as functions
		Elas n�o podem referenciar os requires porque eles j� existem
		na pagina que a chama
		*/
			
		$DB = NewADOConnection($config["db_tipo"]);
		$DB->Connect($config["server"], $config["user"], $config["pwd"], $config["db"]);
		$DB->SetFetchMode(ADODB_FETCH_ASSOC);
		//print_r($config);
?>