<?php
	class Usuariotabelas extends ADOdb_Active_Record
	{
		var $_table = "usuariotabelas";
	}
	$obj = new Usuariotabelas();
	
	$dadosArray = $obj->Find("id=?", $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION["msg_index"] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
    	
    $id = $dados->id;
    $usuario_id = $dados->usuario_id;
    $tabela_id = $dados->tabela_id;
    $permissao = $dados->permissao;


?>