<?php 	 
	$id = (int)$_POST['id'];
     
	$motivo = trim($_POST['motivo']);
	$motivo = substr($motivo,0,255);
	$motivo=addslashes($motivo); 
     
	$usuario_id = $_SESSION['idusuario_g'];

    $cliente_id = $_POST['cliente_id'][0];

    $parcela_id_array = $_POST['c'];

	$status=1;
    
?>