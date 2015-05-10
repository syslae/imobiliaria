<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	/*
    if(empty($cliente_id)) 
	{
		$erro .= 'cliente_id'; 
		$class_cliente_id = 1; 
	}  
	if(empty($servico_id)) 
	{
		$erro .= 'servico_id'; 
		$class_servico_id = 1; 
	}  
	if(empty($situacao_pagamento_id)) 
	{
		$erro .= 'situacao_pagamento_id'; 
		$class_situacao_pagamento_id = 1; 
	}  
	if(empty($numero_nota_empenho)) 
	{
		$erro .= 'numero_nota_empenho'; 
		$class_numero_nota_empenho = 1; 
	}  
	if(empty($espaco_fisico_id)) 
	{
		$erro .= 'espaco_fisico_id'; 
		$class_espaco_fisico_id = 1; 
	}  
	if(empty($nf)) 
	{
		$erro .= 'nf'; 
		$class_nf = 1; 
	}  
	if(empty($mes_emissao)) 
	{
		$erro .= 'mes_emissao'; 
		$class_mes_emissao = 1; 
	}  
	if(empty($data_pagamento)) 
	{
		$erro .= 'data_pagamento'; 
		$class_data_pagamento = 1; 
	}  
	if(empty($ano_emissao)) 
	{
		$erro .= 'ano_emissao'; 
		$class_ano_emissao = 1; 
	}  
	if(empty($n_pd)) 
	{
		$erro .= 'n_pd'; 
		$class_n_pd = 1; 
	}  
	if(empty($valor)) 
	{
		$erro .= 'valor'; 
		$class_valor = 1; 
	}  
	if(empty($data_nota)) 
	{
		$erro .= 'data_nota'; 
		$class_data_nota = 1; 
	} 

*/
	if (empty($erro))
	{
		class Movimentacao extends ADOdb_Active_Record
		{
			var $_table = 'movimentacao';
		}
		$obj = new Movimentacao();
		
		
		if (!empty($id)) $obj->load('id=?', $id);

	
	$data1=explode("/", $data_pagamento);
	$data_pagamento=$data1[2]."-".$data1[1]."-".$data1[0];
               
	
	$data2=explode("/", $data_nota);
	$data_nota=$data2[2]."-".$data2[1]."-".$data2[0];
                
		$obj->cliente_id = $cliente_id; 
		$obj->servico_id = $servico_id; 
		$obj->situacao_pagamento_id = $situacao_pagamento_id; 
		$obj->numero_nota_empenho = $numero_nota_empenho; 
		$obj->nf = $nf; 
		$obj->mes_emissao = $mes_emissao; 
		$obj->data_pagamento = $data_pagamento; 
		$obj->ano_emissao = $ano_emissao; 
		$obj->n_pd = $n_pd; 
		$obj->valor = moeda_ajuste($valor);
		$obj->data_nota = $data_nota; 
		$obj->status = 1;
	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
		    $movimentacao_id = $id;
            $Sql = "insert into log_estorno(movimentacao_id,usuario_id,data,status,created)values('".$movimentacao_id."',
            '".$_SESSION["idusuario_g"]."','".date('Y-m-d H:i:s')."','1','".date('Y-m-d H:i:s')."')";
            $rs = $DB->Execute($Sql);            
            $_SESSION['msg_index'] = 'Salvo com sucesso';
			redireciona('index.php');
		}
		catch(ADODB_Exception $e)
		{
			echo 'Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar ';
		}
		catch(exceptions $e)
		{
			//echo $e->getMessage();
			echo 'Ocorreu uma execao no modulo de salvar';
		}
	}
?>
		 
