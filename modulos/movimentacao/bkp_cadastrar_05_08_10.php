<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'pedido';
	$modulo = "Pedido";
	$tabela_id=84;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/pedido.Model.php");
		include(DOMAIN_PATH."core/controller/pedido.Controller.php");
	}
	
	$acaoPagina = 'cadastrar';
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?=URL.'/webroot/css/'?>datePicker.css">	
<script src="<?=URL.'/webroot/js/'?>date.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.datePicker.js"></script>
<script type="text/javascript" charset="utf-8">
		$(function()
		{
		
	
              $('#data_pedido').datePicker(); 
	       });
          
		
function verifica()
{
	var fornecedor=$('#fornecedor').val();
	var nf=$('#nf').val();
	var qtd =$('#qtd').val();
		
	if(fornecedor == "")
	{
		alert("Preencha todos os campos.");
		return false;
	}
	if(qtd==0)
	{
		alert("Insira ao menos um item.");
		return false;
	}
	return true;
}

function adicionarFilho(item)
{	
	var qtd =$('#qtd').val();
    $('#filhos').append('<div id="filho'+ item["produto_id"]+'">Produto:'+ item["nome_produto"] +'<br>Quantidade:'+item["quantidade"]+'  Valor unitario: R$ '+item["valor_unitario"]+' Valor total: R$ '+item["valor_total"]+'<input type="hidden" name="produto_id[]" value="'+ item["produto_id"]+'" /><input type="hidden"  name="quantidade[]" value="'+ item["quantidade"] +'" /><input type="hidden"  name="valor_unitario[]" value="'+ item["valor_unitario"] +'" /><input type="hidden" name="valor_total[]" value="'+ item["valor_total"] +'" id="valor" "/><a href="javascript:;" onclick="javascript: excluir('+item["produto_id"]+','+item["produto_id"]+','+item["valor_total"]+')">  <img src="../../webroot/img_sistema/del.png"/></a><hr></div>');
	qtd++;
	$('#qtd').val(qtd);
}
function adicionarFilhoCliente(item)
{	
	var qtd =$('#qtd_filho').val();
	$('#filhos_clientes').append('<div id="filhos_clientes'+item["cliente_id"]+'">Cliente:'+item["nome_cliente"]+'<input type="hidden" name="cliente_id" value="'+item["cliente_id"]+'" id="cliente_id" "/><a href="javascript:;" onclick="javascript: ExcluirCliente('+item["cliente_id"]+')">  <img src="../../webroot/img_sistema/del.png"/></a><hr></div>');
	qtd++;
	$('#qtd_filho').val(qtd);
}

function Soma(Valor)
{
    var valor_existente;
	valor_existente = parseFloat($('#ValorTotalItem').val());
    Valor = parseFloat(Valor);
	Valor = Valor + valor_existente;
	Valor = Valor.toFixed(2);
	$('#ValorTotal').html("");
	$('#ValorTotal').html("Valor total do pedido: "+Valor);
	$('#ValorTotalItem').val(Valor);
}	
function excluir(id,produto_id,Valor)
{	
	var qtd =$('#qtd').val();
	var produto_id;
	var valor_existente;
	valor_existente = parseFloat($('#ValorTotalItem').val());
	Valor = parseFloat(Valor);
	Valor = valor_existente - Valor;
	Valor = Valor.toFixed(2);
	$('#ValorTotal').html("");
	$('#ValorTotal').html(Valor);
	$('#ValorTotalItem').val(Valor);
	qtd--;
	$('#qtd').val(qtd);
	$("#filho"+id).remove();
	remove_produto(produto_id);
}
 
 function ExcluirCliente(cliente_id)
{	
	var qtd =$('#qtd').val();
	var produto_id;
	qtd--;
	$('#qtd').val(qtd);
	$("#filhos_clientes"+cliente_id).remove();
	remove_cliente(cliente_id);
}
function remover()
{
	tb_remove();
	setTimeout("$('#abre_itens').click()",1000);
}
function sair(id,tabela,descricao)
{
	tb_remove();
	//carregaSelect(id,tabela,descricao);
	
}
function carregaProduto()
{
	tb_remove();
	setTimeout("$('#abre_produto').click()",1000);
}

function carregaUnidadeMedida()
{
	tb_remove();
	setTimeout("$('#abre_unidade_medida').click()",1000);
}


function add_produto(id)
{
	$('#produtos_i').append('<input type="hidden" value="1" id="'+id+'p" />');
}
function add_cliente(id)
{
	$('#clientes_i').append('<input type="hidden" value="1" id="'+id+'c" />');
}
function remove_produto(id)
{
	$('#'+id+'p').remove();
}

function remove_cliente(id)
{
	$('#'+id+'p').remove();
}
function verifica_produto(id)//verifica se o produto ja foi inserido
{
	var id=$('#'+id+'p').val();
	if(id==1)//se ja estiver inserido
	{
		return false;
	}
	else
		return true;
}
function verifica_cliente(id)//verifica se o produto ja foi inserido
{
	var id=$('#'+id+'c').val();
	if(id==1)//se ja estiver inserido
	{
		return false;
	}
	else
		return true;
}


</script>
</head>

<body>
    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td height="80" valign="top" bgcolor="#FFFFFF"><? include (DOMAIN_PATH.'topo.php') ?></td></tr>
        <tr>
            <td valign="top">
            	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                        <td width="20" valign="top"></td>
                        <td valign="top">
                            <table width="100%" border="0" cellspacing="6" cellpadding="0">
                                <tr>
                                    <td height="25">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top"><? include(DOMAIN_PATH."includes/barra.php")?></td>
                                </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                    
                                    
                                    <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="post" enctype="multipart/form-data">				
                                         <table width="830" border="0" cellspacing="2" cellpadding="0" class="borda" style="margin:5px" >
                                            <tr><td colspan="2" class="text_bold_azul">&nbsp;</td></tr>
                                            <? if (!empty($erro)) {?>
                                            <tr align="center"> 
                                                <td colspan="2" width="330" >
													<div class="message error">
														<p> <strong> Desculpe, &eacute; necess&aacute;rio preencher corretamente os campos em destaque.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto">
                                                	<div id="msgUpload" style="text-align:center"><?=$msgUpload?></div>
                                                </td>
                                                <td width="78%" class="text_padrao">&nbsp;</td>
                                            </tr>
                                            
                                            <?php include('r-campos.php')?>
                                            
                                            
                                            <tr> 
                                                <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="50" align="right" class="text_bold_preto"><button type="submit" class="botao_branco">Salvar</button></td>
                                                <td class="text_padrao"><input name="acao" type="hidden" id="acao" value="<?=$acaoPagina?>"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    
                                    
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
				</table>
            </td>
        </tr>
    </table>
</body>
</html>
