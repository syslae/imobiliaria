<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');

     $Cliente_id = $_POST['cliente_id'];
     $AnoEmissao = $_POST['ano_emissao'];
     $MesEmissao = $_POST['mes_emissao'];
     $Tipo = $_POST['tipo'];
     $FiltroCliente = $_POST['filtro_cliente'];
     $FiltroMes     = $_POST['filtro_mes'];
     $FiltroNpd     = $_POST['filtro_npd'];
    if(empty($_POST['tipo']) or empty($FiltroCliente) or empty($FiltroMes) or empty($FiltroNpd))
    {
        echo "<script>alert('Preencha todos os campos!!!!')</script>";
        echo "<script>window.close();</script>";
        exit();
    }
    else
    {
        include("relatorio_cliente.php");
    }
?>