<?php

	class Motivo_cancelamento extends ADOdb_Active_Record
	{
		var $_table = 'motivo_cancelamento';
	}
	$obj = new Motivo_cancelamento();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $motivo = $dados->motivo;
		
	 
    $usuario_id = $dados->usuario_id;
		
	 
    $parcela_id = $dados->parcela_id;
		
	 
    $created = $dados->created;
		
	 
    $status = $dados->status;
		
	

?>