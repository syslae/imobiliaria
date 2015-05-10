<?php

	class Ocorrencia_retorno extends ADOdb_Active_Record
	{
		var $_table = 'ocorrencia_retorno';
	}
	$obj = new Ocorrencia_retorno();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $descricao = $dados->descricao;
		
	 
    $num_retorno = $dados->num_retorno;
		
	 
    $data_ret = $dados->data_ret;
		
	 
    $data_mov = $dados->data_mov;
		
	 
    $banco_id = $dados->banco_id;
		
	 
    $descricao1 = $dados->descricao1;
		
	 
    $situacao = $dados->situacao;
		
	 
    $valor_esperado = $dados->valor_esperado;
		
	 
    $data_credito = $dados->data_credito;
		
	 
    $diferenca = $dados->diferenca;
		
	 
    $baixa_valor_maior = $dados->baixa_valor_maior;
		
	 
    $nao_baixar = $dados->nao_baixar;
		
	 
    $boleto_baixado = $dados->boleto_baixado;
		
	
	
	$data1=explode("-", $data_ret);
	$data_ret=$data1[2]."/".$data1[1]."/".$data1[0];
               
	
	$data2=explode("-", $data_mov);
	$data_mov=$data2[2]."/".$data2[1]."/".$data2[0];
               
	
	$data3=explode("-", $data_credito);
	$data_credito=$data3[2]."/".$data3[1]."/".$data3[0];
               

?>