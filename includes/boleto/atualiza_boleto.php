<?php
session_start();
set_time_limit(10000);
ini_set('memory_limit', '512M');

$dados = json_decode($_POST["dados"], true);

$acesso_sac = false;
if(isset($dados['sac']) and $dados['sac'] != ''){
	$_GET['token'] = $dados['token'];
	$acesso_sac = true;
}

require("../../config/define.php");
require(DOMAIN_PATH."tcpdf/tcpdf.php");
//require(DOMAIN_PATH."config/phplot/phplot.php");
require(DOMAIN_PATH . "config/conexaoAr.php");
require(DOMAIN_PATH . "funcoes.inc.php");
require(DOMAIN_PATH . "datas.inc.php");
require(DOMAIN_PATH . "funcoesValidar.inc.php");
require_once(DOMAIN_PATH."funcoes_financeiro_boleto.php");

if(!isset($dados['sac'])){
	if(!isset($_GET['pace']))
		verifica ("../../login.php");
}

//cabeçalho default
$relatorio = 'impressao_documentos';

$pdf = new TCPDF();
$pdf->Open();

$pdf->SetMargins(8, 2, 8, true);
$pdf->setPrintHeader(false); // para remover o cabeçalho da pg
$pdf->setPrintFooter(false); // remove o rodapé

$pdf->AddPage('P', 'A4');

$boleto = $_GET['boleto'];
$boletosNovos = array();

$sql = "select id_Situacao_Pagamento from Situacao_Pagamento where Descricao = 'ABERTO'";
$id_Situacao_Pagamento = $DB->Execute($sql)->fields['id_Situacao_Pagamento'];

$sql = "select idTipoDocumentoFin from TipoDocumentoFin where Sigla = 'BOL'";
$idTipoDocumentoFin = $DB->Execute($sql)->fields['idTipoDocumentoFin'];

$sql = "select * from Mensalidades where NossoNumero = '$boleto'";
$rs = $DB->Execute($sql);

$valido = true;

if($rs->recordCount() == 0){
	echo("<script>alert('Boleto inválido.');window.close();</script>"); 
	die;
}

if (strtotime($rs->UserTimeStamp($rs->fields['DtVencimento'], 'Y-m-d'))  >= strtotime(date('Y-m-d'))){
	echo("<script>alert('Boleto não pode ser atualizado: data de vencimento maior que a data atual.');window.close();</script>"); 
	die;
}

if($rs->fields['id_Situacao_Pagamento'] != $id_Situacao_Pagamento){
	echo("<script>alert('Boleto não pode ser atualizado pois não encontra-se em aberto.');window.close();</script>"); 
	die;
}

if($rs->fields['idTipoDocumentoFin'] != $idTipoDocumentoFin){
	echo("<script>alert('Tipo de documento não é boleto.');window.close();</script>");
	die;
}

if($acesso_sac){
	$idBanco = $rs->fields['idBanco']; 
	
	$sql = "select ParcelaAtualizadaSAE from BancosBoletos where idBanco = '$idBanco'";
	$ParcelaAtualizadaSAE = (int) $DB->Execute($sql)->fields['ParcelaAtualizadaSAE'];
	
	if($ParcelaAtualizadaSAE != 1){
		echo("<script>alert('Essa conta não está habilitada para reimpressão de boleto atualizado.');window.close();</script>");
		die;
	}
}

	// foreach ($boletos as $bol){
	// 	$boletosNovos[] = gerarBoletoAtualizado($bol);
	// }

$boletosNovos[] = gerarBoletoAtualizado($boleto);

$_GET['bol'] =  $boletosNovos;

require("boleto.php");
ob_start ();

$pdf->Output('documentos.pdf', 'I');

?>