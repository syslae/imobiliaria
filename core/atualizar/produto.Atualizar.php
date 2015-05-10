<?php

	class Produto extends ADOdb_Active_Record
	{
		var $_table = 'produto';
	}
	$obj = new Produto();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $descricao = $dados->descricao;
	
	$valor = $dados->valor;
	 
    $status = $dados->status;
	 
    $created = $dados->created;

    $rs_estoque = $DB->Execute("select * from produto where produto_principal_id = '$id'");

    foreach($rs_estoque as $key => $registro){
        $estoque_id[] = $registro['id'];
        $codigo[] = $registro['codigo'];
        $estoque[] = $registro['descricao'];
        $valor_estoque[] = number_format(moeda_ajuste($registro['valor']),2,".","");
        $status_estoque[$key+1] = $registro['status'];
    }

?>