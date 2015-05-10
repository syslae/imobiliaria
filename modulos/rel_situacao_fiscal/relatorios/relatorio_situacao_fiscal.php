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
        $tituloRel = 'Relatório Situação Fiscal';
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
 /*
     if($data_fim == " ")
     {
        $TipoMostra1  = "Ativo";
        $Imprimir1 = " and contrato.status = 1";
     }
     
   
   */
   


    $pdf->AddPage();
   	$pdf->SetFont('Arial','B',11);
    $pdf->SetWidths(array(100,100));	
	$pdf->Row(array("Documento Fiscal","Validade"),array("L","L"));
	$pdf->SetFont('Arial','',12);

     $sql = "select   'ALVARA' as Descricao, data_validade from alvara  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1  order by id desc";
     $rs = $DB->Execute($sql);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql1 = "select   'BALANÇO PATRIMONIAL' as Descricao, data_validade from balanco_patrimonial  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1  order by id desc";
     $rs = $DB->Execute($sql1);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql2 = "select   'CERTIDÃO SIMPLIFICADA' as Descricao, data_validade from certidao_simplificada  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."'  and status = 1 order by id desc";
     $rs = $DB->Execute($sql2);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql3 = "select   'CND ESTADUAL DIVIDA ATIVA' as Descricao, data_validade from cnd_estadual  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql3);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql4 = "select   'CND ESTADUAL NEGATIVA' as Descricao, data_validade from cnd_estadual_negativa  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql4);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql5 = "select   'CND FEDERAL' as Descricao, data_validade from cnd_federal  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql5);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql6 = "select   'CND INSS' as Descricao, data_validade from inss  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql6);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql7 = "select   'CND MUNICIPAL' as Descricao, data_validade from cnd_municipal  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql7);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql8 = "select   'CND TRABALHISTA' as Descricao, data_validade from trabalhista  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql8);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql9 = "select   'CR FGTS' as Descricao, data_validade from fgts  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql9);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql10 = "select   'CR ESTADO PIAUI' as Descricao, data_validade from crc_estado_piaui  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql10);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql11 = "select   'CR MUNICÍPIO TERESINA' as Descricao, data_validade from crc_municipio_teresina  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql11);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));				
  	 $sql12 = "select   'CRC SICAF' as Descricao, data_validade from crc_sicaf  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql12);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));
     $sql12 = "select   'FALÊNCIA CONCORDATA' as Descricao, data_validade from falencia  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' and status = 1 order by id desc";
     $rs = $DB->Execute($sql12);
     $data  =  $rs->fields['data_validade'];
     $data_validade   =  (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
     $pdf->Row(array($rs->fields['Descricao'],$data_validade),array("L","L"));					
  			
			
	$pdf->Ln(5);	
   

    $pdf->Output();

?>