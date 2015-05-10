<?php
session_start();
set_time_limit(10000);
ini_set('memory_limit', '512M');

$dados = json_decode($_POST["dados"], true);

if(isset($dados['sac']) and $dados['sac'] != ''){
	$_GET['token'] = $dados['token'];
}

require("../../config/define.php");
require(DOMAIN_PATH."classes/tcpdf/tcpdf.php");
//require(DOMAIN_PATH."config/phplot/phplot.php");
require(DOMAIN_PATH . "config/conexaoAr.php");
require(DOMAIN_PATH . "funcoes.inc.php");
require(DOMAIN_PATH . "funcoesValidar.inc.php");


//cabeçalho default
$relatorio = 'impressao_documentos';

$pdf = new TCPDF();
$pdf->Open();

$pdf->SetMargins(8, 2, 8, true);
$pdf->setPrintHeader(false); // para remover o cabeçalho da pg
$pdf->setPrintFooter(false); // remove o rodapé

$pdf->AddPage('P', 'A4');

require("boleto.php");
ob_start ();

$pdf->Output('documentos.pdf', 'I');
?>