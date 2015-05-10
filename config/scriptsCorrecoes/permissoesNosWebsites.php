<?php

	require("../define.php");
	require(DOMAIN_PATH."Genesis/conexao.php");
	
	$sql = "select id from usuarios order by id asc";
	$rs = $DB->Execute($sql);
	$tr = $rs->RecordCount();
	
	while (!$rs->EOF)
	{
		$id = $rs->fields['id'];
	
		$sql2 = "select usuario_id from usuariowebsites where usuario_id = $id";
		$rs2 = $DB->Execute($sql2);
		$tr2 = $rs2->RecordCount();
		
		$website_id = 1;
		
		if($id==73)
			$website_id = 5;
			
		if($tr2==0) $DB->Execute("insert into usuariowebsites (website_id, usuario_id, permissao) values ($website_id, $id, 3)");
	
		
		$rs->moveNext();
	}
?>