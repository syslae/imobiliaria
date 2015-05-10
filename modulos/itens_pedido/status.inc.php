<?php
	
	require("config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."/funcoes.inc.php");
	
	verifica ("login.php");
	
	
	if (isset($_GET['id']))
	{
	  $id = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
	  $novonivel = (get_magic_quotes_gpc()) ? $_GET['novonivel'] : addslashes($_GET['novonivel']);
	}
	
	if (isset($_GET['tabela']))
	{
	  $tabela = (get_magic_quotes_gpc()) ? $_GET['tabela'] : addslashes($_GET['tabela']);
	}
	echo $tabela;
	if(!empty($id) and !empty($tabela))
	{
		if($novonivel==1)
		{
			$sql = "update $tabela set status = 1 where id = $id";
		}
		else
		{
			$sql = "update $tabela set status = 0 where id = $id";
		}
		if ($DB->Execute($sql) === false) print 'Erro no update';
	}

?>