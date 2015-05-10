
<?
session_start();

  function ValorTotaPedido($pedido_id)
{
    require(DOMAIN_PATH."config/conexaoFc.php");
    $Sql = "select sum(valor_total) as Valor from itens where pedido_id = '".$pedido_id."'";
   	$rs = $DB->Execute($Sql);
    $ValorTotal = $rs->fields['Valor'];
    return $ValorTotal;
}

  function FormasPagamento()
  {

    require(DOMAIN_PATH."config/conexaoFc.php");
    $Sql = "select *from forma_pagamento";
   	$rs = $DB->Execute($Sql);
    
    while(!$rs->EOF)
    {
        echo  $Dados =   
                      "<tr>
                    <td height='36' align='right' class='text_bold_preto'>".$rs->fields['descricao'].":</td>
                     <td class='text_padrao'>
                      <input  type='text' maxlength='12' size='12' class='input_branco'/>
                    </td>
                </tr>"; 
        $rs->MoveNext();             
    }
  }
    function ValorTotal($Pedido_id)
  {
    require(DOMAIN_PATH."config/conexaoFc.php");
    $Sql = " select sum(valor_total) as valor_total from itens where pedido_id = '".$Pedido_id."'";
   	$rs = $DB->Execute($Sql);
    echo $ValorTotal =   ''.moeda($rs->fields['valor_total']).'<input  type="hidden" name="ValorTotal"   value="'.$rs->fields['valor_total'].'" id="ValorTotal" />';
  } 
 
  function QuantProduto($id)
  {

    require(DOMAIN_PATH."config/conexaoFc.php");
   

  
     $Sql = "select quantidade from produto where id = '".$id."'"; 
     $rs = $DB->Execute($Sql);
    $ValorTotal =  $rs->fields['quantidade'];
    return $ValorTotal;
  } 

function data_mostra($data) {
if ($data!='') 
{
   return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
}
else { return ''; }

}
function pesquisa_data($data) {
if ($data!='') 
{
      return (substr($data,6,4).'/'.substr($data,3,2).'/'.substr($data,0,2));
}
else { return ''; }

}   
function moeda_ajuste($valor) 
{
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", ".", $valor);
    return $valor;
}
function VerificaPagamento($id) 
{
	
	require(DOMAIN_PATH."config/conexaoFc.php"); 
    $Sql = "select *from caixa where pedido_id = '".$id."' and status = 1 and valor_total != ''"; 
    $rs = $DB->Execute($Sql);
    $Numlinhas = $rs->RecordCount();
    if($Numlinhas > 0)
    {
        #$Imgem = '<img src="../../webroot/img_sistema/nao_pode_pagar.png" border="0" />';
		$Imgem = '<img src="../../webroot/img_sistema/nao_permite.png" border="0" />';

    }
    else
    {
		#$Imgem = '<input type="image" src="../../webroot/img_sistema/pagar.png" value="'.$id.'" name="pedido_id"/>';
        $Imgem = '<input type="image" src="../../webroot/img_sistema/money_dollar.png" value="'.$id.'" name="pedido_id"/>';
    }
    return $Imgem;
}
function VerificaImpressao($id) 
{
	
	require(DOMAIN_PATH."config/conexaoFc.php"); 
    $Sql = "select *from caixa where pedido_id = '".$id."' and status = 1 and valor_total != ''"; 
    $rs = $DB->Execute($Sql);
    $Numlinhas = $rs->RecordCount();
    if($Numlinhas > 0)
    {
        #$Imgem2 = '<a href="cupom/gera_cupom.php?id='.$id.'"><img src="../../webroot/img_sistema/imprimir.png" border="0" /></a>&nbsp;&nbsp;'; 
        $Imgem2 = '<a href="cupom/gera_cupom.php?id='.$id.'"><img src="../../webroot/img_sistema/printer2.png" border="0" title="Reimprimir venda"/></a>&nbsp;&nbsp;'; 
    }
    else
    {
       #$Imgem2 = '<img src="../../webroot/img_sistema/nao_imprimir.gif" border="0" />';
	   $Imgem2 = '<img src="../../webroot/img_sistema/printer_delete.png" border="0" />';
   }
    return $Imgem2;
}

function VerificaOrcamento($id) 
{
	require(DOMAIN_PATH."config/conexaoFc.php");
    $Sql = "select tipo_pedido_id,id, status from pedido where id = '".$id."' and tipo_pedido_id = 2 and status = 1"; 
    $rs = $DB->Execute($Sql);
    $Numlinhas = $rs->RecordCount();
    if($Numlinhas == 1 )
    {
	   #$Imgem = '<img src="../../webroot/img_sistema/nao_mandar_email.gif" border="0" alt="Editar" title="Editar" width="30" />';
	   $Imgem = '<img src="../../webroot/img_sistema/cart.png" border="0" alt="Editar" title="Venda" />';
     
    }
    else
    {
        #$Imgem = '<a href="orcamento/gera_orcamento.php?id='.$id.'"><img src="../../webroot/img_sistema/email.gif" border="0" alt="Editar" title="Editar" width="30" /></a>';
		$Imgem = '<a href="orcamento/gera_orcamento.php?id='.$id.'"><img src="../../webroot/img_sistema/email_go.png" border="0" alt="Editar" title="Editar Orçamento" /></a>';
  
    }
    return $Imgem;
}

function DadosClientes($id) 
{
	 require(DOMAIN_PATH."config/conexaoFc.php");
     $Sql = "select *from cliente where id = '".$id."'"; 
     $rs = $DB->Execute($Sql);
    if($rs->fields['tipo'] == "F")
    {
      $DadosCliente = '<fieldset style="width:800px;margin:1 auto;padding:5px">
                      <table align="center">
                        <tr align="center" >
                            <td height="50"><strong>Nome:</strong>  '.$rs->fields['nome'].'</td>
                            <td height="50"><strong>Logradouro:</strong> '.$rs->fields['logradouro'].' <strong>Bairro:</strong> '.$rs->fields['bairro'].' <strong>Estado: </strong>'.retornaNome('estado','nome',$rs->fields['estado_id']).' <strong>Cidade:</strong> '.retornaNome('cidade','nome', $rs->fields['cidade_id']).' <strong>CEP: </strong> '.$rs->fields['cep'].'</td>
                        </tr>
                        </table></fieldset>';
    }
    else if($rs->fields['tipo'] == "J")
    {
        $DadosCliente = '<fieldset style="width:990px;margin:1 auto;padding:5px">
                    <table   border="0" align="center">
                            <tr align="center" >
                                <td><strong>Razão Social:</strong>  '.$rs->fields['razao_social'].'</td>
                            </tr>
                            <tr align="center">
                                <td><strong>Nome Fantasia:</strong>  '.$rs->fields['nome_fantasia'].'</td>
                            </tr>
                            <tr align="center">
                                <td><strong>CNPJ:</strong>  '.$rs->fields['cnpj'].' <strong>IE:</strong>  '.$rs->fields['inscricao_estadual'].'</td>
                            </tr>
                            <tr align="center">
                               <td><strong>Logradouro:</strong> '.$rs->fields['logradouro'].' <strong>Bairro:</strong> '.$rs->fields['bairro'].' <strong>Estado: </strong>'.retornaNome('estado','nome',$rs->fields['estado_id']).' <strong>Cidade:</strong> '.retornaNome('cidade','nome', $rs->fields['cidade_id']).' <strong>CEP: </strong> '.$rs->fields['cep'].'</td>
                            </tr>
                        </table></fieldset>';
    }
    
     return $DadosCliente;
}
	function botaoCheckboxPedido($valor)
	{
		 require(DOMAIN_PATH."config/conexaoFc.php");
        if (($_SESSION["permissao_temp"]==3))
		{ 
		   $Sql = "select *from caixa where pedido_id = '".$valor."' and valor_total != '' and status = 1"; 
           $rs = $DB->Execute($Sql);
           $NumLinhas = $rs->RecordCount();            
            if($NumLinhas > 0)
           {
              echo '<input type="checkbox" name="c" value="'.$valor.'" disabled="disabled"/>';
           }
           else
           {
              echo '<input type="checkbox" name="c[]" value="'.$valor.'">';
	       } 
       	}
	}
    function botaoEditarPedido($valor)
	{
		 require(DOMAIN_PATH."config/conexaoFc.php");
        if (($_SESSION["permissao_temp"]==3))
		{ 
		   $Sql = "select *from caixa where pedido_id = '".$valor."' and valor_total != '' and status = 1"; 
           $rs = $DB->Execute($Sql);
           $NumLinhas = $rs->RecordCount();            
            if($NumLinhas == 0)
           {
             	#if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$valor.'"><img src="../../webroot/img_sistema/icon_editar.png" border="0" alt="Editar" title="Editar" width="23" /></a>&nbsp;&nbsp;';
				if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$valor.'"><img src="../../webroot/img_sistema/pencil.png" border="0" alt="Editar" title="Editar" /></a>&nbsp;&nbsp;';
           }
       	}
	}
    function TrazerMaisculo($Palavra)
	{
		$Palavra = ereg_replace("[^a-zA-Z0-9 .]", "",strtr($Palavra, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", 
	  "aaaaeeiooouucAAAAEEIOOOUUC_"));
	  $PalavraMaiscula  = strtoupper($Palavra);
		return $PalavraMaiscula;
	}
    function TrazerDadosPedidos($pedido_id)
    {
        
        require(DOMAIN_PATH."config/conexaoFc.php");
        $Sql = "select itens.id as itens_id,itens.pedido_id,produto.id as produto_id,itens.quantidade, 
         itens.valor_total,produto.descricao_reduzida  
                from   itens inner join produto on produto.id = itens.produto_id  
                where itens.pedido_id = '".$pedido_id."' and itens.status = 1";
        $rs = $DB->Execute($Sql);
        echo '<table width="80%">
                 <tr align="LEFT">
                     <th>Produto</th>
                     <th>Quantidade</th>
                     <th>Valor</th>
                 </tr>';
        while(!$rs->EOF)          
        {
               echo '<tr align="LEFT">
                     <td>'.$rs->fields['descricao_reduzida'].'</td>
                     <td>'.$rs->fields['quantidade'].'</td>
                     <td>R$ '.moeda($rs->fields['valor_total']).'</td>
                     <td><input  type="checkbox" name="itens_id[]" value="'.$rs->fields['itens_id'].'" />
                         <input  type="hidden" name="pedido_id" value="'.$rs->fields['pedido_id'].'"/> 
                     </td>
                 </tr>';
                ;
           $rs->MoveNext(); 
        }
        echo '</table>';
    }
    
     function VerificarCaixa($pedido_id)
    {
        require(DOMAIN_PATH."config/conexaoFc.php");
        $Sql = "select *from caixa where pedido_id = '".$pedido_id."' and status = 1";
        $rs = $DB->Execute($Sql);
        $NumLinhas = $rs->RecordCount();
        if($NumLinhas > 0 )
        {
           #$imagem = '<input  type="image" name="id" value="'.$pedido_id.'" src="../../webroot/img_sistema/remove.png" title="Remover estorno"/>';
           $imagem = '<input  type="image" name="id" value="'.$pedido_id.'" src="../../webroot/img_sistema/money_delete.png" title="Remover estorno"/>';
            
        }
        elseif($NumLinhas == 0)
        {
            
            $imagem = '<img  src="../../webroot/img_sistema/não_remove.png" title="Estornar"/>';
            
            
        }
        
        return $imagem;
        
    } 
function VerificaPagamentoPedido($id) 
{
	require(DOMAIN_PATH."config/conexaoFc.php");
   
    $SqlPedido = "select tipo_pedido_id,id, status from pedido where id = '".$id."' and tipo_pedido_id = 2 and status = 1"; 
    $rs = $DB->Execute($SqlPedido);
    $NumlinhasPedido = $rs->RecordCount();
    if($NumlinhasPedido == 1)
    {
        $Sql = "select *from caixa where pedido_id = '".$id."' and status = 1 and valor_total != ''"; 
        $rs = $DB->Execute($Sql);
        $Numlinhas = $rs->RecordCount();
        if($Numlinhas > 0 )
        {
           $Imgem = '<img src="../../webroot/img_sistema/nao_permite.png" border="0" />';
       
        }
        else
        {
           $Imgem = '<a href="../caixa/baixar.php?pedido_id='.$id.'&TelaSession=pedido"><img src="../../webroot/img_sistema/money_dollar.png" border="0" /> </a>';
   
        }
    }
    else
    {
           $Imgem = '<img src="../../webroot/img_sistema/nao_permite.png" border="0" />';
    }
   return $Imgem;
 }



function Pagamento($id)
{
  require(DOMAIN_PATH."config/conexaoFc.php");   
  $SqlMovimentacao = "select *from movimentacao where id  = '".$id."' and situacao_pagamento_id = 2"; 
  $rs = $DB->Execute($SqlMovimentacao);
  $NumMovimentacao = $rs->RecordCount();  
  if($NumMovimentacao == 1 )
  {
     $Imgem = '<img src="../../webroot/img_sistema/nao_pago.gif" border="0" />';
   
  }
  else
  {
     $Imgem = '<img src="../../webroot/img_sistema/pago.gif" border="0" />';
  
  }
   return $Imgem;
}

function VerificarPgamento($id)
{
  require(DOMAIN_PATH."config/conexaoFc.php");   
   $SqlMovimentacao = "select *from movimentacao where id  = '".$id."' and situacao_pagamento_id = 2"; 
  $rs = $DB->Execute($SqlMovimentacao);
  $NumMovimentacao = $rs->RecordCount();  
  if($NumMovimentacao == 1 )
  {
     $Imgem = '<a href="pagar.php?id='.$id.'"><img src="../../webroot/img_sistema/pagar.png" border="0" alt="Pagar" title="Pagar" width="23" /></a>';
  }
  else
  {
     $Imgem = '<img src="../../webroot/img_sistema/nao_pode_pagar.png" border="0" />';
  }
   return $Imgem;
}

function PoderEditar($id)
{
  require(DOMAIN_PATH."config/conexaoFc.php");   
  $SqlMovimentacao = "select *from movimentacao where id  = '".$id."' and situacao_pagamento_id = 2"; 
  $rs = $DB->Execute($SqlMovimentacao);
  $NumMovimentacao = $rs->RecordCount();  
  if($NumMovimentacao == 1 )
  {
     if($_SESSION["permissao_temp"]>1)
     {
        echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_editar.png" border="0" alt="Editar" title="Editar" width="23" /></a>&nbsp;&nbsp;';
     }

  }
  else
  {
       $Imgem = '<img src="../../webroot/img_sistema/nao_pode_pagar.png" border="0" />';
 }
   return $Imgem;
}


   
?>






