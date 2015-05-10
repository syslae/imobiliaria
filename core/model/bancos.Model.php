<?php 	 
	$id = trim($_POST['id']);
	$id = substr($id,0,5);
	$id=addslashes($id); 
     
	$banco = trim($_POST['banco']);
	$banco = substr($banco,0,200);
	$banco=addslashes($banco); 
     
	$sigla = trim($_POST['sigla']);
	$sigla = substr($sigla,0,3);
	$sigla=addslashes($sigla); 
     
	$juros = trim($_POST['juros']); 
	$multa = trim($_POST['multa']); 
	$prazo_multa = (int)$_POST['prazo_multa'];
     
	$prazo_juros = (int)$_POST['prazo_juros'];
     
	$desconto = trim($_POST['desconto']); 
	$prazo_desconto = (int)$_POST['prazo_desconto'];
     
	$protesto_devolucao = trim($_POST['protesto_devolucao']);
	$protesto_devolucao = substr($protesto_devolucao,0,1);
	$protesto_devolucao=addslashes($protesto_devolucao); 
     
	$prazo_protesto_devolucao = (int)$_POST['prazo_protesto_devolucao'];
     
	$cnpj = trim($_POST['cnpj']);
	$cnpj = substr($cnpj,0,18);
	$cnpj=addslashes($cnpj); 
     
	$agencia_cod_cedente = trim($_POST['agencia_cod_cedente']);
	$agencia_cod_cedente = substr($agencia_cod_cedente,0,50);
	$agencia_cod_cedente=addslashes($agencia_cod_cedente); 
     
	$num_convenio = trim($_POST['num_convenio']);
	$num_convenio = substr($num_convenio,0,50);
	$num_convenio=addslashes($num_convenio); 
     
	$tipo_carteira = trim($_POST['tipo_carteira']);
	$tipo_carteira = substr($tipo_carteira,0,20);
	$tipo_carteira=addslashes($tipo_carteira); 
     
	$carteira = trim($_POST['carteira']);
	$carteira = substr($carteira,0,30);
	$carteira=addslashes($carteira); 
     
	$agencia = trim($_POST['agencia']);
	$agencia = substr($agencia,0,18);
	$agencia=addslashes($agencia); 
     
	$conta = trim($_POST['conta']);
	$conta = substr($conta,0,18);
	$conta=addslashes($conta); 
     
	$digito_agencia = trim($_POST['digito_agencia']);
	$digito_agencia = substr($digito_agencia,0,18);
	$digito_agencia=addslashes($digito_agencia); 
     
	$digito_conta = trim($_POST['digito_conta']);
	$digito_conta = substr($digito_conta,0,18);
	$digito_conta=addslashes($digito_conta); 
     
	$digito_agencia_conta = trim($_POST['digito_agencia_conta']);
	$digito_agencia_conta = substr($digito_agencia_conta,0,18);
	$digito_agencia_conta=addslashes($digito_agencia_conta); 
     
	$tipo_incricao = trim($_POST['tipo_incricao']);
	$tipo_incricao = substr($tipo_incricao,0,18);
	$tipo_incricao=addslashes($tipo_incricao); 
     
	$num_inscricao = trim($_POST['num_inscricao']);
	$num_inscricao = substr($num_inscricao,0,50);
	$num_inscricao=addslashes($num_inscricao); 
     
	$contrato = trim($_POST['contrato']);
	$contrato = substr($contrato,0,50);
	$contrato=addslashes($contrato); 
     
	$codigo_reduzido = trim($_POST['codigo_reduzido']);
	$codigo_reduzido = substr($codigo_reduzido,0,50);
	$codigo_reduzido=addslashes($codigo_reduzido); 
     
	$tamanho_linha = (int)$_POST['tamanho_linha'];
     
	$exibir_parcela = trim($_POST['exibir_parcela']);
	$exibir_parcela = substr($exibir_parcela,0,1);
	$exibir_parcela=addslashes($exibir_parcela); 
     
	$id_caixa = (int)$_POST['id_caixa'];
     
	$tipo_conta = trim($_POST['tipo_conta']);
	$tipo_conta = substr($tipo_conta,0,20);
	$tipo_conta=addslashes($tipo_conta); 
     
	$banco_cobrador = trim($_POST['banco_cobrador']);
	$banco_cobrador = substr($banco_cobrador,0,50);
	$banco_cobrador=addslashes($banco_cobrador); 
     
	$carteira_remessa = trim($_POST['carteira_remessa']);
	$carteira_remessa = substr($carteira_remessa,0,5);
	$carteira_remessa=addslashes($carteira_remessa); 
     
	$agencia_cobradora = trim($_POST['agencia_cobradora']);
	$agencia_cobradora = substr($agencia_cobradora,0,50);
	$agencia_cobradora=addslashes($agencia_cobradora); 
     
	$nome_instituicao = trim($_POST['nome_instituicao']);
	$nome_instituicao = substr($nome_instituicao,0,150);
	$nome_instituicao=addslashes($nome_instituicao); 
     
	$endereco = trim($_POST['endereco']);
	$endereco = substr($endereco,0,250);
	$endereco=addslashes($endereco); 
     
	$bairro = trim($_POST['bairro']);
	$bairro = substr($bairro,0,50);
	$bairro=addslashes($bairro); 
     
	$estado_id = trim($_POST['estado_id']);
	$estado_id = substr($estado_id,0,5);
	$estado_id=addslashes($estado_id); 
     
	$cep = trim($_POST['cep']);
	$cep = substr($cep,0,18);
	$cep=addslashes($cep); 
     
	$cidade_id = (int)$_POST['cidade_id'];
     
	$nome_boleto = trim($_POST['nome_boleto']);
	$nome_boleto = substr($nome_boleto,0,15);
	$nome_boleto=addslashes($nome_boleto); 
     
	$matricula_banco = trim($_POST['matricula_banco']);
	$matricula_banco = substr($matricula_banco,0,10);
	$matricula_banco=addslashes($matricula_banco); 
     
	$radical = trim($_POST['radical']);
	$radical = substr($radical,0,10);
	$radical=addslashes($radical); 
     
	$tamanho_linha_remessa = (int)$_POST['tamanho_linha_remessa'];
     
	$cod_cliente = trim($_POST['cod_cliente']);
	$cod_cliente = substr($cod_cliente,0,50);
	$cod_cliente=addslashes($cod_cliente); 
     
	$cta_deb = trim($_POST['cta_deb']);
	$cta_deb = substr($cta_deb,0,50);
	$cta_deb=addslashes($cta_deb); 
     
	$digito_cta_deb = trim($_POST['digito_cta_deb']);
	$digito_cta_deb = substr($digito_cta_deb,0,2);
	$digito_cta_deb=addslashes($digito_cta_deb);

    $status = trim($_POST['status']);
    
?>