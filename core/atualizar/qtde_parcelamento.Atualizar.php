<?php

	class Qtde_parcelamento extends ADOdb_Active_Record
	{
		var $_table = 'qtde_parcelamento';
	}
	$obj = new Qtde_parcelamento();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $qtde_vezes = $dados->qtde_vezes;
		
	 
    $status = $dados->status;
		
	 
    $created = $dados->created;
		
	

?>