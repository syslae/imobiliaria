<?php 	 
	$id = (int)$_POST['id'];
     
	$nome = trim($_POST['nome']);
	$nome = substr($nome,0,80);
	$nome=addslashes($nome); 
     
	$identidade = trim($_POST['identidade']);
	$identidade = substr($identidade,0,16);
	$identidade=addslashes($identidade); 
     
	$cpf = trim($_POST['cpf']);
	$cpf = substr($cpf,0,16);
	$cpf=addslashes($cpf); 
     
	$logradouro = trim($_POST['logradouro']);
	$logradouro = substr($logradouro,0,80);
	$logradouro=addslashes($logradouro); 
     
	$bairro = trim($_POST['bairro']);
	$bairro = substr($bairro,0,30);
	$bairro=addslashes($bairro); 
     
	$numero = trim($_POST['numero']);
	$numero = substr($numero,0,16);
	$numero=addslashes($numero); 
     
	$cep = trim($_POST['cep']);
	$cep = substr($cep,0,16);
	$cep=addslashes($cep); 
     
	$telefone = trim($_POST['telefone']);
	$telefone = substr($telefone,0,16);
	$telefone=addslashes($telefone); 
     
	$celular = trim($_POST['celular']);
	$celular = substr($celular,0,16);
	$celular=addslashes($celular); 
     

	$cidade_id = trim($_POST['cidade_id']);
	$cidade_id = substr($cidade_id,0,5);
	$cidade_id =addslashes($cidade_id); 
    
   	$estado_id = trim($_POST['estado_id']);
	$estado_id = substr($estado_id,0,5);
	$estado_id=addslashes($estado_id); 
     
     
	$email = trim($_POST['email']);
	$email = substr($email,0,80);
	$email=addslashes($email);
    
    $complemento = $_POST['complemento'];
     
	$observacao = trim($_POST['observacao']);
	$observacao = substr($observacao,0,80);
	$observacao=addslashes($observacao); 
    $inscricao_estadual = trim($_POST['inscricao_estadual']);
    
    $pessoa_contato = trim($_POST['pessoa_contato']);
    
    $data_nascimento = $_REQUEST['data_nascimento'];     
	$status = 1;
    $cnpj =          $_POST['cnpj'];
	$razao_social =  $_POST['razao_social'];
 

 	$nome_fantasia = $_POST['nome_fantasia'];

?>