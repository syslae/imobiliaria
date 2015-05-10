<?
    session_start();
  	require("../../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
    include('../../../funcoes.inc.php');
    include('../fpdf/fpdf.php');
    $id  		 = $_REQUEST['id'];
class PDF extends FPDF
{
	///cabeçalho
	function Header()
	{

		session_start();
		include("../../../config/conexaoFc.php");
	    $SqlParametro = "select *from parametro";
        $DadosParamento = $DB->Execute($SqlParametro);
        //$this->Image('../../../webroot/img_modulos/empresas/expocenter.jpg',9,4,44,18);
		$this->Ln(2);
		$this->Cell(80);
		$this->SetFont('Arial','B',10);
		$this->Cell(48,-5,$DadosParamento->fields['razao_social'],0,0,'C');		
		$this->Ln(4);
        $this->Cell(83);
		$this->Cell(48,-5,'CNPJ:'.$DadosParamento->fields['cnpj'].' INC. ESTADUAL:'.$DadosParamento->fields['ie'].' TELEFONE: '.$DadosParamento->fields['fone'],0,0,'C');		
        $this->Cell(23);
		$this->Cell(1,3,$DadosParamento->fields['logradouro'].'-'.$DadosParamento->fields['bairro'].'/'.$DadosParamento->fields['cidade'].'-'.$DadosParamento->fields['estado'],0,0,'R');		
        $this->Ln(4);
        $cont=1;
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
	$pdf->SetFillColor(255,0,0);	
	$pdf->SetDrawColor(500,500,500);	
	$pdf->SetLineWidth(0);
    srand(microtime()*1000000);
     $sql2 = "select produto_id, produto.descricao_reduzida,produto.codigo,produto.valor,itens.valor_total,itens.quantidade from itens inner join produto on produto.id = itens.produto_id
                where itens.pedido_id = '".$id."' and itens.status = '1' ";
	  $rs = $DB->Execute($sql2);
    $SqlPedido = "select *from pedido where id = '".$id."'";
    $Rscliente = $DB->Execute($SqlPedido);
    $SqlCliente = "select  estado.nome as NomeEstado,cliente.tipo, cliente.nome as NomeCliente,cliente.razao_social as RazaoSocial, cidade.nome as NomeCidade,
                   cliente.cep,cliente.telefone,cliente.logradouro,cliente.bairro from  cliente inner join estado on cliente.estado_id =  estado.id inner join cidade on cliente.cidade_id =  cidade.id
                   where cliente.id = '".$Rscliente->fields['cliente_id']."'"; 
    $DadosCliente = $DB->Execute($SqlCliente);
    $pdf->AddPage();
 	$pdf->SetWidths(array(190));
    $pdf->Row(array("NUMERO PEDIDO:".$id.""),array("R"));
      
    if(empty($DadosCliente->fields['tipo']))
    {
           $pdf->SetWidths(array(170));
    }
    else
    {
         if($DadosCliente->fields['tipo'] == "F")
        {
           	$NomeCliente =  $DadosCliente->fields['NomeCliente'];
        }
        else
        {
            $NomeCliente =  $DadosCliente->fields['RazaoSocial'];
        }
        $pdf->SetWidths(array(170));
        $pdf->Row(array("DADOS CLIENTES"),array("C"));
        $pdf->SetWidths(array(50,80,50));	
        $pdf->Row(array("Nome: ".$NomeCliente,"Logradouro: ".$DadosCliente->fields['logradouro'],"Bairro: ".$DadosCliente->fields['bairro']),array("L","L","L"));
        $pdf->SetWidths(array(50,50,50));	
        $pdf->Row(array("Cidade: ".$DadosCliente->fields['NomeCidade'],"Estado: ".$DadosCliente->fields['NomeEstado'],"Telefone: ".$DadosCliente->fields['telefone']),array("L","L","L"));
        $pdf->SetWidths(array(170));
    }
    $pdf->Row(array("ITENS ORCAMENTO"),array("C"));
    $pdf->SetWidths(array(200));	
    $pdf->Row(array("___________________________________________________________________________________________________"),array("L"));
    $pdf->SetWidths(array(20,100,28,30,20));	
    $pdf->Row(array("CODIGO","DESCRICAO","QUANT.","VALOR","TOTAL"),array("L","L","L","L","L"));
    $count = 0;     
    while (!$rs->EOF)
	{
             $pdf->Row(array($rs->fields['codigo'],$rs->fields['descricao_reduzida'],$rs->fields['quantidade'],"R$ ".moeda($rs->fields['valor']),"R$ ".moeda($rs->fields['quantidade']*$rs->fields['valor'])),array("L","L","L","L"));				
			 $ValorTotal1 = ($rs->fields['quantidade']*$rs->fields['valor']);
             $ValorTotalProcedimentos = $ValorTotalProcedimentos+$ValorTotal1;
       $count++;
       $rs->MoveNext();
	
    }	
    $pdf->SetWidths(array(200));	
    $pdf->Row(array("___________________________________________________________________________________________________"),array("L"));
    $pdf->SetWidths(array(40,150));	
    $pdf->Row(array("Qtd. Itens: ".$count,"Valor Total:R$ ".moeda($ValorTotalProcedimentos)),array("L","R"));
  
    $pdf->Output();
  
?>