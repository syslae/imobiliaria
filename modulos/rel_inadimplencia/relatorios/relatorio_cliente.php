<?
	include('../fpdf/fpdf.php');

    
	

class PDF extends FPDF
{
	
	
	
	//cabe�alho
	function Header()
	{

		session_start();
		include("../../../config/conexaoFc.php");
		$sql_espaco_fisico = "select descricao,classificacao,log_empresa from espaco_fisico where id = ".$_SESSION["espaco_fisico_id"]."";	
		$rs_espaco = $DB->Execute($sql_espaco_fisico);
        $log_empresa = 	$rs_espaco->fields['log_empresa'];
        $nome_empresa = $rs_espaco->fields['descricao'];
        $tituloRel = 'Relat�rio de Inadimpl�ncia';

        /*************  SELECT PARA EXIBIR OS CAMPOS NO CABECALHO*/

        $sql_loteamento = "select descricao from produto where id = ".$_SESSION["produto"].""; 
        $rs_loteamento = $DB->Execute($sql_loteamento);
        $loteamento = $rs_loteamento->fields['descricao'];

        /******************/
        
	    // $this->Image("../../../webroot/img_modulos/empresas/".$log_empresa."",9,10,44,18);
        $this->SetFont('Arial','B',10);
	    $this->Cell(75);
	   	$this->Ln(10);
		$this->Cell(75);
		$this->SetFont('Arial','B',20);
		$this->Cell(150,-5,$tituloRel,0,0,'C');		
		$this->Ln(10);
		 $this->SetFont('Arial','B',10);
        $this->Cell(290,-5,$nome_empresa,0,0,'C');  
        $this->Ln(10);
        $this->Cell(290,-5,$loteamento,0,0,'C');
        $this->SetFont('Arial','B',10);
		$this->Cell(540,0,'  Emiss�o: ' .date('d/m/Y'),0,0,'C');
		$this->Ln(3);
        $this->SetWidths(array(80,50,30,50,50,90));
        $this->Row(array("Nome","Cpf","Parcela","C�digo","Valor","Vencimento"),array("L","L","L","L","L","L"));
		$this->Cell(75);
		// $this->Cell(200,0,'                                                                                                                                                                                                                                     Hora: ' .date('H:m'),0,0,'C');
		$this->Cell(0);
        $this->Ln(1);		
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
		$this->Cell(1,10,'P�gina '.$this->PageNo().'/{nb}',0,0,'R');
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


  if($produto_id>0)
  {
    $Condicao = "and pd.produto_principal_id = '".$produto_id."' ";
  }


//Instancia da Classe
	$pdf=new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	//s$pdf->AddPage();
	$pdf->SetFillColor(255,0,0);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetDrawColor(500,500,500);	
	$pdf->SetLineWidth(0);
    srand(microtime()*1000000);

     $sql2="SELECT
    c.nome AS nome,
    c.cpf AS cpf,
    p.parcela AS parcela,
    p.id as parcela_id,
    pd.descricao as nome_produto,
    pd.codigo as codigo_produto,
    p.valor AS valor,
    p.data_vencimento AS vencimento,
    im.id as id_itens,
    DATEDIFF(CURDATE(), p.data_vencimento) AS dias_vencido
    FROM
    parcelas p
    INNER JOIN movimentacao m ON p.movimentacao_id = m.id
    INNER JOIN cliente c ON m.cliente_id = c.id
    inner join itens_movimentacao im on im.movimentacao_id = m.id
    inner join produto pd on im.produto_id = pd.id

    WHERE
    p.situacao_pagamento_id = 1
    AND DATEDIFF(CURDATE(), p.data_vencimento) > 0
    and c.espaco_fisico_id = '".$_SESSION['espaco_fisico_id']."' $Condicao order by c.nome, p.parcela";


    
	$rs = $DB->Execute($sql2);

    // $sql_loteamento = "select descricao from produto where id = ".$produto_id."";
    // $rs_loteamento = $DB->Execute($sql_loteamento);
    // $loteamento = $rs_loteamento->fields['descricao'];


	$pdf->AddPage();
 //    $pdf->Row(array($loteamento),array("C"));
 //    $pdf->Ln(10);
	// $pdf->SetWidths(array(80,50,50,50,90));
 //    $pdf->Row(array("Nome","Cpf","Parcela","Valor","Vencimento"),array("L","L","L","L","L"));
 //    $pdf->SetFont('Arial','',10);

    while (!$rs->EOF)
	{  

            $nome  = $rs->fields['nome']; 
            $cpf = $rs->fields['cpf']; 
            $parcela = $rs->fields['parcela'];
            $valor  = $rs->fields['valor']; 
            $descricao = $rs->fields['descricao']; 
            $codigo_produto = $rs->fields['codigo_produto'];
            if(($valor == null) or ($valor ==0))
            {
                $valor = '-----';
            }else
            {
                if(strpos($valor, '.'))
                {
                    $valor = 'R$ '.$rs->fields['valor'];
                }else
                {
                    $valor = 'R$ '.$rs->fields['valor'].',00';
                }
                
            }
            $data_vencimento = $rs->fields['vencimento'];
            $data_vencimento = explode('-', $data_vencimento);
            $data_vencimento = $data_vencimento[2].'/'.$data_vencimento[1].'/'.$data_vencimento[0];
            
     $pdf->Row(array("$nome","$cpf","$parcela ","$codigo_produto ","$valor ","$data_vencimento"),array("L","L","L","L","L","L"));				
        
            
			
	   $rs->MoveNext();
	}	
	$pdf->Output();

?>