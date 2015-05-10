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
        $tituloRel = 'Relatório Cliente';
        $path_logo = "../../../webroot/img_modulos/empresas/".$log_empresa."";
        (!empty($log_empresa) && file_exists($path_logo)) ? $this->Image("../../../webroot/img_modulos/empresas/".$log_empresa."",9,10,44,18) : false;
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


  if($Cliente_id>0)
  {
    $Condicao = "and cliente.id = '".$Cliente_id."' ";
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
 	$sql2 = "select  cliente.tipo,cliente.nome,cliente.cnpj,cliente.razao_social,cliente.observacao,cliente.nome_fantasia,cliente.identidade,
    cliente.cpf,cliente.inscricao_estadual,cliente.logradouro,cliente.bairro,cliente.numero,cliente.cep,cliente.telefone,
    cliente.celular,estado.nome as estado ,cidade.nome  as cidade from cliente
    inner join cidade on cidade.id = cliente.cidade_id
    inner join estado on estado.id = cliente.estado_id
       where espaco_fisico_id = '".$_SESSION['espaco_fisico_id']."' $Condicao";
	$rs = $DB->Execute($sql2);
	$pdf->AddPage();
	$pdf->SetWidths(array(20,13,28,25,50,17,12,17,21,18,18,20,40));	
    $pdf->Row(array("Nome","Tipo","Cnpj/Cpf","Insc.Estadual","Logradouro","Bairro","Numero","Cep","Telefone","Estado","Cidade","Pessoa Contato","Email"),array("L","L","L","L","L","L"));
    $pdf->SetFont('Arial','',8);

    while (!$rs->EOF)
	{
            
            if($rs->fields['tipo']== 'J')
            {
                $Nome = $rs->fields['nome_fantasia'];
                $Tipo = "Juridico";
                $Registro = $rs->fields['cnpj'];     
            }
            else
            {
                $Nome = $rs->fields['nome'];
                $Tipo = "Fisico";
                $Registro = $rs->fields['cpf'];     
                
            }
            
            $Inscricao_estudual = $rs->fields['inscricao_estadual']; 
            $Identidade  = $rs->fields['identidade']; 
            $Logradouro = $rs->fields['logradouro'];
            $Bairro = $rs->fields['bairro'];
            $Numero = $rs->fields['numero']; 
            $Cep =$rs->fields['cep']; 
            $Telefone = $rs->fields['telefone']; 
            $Estado = $rs->fields['cidade']; 
            $Cidade = $rs->fields['estado']; 
            $Email = $rs->fields['email']; 
            //$data_nascimento = $rs->fields['data_nascimento']; 
            $Pessoa_contato =  $rs->fields['pessoa_contato'];  
            
     $pdf->Row(array("$Nome","$Tipo","$Registro ","$Inscricao_estudual","$Logradouro","$Bairro","$Numero","$Cep","$Telefone","$Estado","$Cidade","$PessoaContato","$Email"),array("L","L","L","L","L","L","L","L","L","L","L","L","L","L" ));				
        
            
			
	   $rs->MoveNext();
	}	
	$pdf->Output();

?>