<?php
	class Grupo_usuarios extends ADOdb_Active_Record
	{
		var $_table = "grupo_usuarios";
	}
	$obj = new Grupo_usuarios();
	
	$dadosArray = $obj->Find("id=?", $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION["msg_index"] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
    	
    $id = $dados->id;
	$tipo = $dados->tipo;
   
    $nome = $dados->nome;
    $descricao = $dados->descricao;
    
	
	
    $status = $dados->status;


?>