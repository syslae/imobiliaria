<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');
     $data_fim = $_POST['data_fim'];
     $data_inicio = $_POST['data_inicio'];
     
  
     include("relatorio_situacao_fiscal.php");
    
?>