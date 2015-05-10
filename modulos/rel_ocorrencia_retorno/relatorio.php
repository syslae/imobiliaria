<?php


$retorno_c = explode("a",$_POST['c']);

$Filtros .= ' #Retorno(s): '.implode(',',$retorno_c);
if($SituacaoM){
    $Filtros .= ' #Relatório de retorno por situação: ';

    $Descricoes_Situacao_Pagamento = $DB->Execute("select descricao as Descricao from situacao_pagamento where id in ('".implode("','",$SituacaoM)."')");

    foreach($Descricoes_Situacao_Pagamento as $registro){

        $Filtros .= $registro['Descricao'].',';

    }
}

$pdf->Cell(1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln();

//numeros dos retornos

$qtde_retorno = count($retorno_c);
if($SituacaoM) $qtde_retorno = 2; //valor referente a um registro

if (($qtde_retorno-1) > 1)
{
    $qtd_titulos_geral = 0;$total_diferenca_amais_geral = 0; $total_diferenca_amenos_geral = 0; $total_titulos_geral = 0; $total_recebido_geral =0;

}

$j = 0;

While ($j < ($qtde_retorno-1))
{
    if($j != 0){
        $pdf->AddPage('L','A4');
        $pdf->Cell(1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'RETORNO BANCÁRIO', 0, 0, 'C');
        $pdf->Ln();

    }

    if(!$Ano){
        $dAno = $DB->Execute("select * from ocorrencia_retorno where num_retorno = '".$retorno_c[$j]."' limit 1")->fields["DataRet"];
        $Ano = substr($dAno,0,4);
    }



    $dados_retorno = $relatorioObj->getRetorno($retorno_c[$j], $Layout, $Filtro, $Ano,$idBanco,$SituacaoM);

    $i = 0;
    $tamanho = count($dados_retorno);

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 5, "RETORNO Nº:", 0, 0, 'L');
    $pdf->Cell(20, 5, $dados_retorno[0]['NumRetorno'], 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(28, 5, "DATA MOVIMENTO:", 0, 0, 'L');
    $pdf->Cell(20, 5, $dados_retorno[0]["DataRet"], 0, 0, 'L');

    $pdf->Ln(5);
    $pdf->Cell(0, 0, '', 1, 1, 'L');
    $pdf->Ln(2);

    $qtd = 0; $total_titulos = 0; $qtd_titulos = 0; $total_recebido = 0; $total_diferenca_amais = 0; $total_diferenca_amenos = 0;

    $grupoSituacao = '';

    $zebrado = true;
    

    While ($i < $tamanho)
    {

        $dados = $relatorioObj->getRelatorio($dados_retorno[$i]["NossoNumero"],$dados_retorno[$i]["idContaMigrada"],$Layout);

        //print_r($dados); exit();
        //for($i=0; $i < count($dados);$i++){


        if (!empty($dados_retorno)) {

            $nome_situacao = $dados_retorno[$i]["Situacao"];
            $c = array(16,76,10,10,14,35,20,20,19,19,19,19);

            $desc = 'CÓDIGO';

            if(!empty($relatorio_por_situacao)){

                $desc = 'RETORNO';

                $dados[0]["Nome"] = $dados[0]['Matricula'].' - '.$dados[0]["Nome"];
                $dados[0]['Matricula'] = $dados_retorno[$i]['NumRetorno'];


            }

            //primeira vez
            if($grupoSituacao=='')
            {
                $grupoSituacao = $nome_situacao;

                $pdf->Cell(17, 5, "SITUAÇÃO:", 0, 0, 'L');
                $pdf->Cell(60, 5, $nome_situacao, 0, 0, 'L');
                $pdf->Ln(6);

                $pdf->SetFont('', '', 4.5);
                $pdf->SetFillColor(68, 68, 68);
                $pdf->SetTextColor(255,255,255);

                $pdf->Cell($c[0], 5, $desc, 1, 0, 'C', 1);
                $pdf->Cell($c[1], 5, 'NOME', 1, 0, 'L', 1);
                $pdf->Cell($c[2], 5, 'CS', 1, 0, 'C', 1);
                $pdf->Cell($c[3], 5, 'SEQ.', 1, 0, 'C', 1);
                $pdf->Cell($c[4], 5, 'SITUAÇÃO BOL.', 1, 0, 'C', 1);
                $pdf->Cell($c[5], 5, 'NOSSO NÚMERO', 1, 0, 'C', 1);
                $pdf->Cell($c[6], 5, 'VENCIMENTO', 1, 0, 'C', 1);
                $pdf->Cell($c[7], 5, 'PAGAMENTO', 1, 0, 'C', 1);
                $pdf->Cell($c[8], 5, 'VALOR TÍTULO', 1, 0, 'C', 1);
                $pdf->Cell($c[9], 5, 'VALOR ESPERADO', 1, 0, 'C', 1);
                $pdf->Cell($c[10], 5, 'VALOR PAGO', 1, 0, 'C', 1);
                $pdf->Cell($c[11], 5, 'DIFERENÇA', 1, 0, 'C', 1);
                $pdf->Ln(5.5);
            }
            else
            {
                //segunda em diante quando mudar de curso
                if($grupoSituacao!=$nome_situacao)
                {
                    $grupoSituacao = $nome_situacao;

                    $pdf->Cell(20, 5, "QUANTIDADE:", 0, 0, 'L');
                    $pdf->Cell(60, 5, $qtd, 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(17, 5, "SITUAÇÃO:", 0, 0, 'L');
                    $pdf->Cell(60, 5, $nome_situacao, 0, 0, 'L');
                    $pdf->Ln(6);

                    $qtd = 0;

                    $pdf->SetFont('', '', 4.5);
                    $pdf->SetFillColor(68, 68, 68);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->Cell($c[0], 5, $desc, 1, 0, 'C', 1);
                    $pdf->Cell($c[1], 5, 'NOME', 1, 0, 'L', 1);
                    $pdf->Cell($c[2], 5, 'CS', 1, 0, 'C', 1);
                    $pdf->Cell($c[3], 5, 'SEQ.', 1, 0, 'C', 1);
                    $pdf->Cell($c[4], 5, 'SITUAÇÃO BOL.', 1, 0, 'C', 1);
                    $pdf->Cell($c[5], 5, 'NOSSO NÚMERO', 1, 0, 'C', 1);
                    $pdf->Cell($c[6], 5, 'VENCIMENTO', 1, 0, 'C', 1);
                    $pdf->Cell($c[7], 5, 'PAGAMENTO', 1, 0, 'C', 1);
                    $pdf->Cell($c[8], 5, 'VALOR TÍTULO', 1, 0, 'C', 1);
                    $pdf->Cell($c[9], 5, 'VALOR ESPERADO', 1, 0, 'C', 1);
                    $pdf->Cell($c[10], 5, 'VALOR PAGO', 1, 0, 'C', 1);
                    $pdf->Cell($c[11], 5, 'DIFERENÇA', 1, 0, 'C', 1);
                    $pdf->Ln(5.5);
                }

            }



            if (substr($Layout,-3) == '240' and empty($relatorio_por_situacao))
            {
                $total_diferenca = $dados_retorno[$i+1]["ValorEsperado"] - $dados_retorno[$i+1]["ValorPago"];
                $dt_pagamento = $dados_retorno[$i+1]["DtPagamento"];

                $style ="";
                if ($dados_retorno[$i+1]["BoletoBaixado"] == 'N')
                {
                    $style = 'color: #FF0000;';
                }
            }
            else
            {
                $total_diferenca = $dados_retorno[$i]["ValorEsperado"] - $dados_retorno[$i]["ValorPago"];
                $dt_pagamento = $dados_retorno[$i]["DtPagamento"];

                $style ="";
                if ($dados_retorno[$i]["BoletoBaixado"] == 'N')
                {
                    $style = 'color: #FF0000;';
                }
            }

            $style2 ="";
            if ($total_diferenca < 0) $total_diferenca_amais += $total_diferenca;
            else
            {
                $total_diferenca_amenos += $total_diferenca;
                if (moeda($total_diferenca) > 0) $style2 = 'color: #041607;';
            }

            if (substr($Layout,-3) == '240' and empty($relatorio_por_situacao)) $diferenca = moeda($dados_retorno[$i+1]["ValorEsperado"] - $dados_retorno[$i+1]["ValorPago"]);
            else $diferenca = moeda($dados_retorno[$i]["ValorEsperado"] - $dados_retorno[$i]["ValorPago"]);

            if (substr($Layout,-3) == '240' and empty($relatorio_por_situacao))
            {

                $ValorEsperado = ' R$ '.moeda($dados_retorno[$i+1]["ValorEsperado"]);
                $ValorPago = ' R$ '.moeda($dados_retorno[$i+1]["ValorPago"]);
            }
            else
            {

                $ValorEsperado = ' R$ '.moeda($dados_retorno[$i]["ValorEsperado"]);
                $ValorPago = ' R$ '.moeda($dados_retorno[$i]["ValorPago"]);
            }

            $valorDiferenca =  ' R$ ';
            if ($diferenca == '-0,00')
                $valorDiferenca .= '0,00';
            else
                $valorDiferenca .= $diferenca;

            if (!$zebrado){
                $zebrado = true ;
            } else {
                $zebrado = false ;
            }

            $pdf->SetTextColor(68,68,68);

            $pdf->SetFont('', '', 7);
            //Os campos de valores sempre serão alinhados a direita
            $pdf->SetWidths($c);
            $pdf->SetAligns(array('C','L','C','C','C','C','C','C','C','L','L','L','L'));
            $pdf->Row(array(
                $dados[0]['Matricula'],
                $dados[0]["Nome"],
                $dados_retorno[$i]["CS"],
                $dados[0]["Seq"],
                $dados[0]["SituacaoBol"],
                trim($dados_retorno[$i]["NossoNumero"]),
                trim($dados_retorno[$i]["DtVencimento"]),
                trim($dt_pagamento),
                ' R$ '. number_format($dados_retorno[$i]["ValorTitulo"], 2, ',', '.'),
                $ValorEsperado,
                $ValorPago,
                $valorDiferenca
            ),$zebrado);
            $pdf->Cell(0,0,'',1,1,'L');

            $qtd++; $total_titulos+= $dados_retorno[$i]["ValorTitulo"]; $qtd_titulos++;
            if (substr($Layout,-3) == '240' and empty($relatorio_por_situacao)) $total_recebido += $dados_retorno[$i+1]["ValorPago"];
            else $total_recebido += $dados_retorno[$i]["ValorPago"];




        }

        if (substr($Layout,-3) == '240' and empty($relatorio_por_situacao)) $i += 2;
        else $i++;
    }

    // ULTIMA linha de registro

    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(46, 5, "QUANTIDADE:", 0, 0, 'L');
    $pdf->Cell(20, 5, $qtd, 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "QUANTIDADE TÍTULOS:", 0, 0, 'L');
    $pdf->Cell(20, 5, $qtd_titulos, 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "TOTAL DIFERENÇA A MAIS:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_diferenca_amais*(-1)), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "TOTAL DIFERENÇA A MENOS:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_diferenca_amenos), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "VALORS DOS TÍTULOS:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_titulos), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "VALOR TOTAL RECEBIDO:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_recebido), 0, 0, 'L');
    $pdf->Ln(5);

    $pdf->Cell(0, 0, '', 1, 1, 'L');

    if (($qtde_retorno-1) > 1)
    {
        $qtd_titulos_geral += $qtd_titulos;$total_diferenca_amais_geral += ($total_diferenca_amais*(-1)); $total_diferenca_amenos_geral += $total_diferenca_amenos; $total_titulos_geral += $total_titulos; $total_recebido_geral +=$total_recebido;
    }
    $j++;
}

if (($qtde_retorno-1) > 1)
{
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(46, 5, "QUANTIDADE DE RETORNOS:", 0, 0, 'L');
    $pdf->Cell(20, 5, ($qtde_retorno-1), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "QUANTIDADE TÍTULOS GERAL:", 0, 0, 'L');
    $pdf->Cell(20, 5, $qtd_titulos_geral, 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "TOTAL DIFERENÇA A MAIS GERAL:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_diferenca_amais_geral), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "TOTAL DIFERENÇA A MENOS GERAL:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_diferenca_amenos_geral), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "VALORS DOS TÍTULOS GERAL:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_titulos_geral), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(46, 5, "VALOR TOTAL RECEBIDO GERAL:", 0, 0, 'L');
    $pdf->Cell(20, 5, moeda($total_recebido_geral), 0, 0, 'L');
    $pdf->Ln(5);
}


$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(0, 7, 'Filtros utilizados:'.$Filtros, 0, 0, 'C');
$pdf->Ln(7);
//$pdf->Output();
ob_clean();
$pdf->Output('retorno_bancario.pdf', 'I');

?>