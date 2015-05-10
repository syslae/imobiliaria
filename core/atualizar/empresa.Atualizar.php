<?php

	class Empresa extends ADOdb_Active_Record
	{
		var $_table = 'empresa';
	}
	$obj = new Empresa();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
		
	 
    $razao_social = $dados->razao_social;
		
	 
    $nome_fantasia = $dados->nome_fantasia;
		
	 
    $cnpj = $dados->cnpj;
		
	 
    $ie = $dados->ie;
		
	 
    $logradouro = $dados->logradouro;
		
	 
    $bairro = $dados->bairro;
		
	 
    $numero = $dados->numero;
		
	 
    $cep = $dados->cep;
		
	 
    $telefone = $dados->telefone;
		
	 
    $celular = $dados->celular;
		
	 
    $fax = $dados->fax;
		
	 
    $email = $dados->email;
		
	 
    $site = $dados->site;
		
	 
    $pessoa_contato = $dados->pessoa_contato;
		
	 
    $atuacao = $dados->atuacao;
    
    
    $cidade_id = $dados->cidade_id;
    
    $estado_id = $dados->estado_id;
		
	

?>