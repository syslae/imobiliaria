<? session_start();
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");

	//$DB->debug = true;
	verifica ("../../login.php");

	$tabela= "iss";
	$modulo = "ISS";
	$tabela_id=136;
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
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


                                    <table width="750" border="0" align="center" cellpadding="2" cellspacing="0" class="margin7">
                                        <tr>
                                            <td width="746" align="center" class="text_bold_azul">
                                                <?
                                                if (isset ($_POST['remover']))
                                                {
                                                    if (! isset ($_POST['c']))
                                                    {
                                                        ?>
                                                            <center>
                                                                <span class="text_vermelho"> Voc&ecirc; deve selecionar algum registro!</span><br>
                                                                <br><a href="javascript:history.go(-1)">Voltar</a><br><br>
                                                            </center>
                                                        <?
                                                    }
                                                    else
                                                    {
                                                        //////////////
                                                        ?>
                                                        <center class="text_vermelho">
                                                            Voc&ecirc; realmente deseja excluir?
                                                        </center>
                                                        <br><br>
                                                        <form name="remover" method="post" action="">
                                                            <table align="center" width="500" border="0" cellspacing="0" cellpadding="0">
                                                                <?
                                                                $c = $_POST['c'];
                                                                foreach ($c as $value)
                                                                {
                                                                $sql = "select id, descricao from $tabela where id = $value";
                                                                $result = $DB->Execute($sql);
                                                                ?>
                                                                <tr>
                                                                    <td class="text_bold_preto">
                                                                        <strong><?=$result->fields['nome']?></strong>
                                                                        <input type="hidden" name="c[]" value="<?=$result->fields["id"]?>" checked>
                                                                    </td>
                                                                </tr>
                                                                <?
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td align="center" style="padding-top:20px;">
                                                                        <table width="150" border="0" cellpadding="4">
                                                                          <tr>
                                                                            <td width="50%">
                                                                            <? if (($_SESSION["permissao_temp"]==3))
																			{ ?>
																				<input type="hidden" name="deletar" value="deletar">
																				<input name="Submit" type="submit" class="input_branco" value="Sim">
																				<?
																			}?>
                                                                            </td>
                                                                            <td>
                                                                            <? if (($_SESSION["permissao_temp"]>=1))
																			{ ?>
																				<input name="Submit" type="button" class="input_branco" value="Não" onClick="document.location='index.php'">
																				<?
																			}?>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                        <?
                                                        /////////////
                                                    }
                                                }
                                                if (isset ($_POST['deletar']))
                                                {
                                                    $c = $_POST['c'];
                                                    foreach ($c as $value)
                                                    {
                                                        $sql = "select id from $tabela where id = $value";
                                                        $result = $DB->Execute($sql);

                                                        /*
														if (!empty($result->fields['foto']))
                                                        {
                                                            $imagem = URL.'/webroot/img/'.$tabela.'/'.$rs->fields['foto'];
                                                            if (unlink($imagem))
                                                            echo "<center>imagem (".$tabela.'/'.$rs->fields['foto'].") apagada do servidor</center>";
                                                            else
                                                            echo "<center>Erro ao remover a imagem (".$tabela.'/'.$rs->fields['foto'].") do servidor</center>";
                                                        }
                                                        */

                                                        $sql = "delete from $tabela where id = $value";
                                                        if ($DB->Execute($sql) === false) print 'Erro no delete';
                                                        else echo '<center>Registro # '.$result->fields['id'].' # apagado do Banco de Dados</center><br><br>';
                                                    }
                                                    echo $GLOBALS["botaoIndex"];
                                                }?>
                                            </td>
                                        </tr>
                                    </table>


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

