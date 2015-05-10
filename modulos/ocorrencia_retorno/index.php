<?
session_start();

require("../../config/define.php");
require(DOMAIN_PATH . "config/conexaoAr.php");
require(DOMAIN_PATH . "funcoes.inc.php");
require(DOMAIN_PATH . "classes/class_anti_injection.php");

//$DB->debug = true;
verifica("../../login.php");

###        CONFIGURACAO        ###
$tabela = "ocorrencia_retorno oc left join bancos b
                on b.id=oc.banco_id";
$linhas_pagina = 25;
$naoDirecionarModulo = 1;
$modulo = "Retorno bancário";
$tabela_id = 148;
## campos para pesquisa
$anti = new AntiInjection();
$acaoPagina = 'pesquisar';

$criterio1 = "0";

$situacao = '';

if ($_POST['acao'] == 'pesquisar') {
    $Filtro = $anti->post('Filtro');
    $Layout = $anti->post('Layout');
    $Ano = $anti->post('ano');
    //$DB->debug=1;
    $dados1 = $DB->Execute("select sigla as Sigla,tamanho_linha as TamanhoLinha from bancos where id = '" . trim($Layout) . "'");

    $sigla = trim($dados1->fields['Sigla']);
    $tamanho = trim($dados1->fields['TamanhoLinha']);

    switch ($sigla) {
        case 'BB':
            $DescLayout = "BANCO DO BRASIL - " . $tamanho;
            break;
        case 'CS':
        case 'CR':
            $DescLayout = "CAIXA ECONÔMICA SICOB - " . $tamanho;
            break;
        case 'SR':
            $DescLayout = "CAIXA ECONÔMICA SIGCB - " . $tamanho;
            break;
        case 'RS':
        case 'RC':
            $DescLayout = "BANCO REAL - " . $tamanho;
            break;
        case 'BN':
            $DescLayout = "BANCO DO NORDESTE - " . $tamanho;
            break;
        case 'BS':
            $DescLayout = "BANCO SANTANDER - " . $tamanho;
            break;
        case 'BR':
            $DescLayout = "BANCO BRADESCO SEM REGISTRO - " . $tamanho;
            break;
        case 'IT':
            $DescLayout = "BANCO ITAU - " . $tamanho;
            break;
        case 'HS':
            $DescLayout = "BANCO HSBC - " . $tamanho;
            break;
        case 'BI':
            $DescLayout = "BIC - BANCO - " . $tamanho;
            break;
    }

    if (!empty($DescLayout)) {


        if ($DescLayout == 'CAIXA ECONÔMICA SICOB - 240')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('CS','CR', 'C') and banco_id = '$Layout')";
        else if ($DescLayout == 'CAIXA ECONÔMICA SIGCB - 240')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('SR') and banco_id = '$Layout')";
        else if ($DescLayout == 'BANCO REAL - 240/400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('RS','RC') and banco_id = '$Layout') ";
        else if ($DescLayout == 'UNIBANCO - 400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('US') and banco_id = '$Layout') ";
        else if ($DescLayout == 'BANCO BRADESCO')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('RU') and banco_id = '$Layout') ";
        else if (($DescLayout == 'BANCO DO NORDESTE - 240') or ( $DescLayout == 'BANCO DO NORDESTE - 400'))
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('BN') and banco_id = '$Layout')";
        else if (($DescLayout == 'BANCO DO BRASIL - 240')or ( $DescLayout == 'BANCO DO BRASIL - 400'))
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('BB') and banco_id = '$Layout')";
        else if ($DescLayout == 'BANCO BRADESCO SEM REGISTRO - 400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('BR') and banco_id = '$Layout')";
        else if ($DescLayout == 'BANCO ITAU - 400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla in ('IT') and banco_id = '$Layout')";
        else if ($DescLayout == 'BANCO SANTANDER - 240')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla='BS'  and banco_id = '$Layout')";
        else if ($DescLayout == 'BANCO HSBC - 400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla='HS'  and banco_id = '$Layout')";
        else if ($DescLayout == 'BIC - BANCO - 400')
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla='BI'  and banco_id = '$Layout')";
        else
            $banco = " and oc.banco_id in (SELECT id from bancos where sigla='-1')"; //valor para não trazer resultados


        $criterio1 = "1 " . $banco . "";

        if (!empty($Filtro)) {
            if ($Filtro == 1)
                $situacao = " and oc.situacao in ('IGN','MAN','MEN') ";
            else if ($Filtro == 2)
                $situacao = " and oc.situacao in ('MAI') ";
            else if ($Filtro == 3)
                $situacao = " and oc.situacao in ('MEI') ";
            else if ($Filtro == 4)
                $situacao = " and oc.situacao in ('NE') ";
            else if ($Filtro == 5)
                $situacao = " and oc.situacao in ('IGNC','MANC','MENC','MAIC','MEIC') ";
            else if ($Filtro == 6)
                $situacao = " and oc.situacao in ('IGNP','MANP','MENP','MAIP','MEIP') ";
            else if ($Filtro == 7)
                $situacao = " and oc.situacao in ('IGNN','MANN','MENN','MAIN','MEIN') ";
        }
        if (!empty($Ano)) {
            $ano = " and year(oc.data_ret) = '" . $Ano . "' ";
        }
    }
}

//$DataPgto = '14/06/2012';
## fim dos campos para pesquisa
$criterio = "where 1=" . $criterio1 . "" . $situacao . "" . $ano . " group by oc.num_retorno, DATE_FORMAT(oc.data_ret, '%d/%m/%Y'),
                   DATE_FORMAT(oc.data_mov, '%d/%m/%Y'), b.tamanho_linha, b.Banco";
$criterio3 = " ORDER BY num_retorno desc";

//echo $banco." ".$criterio." "; exit();

$criterio3 = "";
$campos = " b.banco,
                      oc.num_retorno as NumRetorno,
                                    DATE_FORMAT(oc.data_ret, '%d/%m/%Y') AS DataRet,
                   DATE_FORMAT(oc.data_mov, '%d/%m/%Y') AS DataMov,
                    (case when b.tamanho_linha=240 then COUNT(oc.num_retorno)/2 else count(oc.num_retorno) end) as qtd_boletos";


$parametros = $queryString;
###        CONFIGURACAO        ###
include(DOMAIN_PATH . "includes/pagina-calculo.php");

//Situação de mensalidades
$sql_situacao_parcelas = "select id as idSituacao, descricao as Descricao from situacao_pagamento where descricao <> '' ";
$rs_situacao_parcelas = $DB->Execute($sql_situacao_parcelas);

?>

<html>
    <head>
        <title><?= $config["tituloPagina"] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= URL . '/webroot/css/' ?>estilo.css" rel="stylesheet" type="text/css">
        <script src="<?= URL . '/webroot/js/' ?>funcoes.js"></script>
        <script src="<?= URL . '/webroot/js/' ?>ajax.js"></script>
        <script src="<?= URL . '/webroot/js/' ?>jquery.js"></script>

        <script>

            function atualizaStatus(posicao, novonivel, id, tabela)
            {
                if (document.getElementById)
                {
                    var divid = document.getElementById("div-" + posicao);
                    var ajax = openAjax();
                    ajax.open("GET", "../../status.inc.php?id=" + id + "&novonivel=" + novonivel + "&tabela=" + tabela, true);
                    ajax.onreadystatechange = function ()
                    {
                        if (ajax.readyState == 1)
                        {
                            divid.innerHTML = "<img name='img' src='../../webroot/img_sistema/indicator.gif' border='0'>";
                        }
                        if (ajax.readyState == 4)
                        {
                            if (ajax.status == 200)
                            {
                                if (novonivel == 1)
                                {
                                    divid.innerHTML = "<img id='img-" + posicao + "' name='img-" + posicao + "' src='../../webroot/img_sistema/bola-verde.gif' onclick='javascript:atualizaStatus(" + posicao + ",0,\"" + id + "\");'  border='0'>";
                                }
                                else
                                {
                                    divid.innerHTML = "<img id='img-" + posicao + "' name='img-" + posicao + "' src='../../webroot/img_sistema/bola-vermelha.gif' onclick='javascript:atualizaStatus(" + posicao + ",1,\"" + id + "\");'  border='0'>";
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

            function check_all(div) {

                $(".dataTables_scrollBody").scrollTop(0);

                var checkbox = document.getElementsByName(div + '[]');

                for (var i = 0; i < checkbox.length; i++) {
                    checkbox[i].checked = document.getElementById('check_' + div).checked;
                }
            }

            function tratar_form(obj) {

                if (obj.checked) {
                    $('#fieldset-situacao').slideDown("slow");
                    document.form.action = "<? echo URL;?>/modulos/rel_ocorrencia_retorno/controller.php";
                    document.form.target = "_blank";
                    $('#div-result-consulta').html('');

                }
                else
                {
                    $('#fieldset-situacao').slideUp("slow");
                    document.form.action = "";
                    document.form.target = "";

                }

            }
            
            function imprimir_retorno(){
            
                var aChk = document.getElementsByName("c[]");
                itemlist = false;
                for (var i = 0; i < aChk.length; i++) {
                    if (aChk[i].checked === true) {
                        itemlist = true;
                        
                    }
                }

                if (itemlist === false) {
                    alert('Selecione pelo menos um retorno!');
                    return false;
                }
            
                document.espelho.target = "_blank";
                $('#form_espelho').submit();
            }

        </script>

    </head>
    <body>
        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
            <tr><td height="80" valign="top" bgcolor="#FFFFFF"><? include (DOMAIN_PATH . 'topo.php') ?></td></tr>
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
                                        <td align="center" valign="top"><? include(DOMAIN_PATH . "includes/barra.php") ?></td>
                                    </tr>
                                    <tr> 
                                        <td align="center" valign="top">                                        

                                            <form action="" name="form" method="post" enctype="multipart/form-data"
                                                  class="stdformHor">

                                                <? if (!empty($erro_consulta)) { ?>

                                                    <div class="message error">
                                                        <p><strong> Desculpe, é necessário preencher corretamente os campos em
                                                                destaque.</strong></p>
                                                    </div>

                                                    <table width="830" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <div class="message error">
                                                                    <p><strong> Desculpe, é necessário preencher corretamente os campos em
                                                                            destaque.</strong></p>
                                                                </div>  
                                                            </td>
                                                        </tr>
                                                    </table>

                                                <? } ?>

                                                <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:10px;">
                                                    <tr>
                                                        <td><?php include('r-consulta.php') ?></td>
                                                    </tr>
                                                </table>

                                                <button type="submit" class="btn-salvar">Pesquisar</button>
                                                <input name="acao" type="hidden" id="acao" value="<?= $acaoPagina ?>"/>

                                                <br style="clear: left;" />

                                            </form>


                                            <?
                                            if (!empty($_SESSION["msg_index"])) {
                                                ?>


                                                <table width="830" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <div class="message success">
                                                                <p><?= $_SESSION["msg_index"] ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <?
                                            }
                                            if ($_POST['acao'] == 'pesquisar') {
                                                ?>
                                                <div id="div-result-consulta">




                                                    <?
                                                    if ($tr > 0) {
                                                        ?>

                                                        <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:10px;">
                                                            <tr>
                                                                <td><? include(DOMAIN_PATH . "includes/tabela-paginacao.php") ?></td>
                                                            </tr>
                                                        </table>



                                                    <form action="<? echo URL;?>/modulos/rel_ocorrencia_retorno/controller.php" name="espelho" id="form_espelho" method="post" class="stdform">

                                                            <?php include("r-index.php"); ?>

                                                            <input type="hidden" name="idBanco" value="<?= $Layout ?>"/>
                                                            <input type="hidden" name="Layout" value="<?= $DescLayout ?>" />
                                                            <input type="hidden" name="Filtro" value="<?= $Filtro ?>" />
                                                            <input type="hidden" name="ano" value="<?= $Ano ?>" />

                                                            <button type="button" onclick="imprimir_retorno();" class="btn-salvar">Imprimir</button>
                                                        </form>

                                                        <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:10px;">
                                                            <tr>
                                                                <td><? include(DOMAIN_PATH . "includes/tabela-paginacao.php") ?></td>
                                                            </tr>
                                                        </table>

                                                        <?
                                                    } else {
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

                                                    <? }
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
        if (isset($_SESSION["msg_index"]))
            unset($_SESSION["msg_index"]);
        ?>
    </body>
</html>
