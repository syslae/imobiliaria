<?php 	 
	$id = (int)$_POST['id'];
     
	$qtde_vezes = (int)$_POST['qtde_vezes'];
     
	$status = trim($_POST['status']);
	$status = substr($status,0,1);
	$status=addslashes($status); 
    
?>