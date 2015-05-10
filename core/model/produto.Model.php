<?php 	 
	$id = (int)$_POST['id'];
     
	$descricao = trim($_POST['descricao']);
	$descricao = substr($descricao,0,80);
	$descricao=addslashes($descricao);
	$valor = trim($_POST['valor']);

    $estoque_id = $_POST['estoque_id'];

    $codigo = $_POST['codigo'];

    $estoque = $_POST['estoque'];

    $valor_estoque = $_POST['valor_estoque'];

    $status_estoque = $_POST['status_estoque'];

	$status = (int)$_POST['status'];
    
?>