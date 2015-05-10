<?
	include('../fpdf/fpdf.php');
	session_start();

class PDF extends FPDF
{

	//cabeçalho
	function Header()
	{

		session_start();
		include("../../../config/conexaoFc.php");
		$sql_espaco_fisico = "select descricao,classificacao,log_empresa from espaco_fisico where id = ".$_SESSION["espaco_fisico_id"]."";
		$rs_espaco = $DB->Execute($sql_espaco_fisico);
        $log_empresa = 	$rs_espaco->fields['log_empresa'];
        $tituloRel = 'Relatório Faturamento';
	    $this->Image("../../../webroot/img_modulos/empresas/".$log_empresa."",9,10,44,18);
        $this->SetFont('Arial','B',10);
	    $this->Cell(75);
	   	$this->Ln(10);
		$this->Cell(75);
		$this->SetFont('Arial','B',20);
		$this->Cell(150,-5,$tituloRel,0,0,'C');
		$this->Ln(1);
		$this->SetFont('Arial','B',8);
		$this->Cell(540,0,'  Emissão: ' .date('d/m/Y'),0,0,'C');
		$this->Ln(3);
		$this->Cell(75);
		$this->Cell(200,0,'                                                                                                                                                                                                                                     Hora: ' .date('H:m'),0,0,'C');
		$this->Cell(0);
        $this->Ln(13);
        $cont=1;

	}
	//rodape
	function Footer()
	{
		$data_emissao		= date("d/m/Y H:m:s");
		$this->SetY(-20);
		$this->SetFont('Arial','I',10);

		$this->Ln(4);
		$this->Cell(18);
		$this->SetFont('Arial','',9);
		$this->Cell(1,10,'Emitido em: '.$data_emissao,0,0,'L');
		//$this->Cell(88);
		$this->Cell(1,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
		$this->Ln(10);
	}

   var $widths;
   var $aligns;

   function SetWidths($w)
   {
     $this->widths=$w;
   }

   function SetAligns($a)
   {
     $this->aligns=$a;
   }


   function Row($data, $align)
   {
     $nb=0;
     for($i=0;$i< count($data);$i++)
         $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
     $h=5*$nb;
     $this->CheckPageBreak($h);
     for($i=0;$i< count($data);$i++)
     {
         $w=$this->widths[$i];
         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
         $x=$this->GetX();
         $y=$this->GetY();
         $this->Rect($x,$y,$w,$h);
         $this->MultiCell($w,5,$data[$i],0,$align[$i]);
         $this->SetXY($x+$w,$y);
     }
     $this->Ln($h);
   }

   function CheckPageBreak($h)
   {
     if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }

   function NbLines($w,$txt)
   {
     $cw=&$this->CurrentFont['cw'];
     if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
     $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
     $s=str_replace("\r",'',$txt);
     $nb=strlen($s);
     if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
     $sep=-1;
     $i=0;
     $j=0;
     $l=0;
     $nl=1;
     while($i<$nb)
     {
         $c=$s[$i];
         if($c=="\n")
         {
             $i++;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
             continue;
         }
         if($c==' ')
             $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
             if($sep==-1)
             {
                 if($i==$j)
                     $i++;
             }
             else
                 $i=$sep+1;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
         }
         else
             $i++;
     }
     return $nl;
   }

}


//Instancia da Classe
	$pdf=new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	//s$pdf->AddPage();
	$pdf->SetFillColor(255,0,0);
	$pdf->SetDrawColor(500,500,500);
	$pdf->SetLineWidth(0);
    srand(microtime()*1000000);

     if($Tipo == "pago")
     {
        $TipoMostra1  = "Pago";
        $Imprimir1 = " and movimentacao.situacao_pagamento_id = 1";
     }
     elseif($Tipo == "naopago")
     {
         $TipoMostra1  = "Não Pago";
         $Imprimir1 = " and movimentacao.situacao_pagamento_id = 2";
     }
     else
     {
         $TipoMostra1  = "Todos";
     }
     if($FiltroNpd == "1")
     {
        $Imprimir4 = " and movimentacao.n_pd !=''";
     }
     elseif($FiltroNpd == "2")
     {
        $Imprimir4 = " and movimentacao.n_pd = ''";
     }
     else
     {
         $TipoMostra  = "Todos";
     }
     if($FiltroCliente == 1)
     {
        if($Cliente_id == 0)
        {
            echo "<script>alert('Selecione um cliente!!!!')</script>";
            echo "<script>window.close();</script>";
            exit();
        }
        $Imprimir2 = "and movimentacao.cliente_id = $Cliente_id";
     }
     if($FiltroMes == 1)
     {
        if($AnoEmissao == 0 or $MesEmissao== 0)
        {
            echo "<script>alert('Selecione um mês/ano referência!!!!')</script>";
            echo "<script>window.close();</script>";
            exit();
        }
        $Imprimir3 = "and movimentacao.ano_emissao = '".$AnoEmissao."' and movimentacao.mes_emissao = '".$MesEmissao."'";
     }

    $sql2 = "select distinct movimentacao.cliente_id from movimentacao
            inner join cliente on cliente.id = movimentacao.cliente_id  where movimentacao.espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."'
            $Imprimir1 $Imprimir2 $Imprimir3 $Imprimir4 and movimentacao.status = 1 order by cliente.nome_fantasia asc";
    $rs = $DB->Execute($sql2);


	$NumLinhas = $rs->RecordCount();
    if($NumLinhas == 0)
    {
        echo "<script>alert('Nenhum registro com esse filtro!!!');</script>";
        echo "<script>window.close();</script>";
        exit();
    }

    $Clientes = array();
    while(!$rs->EOF)
	{
            $SqlCliente ="select cliente.nome,cliente.tipo,cliente.nome_fantasia,movimentacao.valor,movimentacao.n_pd,
            movimentacao.nf,movimentacao.mes_emissao, meses.mes,ano.ano,movimentacao.data_nota,movimentacao.data_pagamento,
            servico.descricao,movimentacao.ano_emissao,movimentacao.numero_nota_empenho from movimentacao inner join cliente on cliente.id = movimentacao.cliente_id
            inner join servico on servico.id = movimentacao.servico_id
            inner join ano on ano.id  = movimentacao.ano_emissao
            inner join meses on meses.id  =  movimentacao.mes_emissao where movimentacao.cliente_id = '".$rs->fields['cliente_id']."' $Imprimir1 $Imprimir3  $Imprimir4 and movimentacao.status=1 order by movimentacao.mes_emissao desc";
            $RsClientes = $DB->Execute($SqlCliente);
        while(!$RsClientes->EOF)
	    {

            $Nf      = $RsClientes->fields['nf'];
            $NPD     = $RsClientes->fields['n_pd'];
            $NumeroNotaEmpenho = $RsClientes->fields['numero_nota_empenho'];
            $Servico = $RsClientes->fields['descricao'];
            $MesEmissao1 = $RsClientes->fields['mes'];
            $AnoEmissao1 = $RsClientes->fields['ano'];
            $Valor   = moeda($RsClientes->fields['valor']);
            $Valor1 =  $RsClientes->fields['valor'];
            if($RsClientes->fields['tipo'] == "J")
           {
            $Nome = $RsClientes->fields['nome_fantasia'];
           }
           else if($RsClientes->fields['tipo'] == "F")
           {
             $Nome = $RsClientes->fields['nome'];
           }
           $Valor3 = $ValorTotal;
           $ValorTotal = $Valor3+$Valor1;
           $data  =  $RsClientes->fields['data_pagamento'];
           $data_nota =  $RsClientes->fields['data_nota'];
           if($data > '0000/00/00')
           {
              $DataPagamento   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
           }

           if($data_nota > '0000/00/00')
           {
               $DataNota   =  (substr($data_nota,8,2).'/'.substr($data_nota,5,2).'/'.substr($data_nota,0,4));
           }else
           {
               $DataNota = '----';
           }

            $Clientes[]= array
            (
                "Nome"=>$Nome,
                "Nf"=>$Nf,
                "NumeroNotaEmpenho"=>$NumeroNotaEmpenho,
                "Servico"=>$Servico,
                "MesEmissao"=>$MesEmissao1,
                "AnoEmissao"=>$AnoEmissao1,
                "DataPagamento"=>$DataPagamento,
                "DataNota"=>$DataNota,
                "NPD"=>$NPD,
                "Valor"=>$Valor,
                "ValorTotal"=>$ValorTotal
             );
            $RsClientes->MoveNext();
        }
    $rs->MoveNext();
   }


    if($MesEmissao != 0)
   {
     $sql3 = "select *from meses where id = '".$MesEmissao."'";
     $ResultadoMes = $DB->Execute($sql3);
     $MesExibir =  $ResultadoMes->fields['mes'];
      $sql4 = "select *from ano where id = '".$AnoEmissao."'";
     $ResultadoAno = $DB->Execute($sql4);
     $AnoExibir =  $ResultadoAno->fields['ano'];
   }
   else
   {
      $MesExibir  = "Todos";
      $AnoExibir  = "Todos";

   }



    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
	$pdf->SetWidths(array(300,10));
   	$pdf->Row(array("Tipo: ".$TipoMostra1."  Mês/Referência: ".$MesExibir."/".$AnoExibir),array("C","C"));
	$pdf->Ln(5);
   	$pdf->SetFont('Arial','B',11);
    $pdf->SetWidths(array(45,37,32,25,25,25,25,45,28));
	$pdf->Row(array("Cliente","Mês/Ano referência","Empenho","PD","Nota Fiscal","Data Pagamento","Data Nota","Serviço","Valor(R$)"),array("L","L","L","L","L","L","L","L","L","L","L"));
	$pdf->SetFont('Arial','',12);




  foreach ($Clientes as $DadosClientes)
  {

    //        $DataNota      = (substr($data1,8,2).'/'.substr($data1,5,2).'/'.substr($data1,0,4));
       $pdf->Row(array($DadosClientes['Nome'],$DadosClientes['MesEmissao']."/".$DadosClientes['AnoEmissao'],$DadosClientes['NumeroNotaEmpenho'],$DadosClientes['NPD'],$DadosClientes['Nf'],$DadosClientes['DataPagamento'],$DadosClientes['DataNota'],$DadosClientes['Servico'],$DadosClientes['Valor']),array("L","L","L","L","L"));
   }

	$pdf->SetFont('Arial','B',15);
    $pdf->SetWidths(array(270));
	$pdf->Row(array("Valor Total:R$ ".moeda($ValorTotal).""),array("R"));

    $pdf->Output();

?>
