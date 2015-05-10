<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');

	
	$produto_id   = $_POST['produto_id'];
     $_SESSION['produto'] = $produto_id;
  
  
    // if ($_POST['filtro_cliente'] == 1  and $_POST['cliente_id'] == "0")
    // {
    //     echo "<script>alert('Selecione um cliente!!!!')</script>";
    //     echo "<script>window.close();</script>";
    //     exit();
    // } 
    // else if ($_POST['filtro_cliente'] == 0)
    // {
    //     echo "<script>alert('Selecione um dos campos!!!!')</script>";
    //     echo "<script>window.close();</script>";
    //     exit();
    // } 
  
   
  	include("relatorio_cliente.php");

?>