<?php


	$id = (int) $_POST['id'];
	$idusuariowebsite = $_POST['idusuariowebsite'];
	$empresa_id = $_POST['empresa_id'];
	
	$grupo_id = (int)$_POST['grupo_id'];
	
	$login = trim($_POST['login']);
	$login = substr($login,0,80);

	$senha = trim($_POST['senha']);
	$senha = substr($senha,0,50);
	
	$csenha = trim($_POST['csenha']);
	$csenha = substr($csenha,0,50);

	$nome = trim($_POST['nome']);
	$nome = substr($nome,0,200);

	$email = trim($_POST['email']);
	$email = substr($email,0,200);

	//$msn = trim($_POST['msn']);
	//$msn = substr($msn,0,200);

	//$orkut = trim($_POST['orkut']);
	//$orkut = substr($orkut,0,200);

	//$fone = trim($_POST['fone']);
	//$fone = substr($fone,0,50);


	$celular = trim($_POST['celular']);
	$celular = substr($celular,0,50);

	$empresa_id = (int)$_POST['empresa_id'];

	//$foto = trim($_POST['foto']);
	//$foto = substr($foto,0,50);

	/*$dia_ultimoacesso = (int) $_POST['dia_ultimoacesso'];
	$mes_ultimoacesso = (int) $_POST['mes_ultimoacesso'];
	$ano_ultimoacesso = (int) $_POST['ano_ultimoacesso'];
	$hora_ultimoacesso = (int) $_POST['hora_ultimoacesso'];
	$min_ultimoacesso = (int) $_POST['min_ultimoacesso'];

	$ultimoacesso = $ano_ultimoacesso.'-'.$mes_ultimoacesso.'-'.$dia_ultimoacesso.' '.$hora_ultimoacesso.'-'.$min_ultimoacesso.'-00';

	$acessos = (int) $_POST['acessos'];*/



	$status = (int) $_POST['status'];

?>