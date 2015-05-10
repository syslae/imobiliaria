<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
    require(DOMAIN_PATH."funcoesFinanceiro.inc.php");
	
	# BY NATAN #
	#include(DOMAIN_PATH."valorExtenso.php");
	# BY NATAN #
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'movimentacao';
	$modulo = "Movimentação";
	$tabela_id=84;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/movimentacao.Model.php");
		include(DOMAIN_PATH."core/controller/movimentacao.Controller.php");
	}
	
	$acaoPagina = 'cadastrar';
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}

    $existe_bancos = $DB->Execute("select count(id) as qtde from bancos where status = 1")->fields["qtde"];

    $existe_situacao_aberto = verifica_situacao_pagamento('ABERTO');

    $qtde_parcelamento = $DB->Execute("select * from qtde_parcelamento where status = 1 order by qtde_vezes");

?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

<link rel="stylesheet" type="text/css" media="screen" href="<?=URL.'/webroot/css/'?>datePicker.css">	
<script src="<?=URL.'/webroot/js/'?>date.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.datePicker.js"></script>

<script src="<?=URL.'/webroot/js/'?>jquery.alerts.js" type="text/javascript"></script>
<link href="<?=URL.'/webroot/css/'?>jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" charset="utf-8">
window.onload = function () {

    <? if($ValorTotalItem > 0){?>

        Soma(<? echo $ValorTotalItem;?>);

    <? } ?>

}

$(function() {

$("select[name='options']").change(function() { updateTotal(); });
updateTotal();

});

function updateTotal() {
    var newTotal = 0;
    var conteudo_div = ''
    var vencimento = $('#dia_vencimento').val();

    $("select[name='options'] option:selected").each(function() {

        //var parcela = parseFloat($(this).data('value'));
        var parcela = parseFloat($('#options').val());
        if(isNaN(parcela)) parcela = 0;

        var valor_produtos = $('#ValorTotalItem').val();
        if(isNaN(valor_produtos)) valor_produtos = 0;

        if((parcela > 0) && (valor_produtos > 0)){
            newTotal = valor_produtos / parcela;
            newTotal = newTotal.toFixed(2);

            for(i=1; i <= parcela; i++){

                if(i > 1) vencimento = incrementa_meses(vencimento, 1);
                conteudo_div += '<div id="filho_parcela'+ i+'">Parcela: &nbsp;<strong>'+i+'</strong> &nbsp; Vencimento: &nbsp;<strong><input type="text" class="input_branco data" name="vencimento[]" maxlength="10" onkeypress="Mascara(this,mascData);" value="'+ vencimento +'"/></strong> &nbsp; Valor: R$ &nbsp;<strong> R$ '+newTotal+'</strong><input type="hidden" name="valor_parcela[]" value="'+ newTotal +'" /><hr><br></div>';
            }

            $('#total').html(conteudo_div);

        }
    });

}
		
function verifica()
{
	var fornecedor=$('#fornecedor').val();
	var nf=$('#nf').val();
	var qtd =$('#qtd').val();
		
	if(fornecedor == "")
	{
		//alert("Preencha todos os campos.");
		jAlert("Preencha todos os campos.", "Automação ");
		return false;
	}
	if(qtd==0)
	{
		//alert("Insira ao menos um item.");
		jAlert("Insira ao menos um item.", "Automação ");
		return false;
	}
	return true;
}

function adicionarFilho(item)
{	
	var qtd =$('#qtd').val();
    $('#filhos').append('<div id="filho'+ item["produto_id"]+'">Produto: &nbsp;<strong>'+ item["nome_produto"] +'</strong><br>Quantidade: &nbsp;<strong>'+item["quantidade"]+'</strong> &nbsp; Valor Unitario: R$ &nbsp;<strong>'+item["valor_unitario"]+'</strong> &nbsp; Valor Total: R$ &nbsp;<strong>'+item["valor_total"]+'</strong><input type="hidden" name="produto_id[]" value="'+ item["produto_id"]+'" /><input type="hidden" name="quantidade[]" value="'+ item["quantidade"] +'" /><input type="hidden" name="valor_unitario[]" value="'+ item["valor_unitario"] +'" /><input type="hidden" name="valor_total[]" value="'+ item["valor_total"] +'" /><a href="javascript:;" onclick="javascript: excluir('+item["produto_id"]+','+item["produto_id"]+','+item["valor_total"]+')"><img src="../../webroot/img_sistema/nao_permite.png" title="Remover Item do Pedido" align="right" border="0"/></a><hr><br></div>');
		
	qtd++;
	$('#qtd').val(qtd);
}
function adicionarFilhoCliente(item)
{	
	var qtd =$('#qtd_filho').val();
	$('#filhos_clientes').append('<div id="filhos_clientes'+item["cliente_id"]+'">Cliente: &nbsp;&nbsp;<strong>'+item["nome_cliente"]+'</strong><input type="hidden" name="cliente_id[]" value="'+item["cliente_id"]+'" id="cliente_id" "/><a href="javascript:;" onclick="javascript: ExcluirCliente('+item["cliente_id"]+')"> <img src="../../webroot/img_sistema/nao_permite.png" title="Remover Cliente do Pedido" align="right" border="0"/></a><hr><br></div>');
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
	//$('#ValorTotal').html("Valor Total do Pedido: R$ "+Valor);
	$('#ValorTotal').html("Valor Total do Pedido: <strong>R$ "+Valor+"</strong>");
	$('#extenso').html(Valor);
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

// $(function() {
//     $("select[name='options']").change(function() { updateTotal(); });
//     updateTotal();
// });

// function updateTotal() {
//     var newTotal = 0;
//     $("select[name='options'] option:selected").each(function() {
//         parcela = parseFloat($(this).data('value'));
//         newTotal = 120 / parcela
//         newTotal = newTotal.toFixed(2)
//     });
//     $("#total").text(parcela +" x R$ " + newTotal);

function abrir_busca(){
    var produto_principal_id = $('#produto_principal_id').val();
    if((produto_principal_id == '') || (produto_principal_id == '0')){
        alert("Informe o produto para que seja listado o estoque!");
        return null;
    }

    tb_show('','<? echo URL?>/modulos/itens_pedido/itens_busca.php?produto_principal_id='+produto_principal_id+'&height=500&width=900&keepThis=true&TB_iframe=true',"../../webroot/img_sistema/carregando.gif");

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
														<p> <strong> &Eacute; necess&aacute;rio preencher corretamente os campos. <br/>
                                                            Verifique se você informou os clientes, os produtos, os vencimentos das parcelas e o banco que irá gerar o boleto.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto">
                                                	<div id="msgUpload" style="text-align:center;"><?=$msgUpload?></div>
                                                </td>
                                                <td width="78%" class="text_padrao">&nbsp;</td>
                                            </tr>
                                            
                                            <?php if($existe_bancos && $existe_situacao_aberto && $qtde_parcelamento->recordCount() > 0) {
                                                include('r-campos.php');
                                            ?>
                                            
                                            
                                            <tr> 
                                                <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="50" align="center" class="text_bold_preto"><button type="submit" class="botao_branco">Salvar</button></td>
                                                <td class="text_padrao"><input name="acao" type="hidden" id="acao" value="<?=$acaoPagina?>"></td>
                                            </tr>

                                            <? } else if(!$existe_bancos) { ?>

                                             <tr align="center">
                                                 <td colspan="2" width="330" >
                                                     <div class="message warning">
                                                         <p> <strong> O acesso a tela somente será liberado após o cadastro de pelo menos um banco com status ativo. <br/>
                                                                      Para cadastrar <a href="<? echo URL?>/modulos/bancos/cadastrar.php" target="_blank">clique aqui</a>.
                                                         </strong></p>
                                                     </div>
                                                 </td>
                                             </tr>

                                             <? } else if(!$existe_situacao_aberto) { ?>

                                             <tr align="center">
                                                 <td colspan="2" width="330" >
                                                     <div class="message warning">
                                                         <p> <strong> O acesso a tela somente será liberado após o cadastro da situação pagamento 'ABERTO' com status ativo. <br/>
                                                             Entre em contato com o administrador do sistema.
                                                         </strong></p>
                                                     </div>
                                                 </td>
                                             </tr>

                                             <? } else if($qtde_parcelamento->recordCount() == 0) { ?>

                                             <tr align="center">
                                                 <td colspan="2" width="330" >
                                                     <div class="message warning">
                                                         <p> <strong> O acesso a tela somente será liberado após o cadastro de pelo menos uma forma de parcelamento com status ativo. <br/>
                                                             Para cadastrar <a href="<? echo URL?>/modulos/qtde_parcelamento/cadastrar.php" target="_blank">clique aqui</a>.
                                                         </strong></p>
                                                     </div>
                                                 </td>
                                             </tr>

                                           <? } ?>
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
