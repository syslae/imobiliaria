<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($banco)) 
	{
		$erro .= 'banco'; 
		$class_banco = 1; 
	}  
	if(empty($sigla) or $sigla == 'SE')
	{
		$erro .= 'sigla'; 
		$class_sigla = 1; 
	}  
	if($juros === '')
	{
		$erro .= 'juros'; 
		$class_juros = 1; 
	}  
	if($multa === '')
	{
		$erro .= 'multa'; 
		$class_multa = 1; 
	}  
	/*if(empty($prazo_multa))
	{
		$erro .= 'prazo_multa'; 
		$class_prazo_multa = 1; 
	}  
	if(empty($prazo_juros)) 
	{
		$erro .= 'prazo_juros'; 
		$class_prazo_juros = 1; 
	}  
	if(empty($desconto)) 
	{
		$erro .= 'desconto'; 
		$class_desconto = 1; 
	}  
	if(empty($prazo_desconto)) 
	{
		$erro .= 'prazo_desconto'; 
		$class_prazo_desconto = 1; 
	}  
	if(empty($protesto_devolucao)) 
	{
		$erro .= 'protesto_devolucao'; 
		$class_protesto_devolucao = 1; 
	}  
	if(empty($prazo_protesto_devolucao)) 
	{
		$erro .= 'prazo_protesto_devolucao'; 
		$class_prazo_protesto_devolucao = 1; 
	}  
	if(empty($cnpj)) 
	{
		$erro .= 'cnpj'; 
		$class_cnpj = 1; 
	}  
	if(empty($agencia_cod_cedente)) 
	{
		$erro .= 'agencia_cod_cedente'; 
		$class_agencia_cod_cedente = 1; 
	}  
	if(empty($num_convenio)) 
	{
		$erro .= 'num_convenio'; 
		$class_num_convenio = 1; 
	}  
	if(empty($tipo_carteira)) 
	{
		$erro .= 'tipo_carteira'; 
		$class_tipo_carteira = 1; 
	}  
	if(empty($carteira)) 
	{
		$erro .= 'carteira'; 
		$class_carteira = 1; 
	}  
	if(empty($agencia)) 
	{
		$erro .= 'agencia'; 
		$class_agencia = 1; 
	}  
	if(empty($conta)) 
	{
		$erro .= 'conta'; 
		$class_conta = 1; 
	}  
	if(empty($digito_agencia)) 
	{
		$erro .= 'digito_agencia'; 
		$class_digito_agencia = 1; 
	}  
	if(empty($digito_conta)) 
	{
		$erro .= 'digito_conta'; 
		$class_digito_conta = 1; 
	}  
	if(empty($digito_agencia_conta)) 
	{
		$erro .= 'digito_agencia_conta'; 
		$class_digito_agencia_conta = 1; 
	}  
	if(empty($tipo_incricao)) 
	{
		$erro .= 'tipo_incricao'; 
		$class_tipo_incricao = 1; 
	}  
	if(empty($num_inscricao)) 
	{
		$erro .= 'num_inscricao'; 
		$class_num_inscricao = 1; 
	}  
	if(empty($contrato)) 
	{
		$erro .= 'contrato'; 
		$class_contrato = 1; 
	}  
	if(empty($codigo_reduzido)) 
	{
		$erro .= 'codigo_reduzido'; 
		$class_codigo_reduzido = 1; 
	}  
	if(empty($tamanho_linha)) 
	{
		$erro .= 'tamanho_linha'; 
		$class_tamanho_linha = 1; 
	}  
	if(empty($exibir_parcela)) 
	{
		$erro .= 'exibir_parcela'; 
		$class_exibir_parcela = 1; 
	}  
	if(empty($id_caixa)) 
	{
		$erro .= 'id_caixa'; 
		$class_id_caixa = 1; 
	}  
	if(empty($tipo_conta)) 
	{
		$erro .= 'tipo_conta'; 
		$class_tipo_conta = 1; 
	}  
	if(empty($banco_cobrador)) 
	{
		$erro .= 'banco_cobrador'; 
		$class_banco_cobrador = 1; 
	}  
	if(empty($carteira_remessa)) 
	{
		$erro .= 'carteira_remessa'; 
		$class_carteira_remessa = 1; 
	}  
	if(empty($agencia_cobradora)) 
	{
		$erro .= 'agencia_cobradora'; 
		$class_agencia_cobradora = 1; 
	} */
	if(empty($nome_instituicao)) 
	{
		$erro .= 'nome_instituicao'; 
		$class_nome_instituicao = 1; 
	}
	if(empty($endereco)) 
	{
		$erro .= 'endereco'; 
		$class_endereco = 1; 
	}  
	if(empty($bairro)) 
	{
		$erro .= 'bairro'; 
		$class_bairro = 1; 
	}  
	if(empty($estado_id)) 
	{
		$erro .= 'estado_id'; 
		$class_estado_id = 1; 
	}
	if(empty($cep)) 
	{
		$erro .= 'cep'; 
		$class_cep = 1; 
	}  
	if(empty($cidade_id)) 
	{
		$erro .= 'cidade_id'; 
		$class_cidade_id = 1; 
	}  
	if(empty($nome_boleto))
	{
		$erro .= 'nome_boleto'; 
		$class_nome_boleto = 1; 
	}
	/*if(empty($matricula_banco))
	{
		$erro .= 'matricula_banco'; 
		$class_matricula_banco = 1; 
	}  
	if(empty($radical)) 
	{
		$erro .= 'radical'; 
		$class_radical = 1; 
	}  
	if(empty($tamanho_linha_remessa)) 
	{
		$erro .= 'tamanho_linha_remessa'; 
		$class_tamanho_linha_remessa = 1; 
	}  
	if(empty($cod_cliente)) 
	{
		$erro .= 'cod_cliente'; 
		$class_cod_cliente = 1; 
	}  
	if(empty($cta_deb)) 
	{
		$erro .= 'cta_deb'; 
		$class_cta_deb = 1; 
	}  
	if(empty($digito_cta_deb)) 
	{
		$erro .= 'digito_cta_deb'; 
		$class_digito_cta_deb = 1; 
	} */

	if (empty($erro))
	{
		class Bancos extends ADOdb_Active_Record
		{
			var $_table = 'bancos';
		}
		$obj = new Bancos();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
		$obj->banco = $banco;
 
		$obj->sigla = $sigla;
 
		$obj->juros = $juros;
 
		$obj->multa = $multa;

		$multa  = moeda($multa);
 
		$obj->prazo_multa = $prazo_multa;
 
		$obj->prazo_juros = $prazo_juros;
 
		$obj->desconto = $desconto;
 
		$obj->prazo_desconto = $prazo_desconto;
 
		$obj->protesto_devolucao = $protesto_devolucao;
 
		$obj->prazo_protesto_devolucao = $prazo_protesto_devolucao;
 
		$obj->cnpj = $cnpj;
 
		$obj->agencia_cod_cedente = $agencia_cod_cedente;
 
		$obj->num_convenio = $num_convenio;
 
		$obj->tipo_carteira = $tipo_carteira;
 
		$obj->carteira = $carteira;
 
		$obj->agencia = $agencia;
 
		$obj->conta = $conta;
 
		$obj->digito_agencia = $digito_agencia;
 
		$obj->digito_conta = $digito_conta;
 
		$obj->digito_agencia_conta = $digito_agencia_conta;
 
		$obj->tipo_incricao = $tipo_incricao;
 
		$obj->num_inscricao = $num_inscricao;
 
		$obj->contrato = $contrato;
 
		$obj->codigo_reduzido = $codigo_reduzido;
 
		$obj->tamanho_linha = $tamanho_linha;
 
		$obj->exibir_parcela = $exibir_parcela;
 
		$obj->id_caixa = $id_caixa;
 
		$obj->tipo_conta = $tipo_conta;
 
		$obj->banco_cobrador = $banco_cobrador;
 
		$obj->carteira_remessa = $carteira_remessa;
 
		$obj->agencia_cobradora = $agencia_cobradora;
 
		$obj->nome_instituicao = $nome_instituicao;
 
		$obj->endereco = $endereco;
 
		$obj->bairro = $bairro;
 
		$obj->estado_id = $estado_id;
 
		$obj->cep = $cep;
 
		$obj->cidade_id = $cidade_id;
 
		$obj->nome_boleto = $nome_boleto;
 
		$obj->matricula_banco = $matricula_banco;
 
		$obj->radical = $radical;
 
		$obj->tamanho_linha_remessa = $tamanho_linha_remessa;
 
		$obj->cod_cliente = $cod_cliente;
 
		$obj->cta_deb = $cta_deb;
 
		$obj->digito_cta_deb = $digito_cta_deb;

        $obj->status = $status;

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
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
		 
