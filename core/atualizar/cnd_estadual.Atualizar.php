<?php

	class Cnd_estadual extends ADOdb_Active_Record
	{
		var $_table = 'cnd_estadual';
	}
	$obj = new Cnd_estadual();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $usuario_id = $dados->usuario_id;
		
	   
    $data_validade = $dados->data_validade;
    
    $data3=explode("-", $data_validade);

	$data_validade=$data3[2]."/".$data3[1]."/".$data3[0];
    
    $espaco_fisico_id = $dados->espaco_fisico_id;
	
    	
	$descricao   = $dados->descricao;
     
    $created = $dados->created;
		
	 
    $status = $dados->status;
		
	

?>