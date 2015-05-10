<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'motivo_cancelamento';
	$modulo = "Cancelamento";
	$tabela_id=147;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/motivo_cancelamento.Model.php");
		include(DOMAIN_PATH."core/controller/motivo_cancelamento.Controller.php");
	}
	
	$acaoPagina = 'cadastrar';
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}

    $existe_situacao_cancelado = verifica_situacao_pagamento('CANCELADO');
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<script>
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

function adicionarFilhoCliente(item)
{
    var qtd =$('#qtd_filho').val();
    $('#filhos_clientes').html('').append('<div id="filhos_clientes'+item["cliente_id"]+'">Cliente: &nbsp;&nbsp;<strong>'+item["nome_cliente"]+'</strong><input type="hidden" name="cliente_id[]" value="'+item["cliente_id"]+'" id="cliente_id" "/><a href="javascript:;" onclick="javascript: ExcluirCliente('+item["cliente_id"]+')"> <img src="../../webroot/img_sistema/nao_permite.png" title="Remover Cliente do Pedido" align="right" border="0"/></a><hr><br></div>');
    qtd++;
    $('#qtd_filho').val(qtd);
    carrega_parcelas_aberto(item["cliente_id"]);
}

function add_cliente(id)
{
    $('#clientes_i').append('<input type="hidden" value="1" id="'+id+'c" />');
}

function ExcluirCliente(cliente_id)
{
    var qtd =$('#qtd').val();
    var produto_id;
    qtd--;
    $('#qtd').val(qtd);
    $("#filhos_clientes"+cliente_id).remove();
    $("#div-parcelas-aberto").html('');
    remove_cliente(cliente_id);
}

function remove_cliente(id)
{
    $('#'+id+'p').remove();
}

function sair(id,tabela,descricao)
{
    tb_remove();
    //carregaSelect(id,tabela,descricao);

}


function carrega_parcelas_aberto(cliente_id){

    $.ajax({
        method: "get",url: "../../includes/carrega_parcelas_aberto.php?cliente_id="+cliente_id,
        dataType: "html",
        beforeSend:  function(){
            $("#div-parcelas-aberto").show("fast");
            $("#div-parcelas-aberto").html("<img name='img' src='../../webroot/img_sistema/indicator.gif' border='0'>");
            //$("#"+id).html("<img src='../../webroot/img_sistema/carregando.gif'/>");
        },
        success: function(html){
            $("#div-parcelas-aberto").html(html).show();
        }
    }); //close $.ajax(

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
														<p> <strong> Desculpe, &eacute; necess&aacute;rio preencher corretamente os campos em destaque. <br/>
                                                            Verifique se você informou o cliente, as parcelas e o motivo do cancelamento do boleto.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto"><div id="msgUpload" style="text-align:center"><?=$msgUpload?></div></td>
                                                <td width="78%" class="text_padrao">&nbsp;</td>
                                            </tr>

                                             <?php if($existe_situacao_cancelado) {
                                             include('r-campos.php');
                                             ?>


                                             <tr>
                                                 <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                             </tr>
                                             <tr>
                                                 <td height="50" align="center" class="text_bold_preto"><button type="submit" class="botao_branco">Salvar</button></td>
                                                 <td class="text_padrao"><input name="acao" type="hidden" id="acao" value="<?=$acaoPagina?>"></td>
                                             </tr>

                                             <? } else { ?>

                                             <tr align="center">
                                                 <td colspan="2" width="330" >
                                                     <div class="message warning">
                                                         <p> <strong> O acesso a tela somente será liberado após o cadastro da situação pagamento 'CANCELADO' com status ativo.
                                                             Entre em contato com o administrador do sistema.
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

<? if($cliente_id){?>
    <script>
        carrega_parcelas_aberto(<? echo $cliente_id;?>);
    </script>

<?  } ?>

</html>
