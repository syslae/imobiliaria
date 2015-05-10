<? session_start();

    require("../../config/define.php");
    require(DOMAIN_PATH."config/conexaoAr.php");
    require(DOMAIN_PATH."funcoes.inc.php");
    require(DOMAIN_PATH."classes/class_anti_injection.php");

    //$DB->debug = true;
    verifica ("../../login.php");

    ###        CONFIGURACAO        ###
    $tabela = "darf";
    $linhas_pagina = 25;
    $modulo = "DARF";
    $tabela_id=138;
    ## campos para pesquisa
    $anti = new AntiInjection();
    $nome = $anti->get('nome');
    if(!empty($nome))
    {
        $criterio1 = "and descricao like '%$nome%'";
        $queryString.= "&descricao=".$nome;
    }
    ## fim dos campos para pesquisa

    $criterio = " where 1=1 ".$criterio1." and espaco_fisico_id=".$_SESSION["espaco_fisico_id"]." and status = 1 order by id desc";
    $campos = "id,usuario_id,espaco_fisico_id,descricao,mes, ano,valor, created,status";
    $parametros= $queryString;
    ###        CONFIGURACAO        ###
    include(DOMAIN_PATH."includes/pagina-calculo.php");

?>

<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>ajax.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<script>

function atualizaStatus(posicao,novonivel,id,tabela)
{
    if(document.getElementById)
    {
        var divid = document.getElementById("div-"+posicao);
        var ajax = openAjax();
        ajax.open("GET", "../../status.inc.php?id="+id+"&novonivel="+novonivel+"&tabela="+tabela, true);
        ajax.onreadystatechange = function()
        {
            if(ajax.readyState == 1)
            {
                divid.innerHTML = "<img name='img' src='../../webroot/img_sistema/indicator.gif' border='0'>";
            }
            if(ajax.readyState == 4)
            {
                if(ajax.status == 200)
                {
                    if (novonivel==1)
                    {
                        divid.innerHTML = "<img id='img-"+posicao+"' name='img-"+posicao+"' src='../../webroot/img_sistema/bola-verde.gif' onclick='javascript:atualizaStatus("+posicao+",0,\""+id+"\");'  border='0'>";
                    }
                    else
                    {
                        divid.innerHTML = "<img id='img-"+posicao+"' name='img-"+posicao+"' src='../../webroot/img_sistema/bola-vermelha.gif' onclick='javascript:atualizaStatus("+posicao+",1,\""+id+"\");'  border='0'>";
                    }
                }
                else
                {
                    divid.innerHTML = "Erro: ";
                    alert("erro");
                }
            }
        }
        ajax.send(null);
    }
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
                                     <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="get">
                                         <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td>
                                                    <!-- personalize com os campos que deseja-->
                                                    <span class="text_bold_preto" style="margin-left:80px">Descrição</span>
                                                    <input name="nome" type="text" class="input_branco" id="nome" value="<?=$nome?>" size="30" maxlength="30">

                                                    <input type="submit" name="Procurar" id="Procurar" value="Procurar" class="botao_branco">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                     <?
                                    if ($tr>0)
                                    { ?>

                                    <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:10px;">
                                        <tr>
                                            <td><? include(DOMAIN_PATH."includes/tabela-paginacao.php")?></td>
                                        </tr>
                                    </table>

                                    <?

                                    }
                                    if(!empty($_SESSION["msg_index"] ))
                                    {?>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div class="message success">
                                                    <p><?=$_SESSION["msg_index"] ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <?
                                    }
                                    if ($tr>0)
                                    {

                                    ?>

                                    <form action="remover.php"  name="form" method="post" style="margin-top:40px;margin-bottom:40px;margin-right:10px" >
                                        <?php include("r-index.php");?>
                                    </form>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:10px;">
                                        <tr>
                                            <td><? include(DOMAIN_PATH."includes/tabela-paginacao.php")?></td>
                                        </tr>
                                    </table>

                                    <?
                                    }
                                    else
                                    {
                                    ?>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;margin-bottom:20px;">
                                        <tr>
                                            <td>
                                                <div class="message tip">
                                                    <p>Não existem resultados.</p>
                                                </div>
                                             </td>
                                        </tr>
                                    </table>
                                    <?
                                    }
                                    ?>



                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
    if(isset($_SESSION["msg_index"]))
        unset($_SESSION["msg_index"]);
    ?>
</body>
</html>
