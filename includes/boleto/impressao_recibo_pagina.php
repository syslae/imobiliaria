<?php  
$pdf->Image($imgLogo, $pdf->GetX()+1, $pdf->GetY()+1, 20, 8, $ext, '');
$pdf->setX(30);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell ( $w_recibo[0], $h_recibo[0], 'RECIBO', 0, 0, 'C', 0 );
$pdf->Ln();

$pdf->setX(30);
$pdf->Cell ( $w_recibo[0], $h_recibo[0], utf8_encode($planoConta), 0, 0, 'C', 0 );
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell ( $w_recibo[1], $h_recibo[0], utf8_encode('Data Emissão: '.$dataEmissao), 0, 0, 'R', 0 );
$pdf->Ln();

$pdf->setX(30);
$pdf->Cell ( $w_recibo[0], $h_recibo[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w_recibo[1], $h_recibo[0], utf8_encode('Hora: '.$hora), 0, 0, 'R', 0 );
$pdf->Ln();

$pdf->Cell ( $w_recibo[2], $h_recibo[0], utf8_encode($via[$posicao_via]), 'LT', 0, 'L', 0 );
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell ( $w_recibo[1], $h_recibo[0], utf8_encode('R$ '.$valorDoc), 'TR', 0, 'R', 0 );
$pdf->SetFont('helvetica', '', 11);
$pdf->Ln();

$pdf->Cell ( $w_recibo[3], $h_recibo[1], '', 'LR', 0, 'R', 0 );
$pdf->Ln();

$pdf->Cell ( $w_recibo[3], $h_recibo[0], utf8_encode($cidade." , ".$data1[1]), 'LR', 0, 'R', 0 );
$pdf->Ln();

$pdf->Cell ( $w_recibo[3], $h_recibo[0], '', 'LR', 0, 'R', 0 );
$pdf->Ln();

$pdf->Cell ( $w_recibo[4], $h_recibo[0], utf8_encode('Matrícula: '.$mat), 'L', 0, 'L', 0 );
$pdf->Cell ( $w_recibo[4], $h_recibo[0], '', 'BR', 0, 'C', 0 );
$pdf->Ln();

$pdf->Cell ( $w_recibo[4], $h_recibo[0], utf8_encode('Turma: '.$Turma), 'LB', 0, 'L', 0 );
$pdf->Cell ( $w_recibo[4], $h_recibo[0], utf8_encode('Secretaria/Tesouraria'), 'BR', 0, 'C', 0 );
$pdf->Ln(13);


if(($posicao == 3 and ($naoQuebrarPagina != $fim_registros)) or ($QtdeBoletosPorPagina === '0')) {

	$pdf->AddPage('P', 'A4');

}else
if($posicao != 3)
{

	$pdf->Cell ( 0, 1, '', 'T', 0,'L', 0);
	$pdf->Ln(10);
}