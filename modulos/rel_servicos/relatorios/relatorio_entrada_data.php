<?
	include('../fpdf/fpdf.php');
	

class PDF extends FPDF
{
	
	
	//cabeçalho
	function Header()
	{

		session_start();
		include("../../../config/conexaoFc.php");
		
		$tituloRel = 'Cadastros de Serviços';
	    $this->Image('../../../webroot/img_modulos/empresas/log_focus.jpg',9,10,44,18);
		$this->SetFont('Arial','B',10);
	    $this->Cell(75);
		//$this->Cell(48,30,'Data Inicial:'.$DataInicial.'Data Final'.$DataFim,0,0,'C');
       	$this->Ln(10);
		$this->Cell(75);
		$this->SetFont('Arial','B',20);
		$this->Cell(48,-5,$tituloRel,0,0,'C');		
		$this->Ln(1);
		$this->SetFont('Arial','B',8);
		$this->Cell(360,0,'  Emissão: ' .date('d/m/Y'),0,0,'C');
		$this->Ln(3);
		$this->Cell(75);
		$this->Cell(200,0,'                            Hora: ' .date('H:m'),0,0,'C');
		$this->Cell(0);
		$this->Ln(5);		
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
	$pdf=new PDF('P','mm','A4');
	$pdf->AliasNbPages();
	//s$pdf->AddPage();
	$pdf->SetFillColor(255,0,0);	
	$pdf->SetFont('Arial','B',7);
	$pdf->SetDrawColor(500,500,500);	
	$pdf->SetLineWidth(0);
    srand(microtime()*1000000);
 	$sql2 = "select *from servico where created >= '".$DataInicial."' and created <= '".$DataFim."' ";
	$rs = $DB->Execute($sql2);
	$pdf->AddPage();
	$pdf->SetWidths(array(50));	
	$pdf->Row(array("Descrição"),array("L"));
	$pdf->SetFont('Arial','',8);

    while (!$rs->EOF)
	{
            $Descricao =  $rs->fields['descricao'];
            $pdf->Row(array("$Descricao"),array("L"));				
			
	   $rs->MoveNext();
	}	
	$pdf->Output();

?>