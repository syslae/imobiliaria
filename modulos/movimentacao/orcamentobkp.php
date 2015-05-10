 <script type="text/javascript">
		function DoPrinting(){
		if (!window.print){
		alert("Use o Netscape  ou Internet Explorer \n nas versões 4.0 ou superior!")
		return
		}
		window.print()
		}
	</script>
 
 <?
    session_start();
	require("../../config/define.php");
    require("../../includes/funcoes.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
    header("Content-type: text/html; charset=ISO-8859-1");
    $id = $_REQUEST['pedido_id'];
    
    
    $SqlCliente = "select *from pedido where id = '".$id."'";
   	$rscliente = $DB->Execute($SqlCliente);
    $Sql = "select *from itens where  pedido_id = '".$id."'";
   	$rs = $DB->Execute($Sql);
    $Numlinhas = $rs->RecordCount();
    $SqlParametro = "select *from parametro";
   	$DadosParamento = $DB->Execute($SqlParametro);
?>
 
 
 <table width="800"  align="center">
    <tr align="center" >
        <th height="80" colspan="5"><?=$DadosParamento->fields['razao_social']?></th>
    </tr>
    <tr>
        <td  colspan="5" align="center">CNPJ:<?=$DadosParamento->fields['cnpj']?> INCRIÇÃO ESTADUAL:<?=$DadosParamento->fields['ie']?> TELEFONE:<?=$DadosParamento->fields['fone']?><td>
    </tr>
    <tr>
        <td  colspan="5" align="center">AVENIDA CAMPOS SALES, 953 - CENTRO/ TERESINA-PI<td>
    </tr>
    <tr>
        <td height="80" colspan="3" align="right">Data Emissão: <?=date('d/m/Y')?>  Vendedor: <?=retornaNome('usuarios','nome',$rscliente->fields['usuario_id'])?></td>
    </tr>
     <tr>
        <th height="30" colspan="3" align="center">DADOS CLIENTE</th>
    </tr>
    </table>
   
    <?=DadosClientes($rscliente->fields['cliente_id']); ?>
    <table width="800" border="1" align="center">
    <tr align="center"  >
        <th colspan="5">ITENS VENDAS</th>
    </tr>
    <tr align="center" bgcolor="silver">
        <th width="15%">Codigo</th>
        <th>Descrição</th>
        <th width="10%">Quantidade</th>
        <th width="10%">Valor</th>
        <th width="10%">Total</th>
    </tr>
   <? while(!$rs->EOF)
   {
    echo '  
          <tr align="center" >
            <td>'.$rs->fields['produto_id'].'</td>
            <td>'.retornaNome('produto','descricao',$rs->fields['produto_id']).'</td>
            <td>'.$rs->fields['quantidade'].'</td>
            <td>R$ '.moeda($rs->fields['valor_total']/$rs->fields['quantidade']).'</td>
            <td>R$ '.moeda($rs->fields['valor_total']).'</td>
         </tr>';
       	$ValorTotal1 = $rs->fields['valor_total'];
        $ValorTotalProcedimentos = $ValorTotalProcedimentos+$ValorTotal1;
	  
     $rs->MoveNext();    
   } 
  ?>
    <tr>
        <th>Qtd. ITENS:<?=$Numlinhas?></th>
        <th colspan="4" align="right">VALOR TOTAL:R$ <?=moeda($ValorTotalProcedimentos)?></th>    
    </tr>
 </table>
 <table width="800">
     <tr>
        <td align="center"><a href='javascript:DoPrinting()' title='Imprimir'><img src='../../webroot/img_sistema/imprimir.gif' border='0'></a>
        <input type='button' value='Voltar' class='botao' onclick='javascript:history.go(-1)'></td>
    </tr>
 </table>
	
       