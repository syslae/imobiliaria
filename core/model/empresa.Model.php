<?php 	 
	$id = (int)$_POST['id'];
     
	$razao_social = trim($_POST['razao_social']);
	$razao_social = substr($razao_social,0,80);
	$razao_social=addslashes($razao_social); 
     
	$nome_fantasia = trim($_POST['nome_fantasia']);
	$nome_fantasia = substr($nome_fantasia,0,80);
	$nome_fantasia=addslashes($nome_fantasia); 
     
	$cnpj = $_POST['cnpj'];
     
	$ie = trim($_POST['ie']);
	$ie = substr($ie,0,16);
	$ie=addslashes($ie); 
     
	$logradouro = trim($_POST['logradouro']);
	$logradouro = substr($logradouro,0,80);
	$logradouro=addslashes($logradouro); 
     
	$bairro = trim($_POST['bairro']);
	$bairro = substr($bairro,0,30);
	$bairro=addslashes($bairro); 
     
	$numero = trim($_POST['numero']);
	$numero = substr($numero,0,12);
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
     
	$fax = trim($_POST['fax']);
	$fax = substr($fax,0,16);
	$fax=addslashes($fax); 
     
	$email = $_POST['email'];
     
	$site = trim($_POST['site']);
	$site = substr($site,0,16);
	$site=addslashes($site); 
     
	$pessoa_contato = trim($_POST['pessoa_contato']);
	$pessoa_contato = substr($pessoa_contato,0,80);
	$pessoa_contato=addslashes($pessoa_contato); 
     
	$atuacao = trim($_POST['atuacao']);
	$atuacao = substr($atuacao,0,50);
	$atuacao=addslashes($atuacao); 
    $estado_id = trim($_POST['estado_id']);
	$cidade_id = trim($_POST['cidade_id']);
    
    $status = 1;
	 
?>