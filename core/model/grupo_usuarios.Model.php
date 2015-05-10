<?php

	$id = (int) $_POST['id'];
	
	
	$tipo = (int)$_POST['tipo'];
	
	
	$nome = trim($_POST['nome']);
	$nome = substr($nome,0,200);

	$descricao = trim($_POST['descricao']);
	$descricao = substr($descricao,0,200);

	$status = (int) $_POST['status'];

?>