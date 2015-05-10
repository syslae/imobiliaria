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
        $tituloRel = 'Relatório Contrato';
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
 
     if($Tipo == "ativo")
     {
        $TipoMostra1  = "Ativo";
        $Imprimir1 = " and contrato.status = 1";
     }
     elseif($Tipo == "vencido")
     {
         $TipoMostra1  = "Vencido";
         $Imprimir1 = " and contrato.data_final <= '".date('d/m/Y')."'";
     }
     elseif($Tipo == "inativo")
     {
         $TipoMostra1  = "Inativo";
         $Imprimir1 = " and contrato.status = '0'";
     }
     else
     {
         $TipoMostra1  = "Todos";
     }
     if($FiltroCliente == 1)
     {
        if($Cliente_id == 0)
        {
            echo "<script>alert('Selecione um cliente!!!!')</script>";
            echo "<script>window.close();</script>";
            exit();
        }
        
       if(($NumeroContrato)) 
       {  
          $Imprimir2 = "and contrato.cliente_id = $Cliente_id and contrato.numero_contrato = '".$NumeroContrato."'";
       }
       else
       {
          $Imprimir2 = "and contrato.cliente_id = $Cliente_id";
       } 
     }
     if($FiltroServico == 1)
     {
        if($Servico_id == 0)
        {
            echo "<script>alert('Selecione um serviço!')</script>";
            echo "<script>window.close();</script>";
            exit();
        }
        $Imprimir2 = "and contrato.servico_id = $Servico_id";
     }
     
   
     if($FiltroMes == 1)
     {
        if($AnoEmissao == 0 or $MesEmissao== 0)
        {
            echo "<script>alert('Selecione um mês/ano referência!!!!')</script>";
            echo "<script>window.close();</script>";
            exit();
        }    
        $Imprimir3 = "and contrao.ano_emissao = '".$AnoEmissao."' and movimentacao.mes_emissao = '".$MesEmissao."'";
     }   
   
       $sql2 = " select cliente.nome_fantasia,cliente.nome, cliente.tipo, cliente.razao_social, contrato.numero_contrato, contrato.data_final, contrato.valor_mensal,  servico.descricao 
              from contrato inner join cliente on cliente.id = contrato.cliente_id inner join servico on servico.id = contrato.servico_id
              where contrato.espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."'
            $Imprimir1 $Imprimir2 $Imprimir3 $Imprimir4  order by cliente.nome_fantasia asc, servico.descricao asc ";
       $rs = $DB->Execute($sql2);


	$NumLinhas = $rs->RecordCount();
    if($NumLinhas == 0)
    {
        echo "<script>alert('Nenhum registro com esse filtro!!!');</script>";
        echo "<script>window.close();</script>";
        exit();
    }
       
    $Contrato = array(); 
    while(!$rs->EOF)
	{ 
            
            if($rs->fields['tipo'] == "J")
           {
            $Nome = $rs->fields['nome_fantasia'];
           }
           else if($rs->fields['tipo'] == "F")
           {
             $Nome = $rs->fields['nome'];
           }
           
           $NumeroContrato = $rs->fields['numero_contrato'];
           $data  =  $rs->fields['data_final'];
           $DataVencimento   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
           $valor_mensal =  $rs->fields['valor_mensal'];
           $Servico =  $rs->fields['descricao'];
           
           $Valor3 = $ValorTotal;
           $ValorTotal = $Valor3+$valor_mensal;
           
            $Contrato[]= array
            (
                "Nome"=>$Nome,
                "NumeroContrato"=>$NumeroContrato,
                "DataVencimento"=>$DataVencimento,
                "ValorMensal"=>$valor_mensal,
                "Servico"=>$Servico,
                "ValorTotal"=>$ValorTotal
             );
       $rs->MoveNext();
     }
    
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
	$pdf->SetWidths(array(300,10));	
   	$pdf->Row(array("Tipo: ".$TipoMostra1."  Mês/Referência: ".$MesExibir."/".$AnoExibir),array("C","C"));
	$pdf->Ln(5);	
   	$pdf->SetFont('Arial','B',11);
    $pdf->SetWidths(array(50,20,90,30,40,40));	
	$pdf->Row(array("Cliente","Contrato","Serviço","Vigência","Valor Mensal(R$)","Valor Anual(R$)"),array("L","L","L","L","C","C"));
	$pdf->SetFont('Arial','',12);




  foreach ($Contrato as $DadosContrato)           
  {   
     $pdf->Row(array($DadosContrato['Nome'],$DadosContrato['NumeroContrato'],$DadosContrato['Servico'],$DadosContrato['DataVencimento'],moeda($DadosContrato['ValorMensal']),moeda(($DadosContrato['ValorMensal']*12))),array("L","L","L","L","C","C"));				
  
           $Valor3 = $ValorTotalAnual;
           $ValorTotalAnual = $Valor3+($DadosContrato['ValorMensal']*12);
  
  }
			
	$pdf->Ln(5);	
    $pdf->SetFont('Arial','B',15);
    $pdf->SetWidths(array(230,100));	
	$pdf->Row(array("TOTAL MENSAL:","R$ ".moeda($ValorTotal)),array("R","L"));				
	$pdf->Ln(1);	
    $pdf->SetWidths(array(230,100));	
	$pdf->Row(array("TOTAL ANUAL:","R$ ".moeda($ValorTotalAnual)),array("R","L"));				


    $pdf->Output();

?>