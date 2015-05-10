<?php

	class InscricaoEstadual extends ADOdb_Active_Record
	{
		var $_table = 'inscricao_municipal';
	}
	$obj = new InscricaoEstadual();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
    $id = $dados->id;
		
	 
    $usuario_id = $dados->usuario_id;
		
	 
    $espaco_fisico_id = $dados->espaco_fisico_id;
		
	$descricao   = $dados->descricao;
     
    $created = $dados->created;
		
	 
    $status = $dados->status;
		
	

?>