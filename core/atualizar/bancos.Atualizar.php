<?php

	class Bancos extends ADOdb_Active_Record
	{
		var $_table = 'bancos';
	}
	$obj = new Bancos();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $banco = $dados->banco;
		
	 
    $sigla = $dados->sigla;
		
	 
    $juros = $dados->juros;
		
	 
    $multa = $dados->multa;
		
	 
    $prazo_multa = $dados->prazo_multa;
		
	 
    $prazo_juros = $dados->prazo_juros;
		
	 
    $desconto = $dados->desconto;
		
	 
    $prazo_desconto = $dados->prazo_desconto;
		
	 
    $protesto_devolucao = $dados->protesto_devolucao;
		
	 
    $prazo_protesto_devolucao = $dados->prazo_protesto_devolucao;
		
	 
    $cnpj = $dados->cnpj;
		
	 
    $agencia_cod_cedente = $dados->agencia_cod_cedente;
		
	 
    $num_convenio = $dados->num_convenio;
		
	 
    $tipo_carteira = $dados->tipo_carteira;
		
	 
    $carteira = $dados->carteira;
		
	 
    $agencia = $dados->agencia;
		
	 
    $conta = $dados->conta;
		
	 
    $digito_agencia = $dados->digito_agencia;
		
	 
    $digito_conta = $dados->digito_conta;
		
	 
    $digito_agencia_conta = $dados->digito_agencia_conta;
		
	 
    $tipo_incricao = $dados->tipo_incricao;
		
	 
    $num_inscricao = $dados->num_inscricao;
		
	 
    $contrato = $dados->contrato;
		
	 
    $codigo_reduzido = $dados->codigo_reduzido;
		
	 
    $tamanho_linha = $dados->tamanho_linha;
		
	 
    $exibir_parcela = $dados->exibir_parcela;
		
	 
    $id_caixa = $dados->id_caixa;
		
	 
    $tipo_conta = $dados->tipo_conta;
		
	 
    $banco_cobrador = $dados->banco_cobrador;
		
	 
    $carteira_remessa = $dados->carteira_remessa;
		
	 
    $agencia_cobradora = $dados->agencia_cobradora;
		
	 
    $nome_instituicao = $dados->nome_instituicao;
		
	 
    $endereco = $dados->endereco;
		
	 
    $bairro = $dados->bairro;
		
	 
    $estado_id = $dados->estado_id;
		
	 
    $cep = $dados->cep;
		
	 
    $cidade_id = $dados->cidade_id;
		
	 
    $nome_boleto = $dados->nome_boleto;
		
	 
    $matricula_banco = $dados->matricula_banco;
		
	 
    $radical = $dados->radical;
		
	 
    $tamanho_linha_remessa = $dados->tamanho_linha_remessa;
		
	 
    $cod_cliente = $dados->cod_cliente;
		
	 
    $cta_deb = $dados->cta_deb;
		
	 
    $digito_cta_deb = $dados->digito_cta_deb;

    $status = $dados->status;
		
	

?>