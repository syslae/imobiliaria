<?php

	class Movimentacao extends ADOdb_Active_Record
	{
		var $_table = 'movimentacao';
	}
	$obj = new Movimentacao();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
    
    $cliente_id = $dados->cliente_id;
		
     $tipo = 	retornaNome("cliente","tipo",$cliente_id);
    $nf = $dados->nf;
		 
    $numero_nota_empenho = $dados->numero_nota_empenho;
    
    $situacao_pagamento_id = $dados->situacao_pagamento_id;
 

    $mes_emissao = $dados->mes_emissao;
		
	$ano_emissao = $dados->ano_emissao;
	 
    
    $data_pagamento = $dados->data_pagamento;
		
	if($data_pagamento != "")
    {
        $data2=explode("-", $data_pagamento);
    	$data_pagamento=$data2[2]."/".$data2[1]."/".$data2[0];
    }
     
    $servico_id = $dados->servico_id;
    $nf = $dados->nf;
	$n_pd = $dados->n_pd;
    $valor =  moeda($dados->valor);
		
	 
    $imagem = $dados->imagem;
		
    
    $data_nota = $dados->data_nota;
	
    $data3=explode("-", $data_nota);
	$data_nota=$data3[2]."/".$data3[1]."/".$data3[0];

	
               

?>