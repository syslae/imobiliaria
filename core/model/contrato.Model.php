<?php 	 
	$id = (int)$_POST['id'];
     
	$cliente_id = (int)$_POST['cliente_id'];
    
    $servico_id = $_POST['servico_id'];
     
	$numero_contrato = trim($_POST['numero_contrato']);
	$numero_contrato = substr($numero_contrato,0,50);
	$numero_contrato=addslashes($numero_contrato); 
     
	$data_inicio = trim($_POST['data_inicio']); 
	$data_final = trim($_POST['data_final']); 
	$valor_mensal = trim($_POST['valor_mensal']); 
	$volor_total = trim($_POST['volor_total']); 
	$status = (int)$_POST['status'];
    //exit();
?>