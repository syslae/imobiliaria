<?php

	class Tabelas extends ADOdb_Active_Record
	{
		var $_table = 'tabelas';
	}
	$obj = new Tabelas();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $tabela_id = $dados->tabela_id;
		
	 
    $menu_id = $dados->menu_id;
		
	 
    $nome = $dados->nome;
		
	 
    $tipo = $dados->tipo;
		
	 
    $pasta = $dados->pasta;
		
	 
    $status = $dados->status;
		
	

?>