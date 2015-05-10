<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');

if(isset($_POST['tipoRelatorio'])){
	
	$relatorio   		 = $_POST['tipoRelatorio'];
    $data                = $_POST['data_inicio'];
    $DataInicial         = (substr($data,6,4).'/'.substr($data,3,2).'/'.substr($data,0,2));
    $data2               =          $_POST['data_fim'];
	$DataFim     			  = (substr($data2,6,4).'/'.substr($data2,3,2).'/'.substr($data2,0,2));
    $NotaFiscal        		  = $_POST['NotaFiscal'];
	$DescricaoSetor           = $_POST['Setor'];
	$DescricaoTipoEntrada     =  $_POST['TipoEntrada'];
	$Fornecedor               =  $_POST['Fornecedor'];
	
	include("relatorio_entrada_".$relatorio.".php");
}

?>