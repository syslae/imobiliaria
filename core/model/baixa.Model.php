<?php 	 
	$id = (int)$_POST['id'];
     
	$usuario_id = $_SESSION['idusuario_g'];

    $cliente_id = $_POST['cliente_id'][0];

    $parcela_id_array = $_POST['c'];

    $data_baixa = $_POST['data_baixa'];

    $valor_baixa = $_POST['valor_baixa'];

	$status=1;
    
?>