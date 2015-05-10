<?php
$pdf->Image('./imagens/'.$imgLogo, $pdf->GetX()+1, $pdf->GetY()+1, 20, 4, $ext, '');
$pdf->setX($w[4]);
$pdf->Cell ( $w[1], ($h[0]*1.5), '', 0, 0, 'l', 0 );
$pdf->Image('./imagens/'.$imgLogo, $pdf->GetX()+1, $pdf->GetY()+1, 20, 4, $ext, '');
$pdf->setX(70);

$pdf->SetFont('helvetica', 'B', 9);

$pdf->Cell ( $w[0], ($h[0]*1.5), $codBanco."-".$dvBanco, 1, 0, 'L', 0 );
$pdf->Cell ( $w[2], ($h[0]*1.5), $repNumerica, 1, 0, 'L', 0 );

$pdf->SetFont('helvetica', '', 6);

$pdf->Ln();

    $pdf->Cell ( $w[0], $h[1], utf8_encode($nomeFantasia), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[1], 'Local de Pagamento', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[4], $h[1], 'Vencimento', 'LR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], 'Recibo do Pagador', 1, 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[0], utf8_encode($localPagamento), 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[4], $h[0], $vencimento, 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], 'Vencimento', 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[1], utf8_encode('Beneficiário: '.$nomeCedente." - ". $CnpjAvalista), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[4], $h[1], utf8_encode('Agência/Código do Cedente'), 'LR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $vencimento, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[0], utf8_encode($enderecoAvalista), 'LBR', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $codCedente, 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], utf8_encode('Agência/Código Cedente'), 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], utf8_encode('Data de Emissão'), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], utf8_encode('Número do Doc'), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], utf8_encode('Espécie Doc'), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Aceite', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Dt. Processamento', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[4], $h[1], 'Nosso Numero', 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $codCedente, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[0], $dtEmissao, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $numDoc, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $especieDoc, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $aceite, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $dtProcessamento, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $nossoNumero, 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], utf8_encode('Número do Documento'), 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Uso do Banco', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Carteira', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], utf8_encode('Espécie Moeda'), 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Qtde Moeda', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[1], 'Valor Moeda', 'LTR', 0, 'L', 0 );
$pdf->Cell ( $w[4], $h[1], '(=) Valor do Documento', 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $numDoc, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[5], $h[0], $usoBanco, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $carteira, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $especie, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], $quantidadeMoeda, 'LBR', 0,'L', 0);
$pdf->Cell ( $w[5], $h[0], '', 'LBR', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $valorDoc, 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], 'Nosso Numero', 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );

$pdf->Cell ( $w[3], $h[0], utf8_encode($intrucoes) , 'LR', 0,'L', 0);
$pdf->Cell ( $w[4], $h[1], '(-) Desconto/Abatimento', 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $nossoNumero, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[6]+38, $h[0], utf8_encode($mensagemJuros." ".$instrucaoVenc1), 'L', 0,'L', 0);
$pdf->Cell ( $w[6]-38, $h[0], $mensagemSequencial, 'R', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $desconto, 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], '(=) Valor do Documento', 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[0], utf8_encode($mensagemMulta." ".$instrucaoVenc2), 'L', 0,'L', 0);
$pdf->Cell ( $w[4], $h[1], utf8_encode('(+) Mora/Multa'), 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $valorDoc, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemParam1), 'L', 0,'L', 0);
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemAluno1), 'R', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], '', 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], '(-) Desconto/Abatimento', 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemParam2), 'L', 0,'L', 0);
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemAluno2), 'R', 0,'L', 0);
$pdf->Cell ( $w[4], $h[1], utf8_encode('(+) Acréscimos'), 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], $desconto, 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemParam3), 'L', 0,'L', 0);
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemCurso1), 'R', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], '', 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], utf8_encode('(+) Acréscimos'), 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemParam4), 'L', 0,'L', 0);
$pdf->Cell ( $w[6], $h[0], utf8_encode($mensagemCurso2), 'R', 0,'L', 0);
$pdf->Cell ( $w[4], $h[1], utf8_encode('(=) Valor Cobrado'), 'LTR', 0, 'L', 0 );
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], '', 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[3], $h[0], utf8_encode($mensagemParam5), 'L', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], '', 'LBR', 0, 'L', 0 );
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1]+0.4, '(=) Valor Cobrado', 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[7]- $w[4], $h[0], utf8_encode('Pagador '.$mat." - ".$nomeSac) , 'LT', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $conteudo_cpf, 'TR', 0,'L', 0);
$pdf->Ln();
$pdf->Cell ( $w[0], $h[0], '', 'LBR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[7], $h[0], utf8_encode($enderecoSac." ".$Numero), 'LR', 0,'L', 0);
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1]+0.4, 'Pagador '.$mat, 'LR', 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );

$pdf->Cell ( $w[7]- ($w[4] * 2), $h[0], utf8_encode($enderecoSac2) , 'L', 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $conteudo_turma, 0, 0,'L', 0);
$pdf->Cell ( $w[4], $h[0], $conteudo_predio, 'R', 0,'L', 0);
$pdf->Ln();
$pdf->MultiCell($w[0], ($h[0]*2), utf8_encode(substr($nomeSac,0,28)).' ...','LBR','L');


$pdf->SetXY($pdf->GetX()+30, $pdf->GetY()-7);
$pdf->Cell ( $w[1], $h[0], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[7], $h[0], $conteudo_curso, 'LBR', 0,'L', 0);
$pdf->Ln();

$pdf->Cell ( $w[0], $h[1], '', 0, 0, 'L', 0 );
$pdf->Cell ( $w[1], $h[1], '', 0, 0, 'L', 0 );
$pdf->write1DBarcode($codBarra, 'I25', '', '',  103,  13, 0.4, $style, 'S');
$pdf->SetX($pdf->GetX()+118);
$pdf->Cell ( $w[4], $h[0], utf8_encode('Autenticação Mecânica - Ficha de Compensação')  , 0, 0,'L', 0);
$pdf->Ln();
$pdf->SetX($pdf->GetX()+150);
$pdf->Cell ( $w[4]/2, $h[0], utf8_encode("Autenticação no verso"), 0, 0,'L', 0);
$pdf->Cell ( $w[4]/2, $h[0], utf8_encode($sistema_desc), 0, 0,'R', 0);
$pdf->Ln(10);


if(($posicao == 3 and ($naoQuebrarPagina != $fim_registros)) or ($QtdeBoletosPorPagina === '0')) {
	
  $pdf->AddPage('P', 'A4');
      
}else{
	if($posicao != 3)
	{
   	    //$pdf->Cell ( 0, 1, '', 'T', 0,'L', 0);
        $pdf->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
        $pdf->Cell ( 0, 1, '', 'T', 0,'L', 0);
        $pdf->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Ln();
    }
}


