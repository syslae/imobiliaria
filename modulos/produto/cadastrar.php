<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
    require(DOMAIN_PATH."includes/funcoes.php");
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'produto';
	$modulo = "Produto";
	$tabela_id=95;

    $estoque_id = $codigo = $estoque = $valor_estoque = $status_estoque = array();

	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/produto.Model.php");
		include(DOMAIN_PATH."core/controller/produto.Controller.php");
	}
	
	$acaoPagina = 'cadastrar';
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}

    if(empty($estoque_id)) $qtd_filhos_estoques = 1;
    else $qtd_filhos_estoques = count($estoque_id)+1;

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
function adicionarFilhoEstoque()
{
    var qtd =$('#qtd_filhos_estoque').val();
    $('#filhos_estoque').append('<div id="filhos_estoque'+ qtd+'"><input type="hidden" class="input_branco" name="estoque_id[]" value=""/>Código: &nbsp;<strong><input type="text" class="input_branco" name="codigo[]" maxlength="30" size="10" value=""/></strong> &nbsp;Estoque: &nbsp;<strong><input type="text" class="input_branco" name="estoque[]" maxlength="80" size="32" value=""/></strong> &nbsp; Valor: R$ &nbsp;<input type="text" class="input_branco" name="valor_estoque[]" maxlength="11" onkeypress="Mascara(this,mascValor);" value=""/> &nbsp; Disponível: &nbsp; <select name="status_estoque[]"><option value="1">SIM</option><option value="0">NÃO</option></select><a href="javascript:;" onclick="javascript: ExcluirCliente('+qtd+')"> <img src="../../webroot/img_sistema/nao_permite.png" title="Remover Item" align="right" border="0"/></a><hr><br></div>');

    qtd++;
    $('#qtd_filhos_estoque').val(qtd);
}


function ExcluirCliente(id)
{
    var qtd =$('#qtd').val();
    var produto_id;
    qtd--;
    $('#qtd').val(qtd);
    $("#filhos_estoque"+id).remove();
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
														<p> <strong> Desculpe, &eacute; necess&aacute;rio preencher corretamente os campos em destaque.
                                                            Verifique se você informou a descrição, os estoque e os valores de cada estoque.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto"><div id="msgUpload" style="text-align:center"><?=$msgUpload?></div></td>
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
