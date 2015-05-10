<?
	include('../fpdf/fpdf.php');

	

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
        $nome_empresa = $rs_espaco->fields['descricao'];
        $tituloRel = 'Relatório de Lotes Disponíveis';


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
		$this->Cell(50,-5,$tituloRel,0,0,'C');	
        $this->Ln(10);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,-5,$nome_empresa,0,0,'C');	
		$this->Ln(10);
        $this->Cell(190,-5,$loteamento,0,0,'C'); 
         $this->Ln(3);

		$this->SetFont('Arial','B',8);
		$this->Cell(540,0,'  Emissão: ' .date('d/m/Y'),0,0,'C');
		$this->Ln(3);
        $this->SetWidths(array(40,80,40));   
        $this->Row(array("Código","Descrição","Valor"),array("L","L","L"));
		$this->Cell(75);
		$this->Cell(200,0,'                                                                                                                                                                                                                                     Hora: ' .date('H:m'),0,0,'C');
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


  if($produto_id>0)
  {
    $Condicao = "and produto_principal_id = '".$produto_id."' ";
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
 	 $sql2 = "select descricao, valor, codigo,produto_principal_id from produto 
       where espaco_fisico_id = '".$_SESSION['espaco_fisico_id']."' 
       and status =1   $Condicao order by produto_principal_id,codigo";
	$rs = $DB->Execute($sql2);

    //   $sql_loteamento = "select descricao from produto where id = ".$produto_id."";
    // $rs_loteamento = $DB->Execute($sql_loteamento);
    // $loteamento = $rs_loteamento->fields['descricao'];


	$pdf->AddPage();
    // $pdf->Row(array($loteamento),array("C"));
 //    $pdf->Ln(10);
	// $pdf->SetWidths(array(40,80,40));	
 //    $pdf->Row(array("Código","Descrição","Valor"),array("L","L","L"));
 //    $pdf->SetFont('Arial','',8);


   

    $qtd = 0;
    while (!$rs->EOF)
	{
            
            // if($rs->fields['tipo']== 'J')
            // {
            //     $Nome = $rs->fields['nome_fantasia'];
            //     $Tipo = "Juridico";
            //     $Registro = $rs->fields['cnpj'];     
            // }
            // else
            // {
            //     $Nome = $rs->fields['nome'];
            //     $Tipo = "Fisico";
            //     $Registro = $rs->fields['cpf'];     
                
            // }
            
            $valor  = $rs->fields['valor']; 
            $descricao = $rs->fields['descricao']; 
            if(($valor == null) or ($valor ==0))
            {
                $valor = '-----';
            }else
            {
                $valor = 'R$ '.$rs->fields['valor'].',00';
                $valor_total += $rs->fields['valor'];
            }
            
            $codigo = $rs->fields['codigo'];
            $qtd++;
            // $Bairro = $rs->fields['bairro'];
            // $Numero = $rs->fields['numero']; 
            // $Cep =$rs->fields['cep']; 
            // $Telefone = $rs->fields['telefone']; 
            // $Estado = $rs->fields['cidade']; 
            // $Cidade = $rs->fields['estado']; 
            // $Email = $rs->fields['email']; 
            // //$data_nascimento = $rs->fields['data_nascimento']; 
            // $Pessoa_contato =  $rs->fields['pessoa_contato'];  
            
     $pdf->Row(array("$codigo","$descricao","$valor "),array("L","L","L"));				
        
            
			
	   $rs->MoveNext();
	}

    $valor_total = 'R$ '.$valor_total.',00';


    
    // $pdf->Line(20, 45, 210-20, 45);
    $pdf->Ln(3);
    number_format($valor_total);
    $pdf->Row(array("TOTAL:","$qtd","$valor_total"),array("L","L","L"));  

	$pdf->Output();

?>