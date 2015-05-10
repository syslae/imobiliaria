<?
	include('../fpdf/fpdf.php');
	

class PDF extends FPDF
{
	
	
	//cabeçalho
	function Header()
	{

        session_start();
		include("../../../config/conexaoFc.php");
	    $log_empresa = 	$rs_espaco->fields['log_empresa'];
        $tituloRel = 'Relatório Empresa';
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

  if($empresa_id>0)
  {
    $Condicao = "where id = '".$empresa_id."' ";
  }

//Instancia da Classe
	$pdf=new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	//s$pdf->AddPage();
	$pdf->SetFillColor(255,0,0);	
	$pdf->SetFont('Arial','B',7);
	$pdf->SetDrawColor(500,500,500);	
	$pdf->SetLineWidth(0);
    srand(microtime()*1000000);
 	$sql2 = "select *from espaco_fisico $Condicao;";
	$rs = $DB->Execute($sql2);
	$pdf->AddPage();
	$pdf->SetWidths(array(50,48,22,30,50));	
	$pdf->Row(array("Razão Social","Nome Fantasia","Logradouro","Bairro","Telefone"),array("L","L","L","L","L","L"));
	$pdf->SetFont('Arial','',8);

    while (!$rs->EOF)
	{
            $RazaoSocial =  $rs->fields['razao_social'];
            $Logradouro = $rs->fields['logradouro'];
            $Telefone   = $rs->fields['telefone'];
            $NomeFantasia    = $rs->fields['nome_fantasia'];
            $Bairro = $rs->fields['bairro'];
            $pdf->Row(array("$RazaoSocial","$NomeFantasia","$Logradouro","$Bairro","$Telefone"),array("L","L","L","L","L" ));				
			
	   $rs->MoveNext();
	}	
	$pdf->Output();

?>