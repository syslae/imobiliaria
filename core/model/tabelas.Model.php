<?php 	 
	$id = (int)$_POST['id'];
     
	$tabela_id = (int)$_POST['tabela_id'];
     
	$menu_id = (int)$_POST['menu_id'];
     
	$nome = trim($_POST['nome']);
	$nome = substr($nome,0,50);
	$nome=addslashes($nome); 
	
     
	$tipo = (int)$_POST['tipo'];
     
	$pasta = trim($_POST['pasta']);
	$pasta = substr($pasta,0,100);
	$pasta=addslashes($pasta); 
	
     
	$status = (int)$_POST['status'];
    
?>