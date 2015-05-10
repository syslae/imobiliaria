<?php

	class Cliente extends ADOdb_Active_Record
	{
		var $_table = 'cliente';
	}
	$obj = new Cliente();
	
	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
	
	 
    $id = $dados->id;
    $nome = $dados->nome;
    $identidade = $dados->identidade;
    $cpf = $dados->cpf;
    $pessoa_contato = $dados->pessoa_contato;
    $logradouro = $dados->logradouro;
    $inscricao_estadual = $dados->inscricao_estadual;
    $bairro = $dados->bairro;
    $numero = $dados->numero;
    $cep = $dados->cep;
	$tipo = $dados->tipo;
    $telefone = $dados->telefone;
	$complemento = $dados->complemento;	
    $tipo = $dados->tipo;	
	 
    $celular = $dados->celular;
		
    $estado_id   = $dados->estado_id;	
	 
    $cidade_id = $dados->cidade_id;
		
	 
    $email = $dados->email;
    
    
    $email = $dados->email;
	$data = $dados->data_nascimento;	
    $data1 = explode(" ", $data);
	
	$data2 = explode("-",$data1[0]);
	
	$data_nascimento =  $data2[2]."/".$data2[1]."/".$data2[0];
    
    
    
    $observacao = $dados->observacao;
		
	 
    $status = $dados->status;
		
	 
    $created = $dados->created;
    
    
    $cnpj =         $dados->cnpj;
	$razao_social =  $dados->razao_social;
 	$nome_fantasia = $dados->nome_fantasia;

   if($tipo == "F")
    {

	$imprimir = "<script>
                $(document).ready(function()
                {
                // códigos jQuery a serem executados quando a página carregar
                    carregaInput(0);
                })</script>";
	
    }
    else
    {
        
        
        $imprimir =  "<script>
                        $(document).ready(function()
                        {
                        // códigos jQuery a serem executados quando a página carregar
                           carregaInput(1);
                        })</script>";
    }
?>