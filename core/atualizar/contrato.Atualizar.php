<?php

	class Contrato extends ADOdb_Active_Record
	{
		var $_table = 'contrato';
	}
	$obj = new Contrato();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $cliente_id = $dados->cliente_id;;
		
	 
    $numero_contrato = $dados->numero_contrato;
    
    $servico_id = $dados->servico_id;
	
		
	 
    $data_inicio = $dados->data_inicio;
		
	 
    $data_final = $dados->data_final;
		
	 
    $vigencia = $dados->vigencia;
		
	 
    $valor_mensal = $dados->valor_mensal;
		
	 
    $volor_total = $dados->volor_total;
		
	 
    $created = $dados->created;
		
	 
    $status = $dados->status;
		
	
	
	$data1=explode("-", $data_inicio);
	$data_inicio=$data1[2]."/".$data1[1]."/".$data1[0];
               
	
	$data2=explode("-", $data_final);
	$data_final=$data2[2]."/".$data2[1]."/".$data2[0];
               

?>