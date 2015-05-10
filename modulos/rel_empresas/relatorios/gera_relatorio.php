<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');

	
	$empresa_id   		 = $_POST['empresa_id'];
  
  
    if ($_POST['filtro_empresa'] == 1  and $_POST['empresa_id'] == "0")
    {
        echo "<script>alert('Selecione uma empresa!!!!')</script>";
        echo "<script>window.close();</script>";
        exit();
    } 
    else if ($_POST['filtro_empresa'] == 0)
    {
        echo "<script>alert('Selecione um dos campos!!!!')</script>";
        echo "<script>window.close();</script>";
        exit();
    } 
  
  
  	include("relatorio_empresa.php");

?>