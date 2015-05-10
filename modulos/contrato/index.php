<? session_start();

	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
    require("../../includes/funcoes.php");

	//$DB->debug = true;
	verifica ("../../login.php");

	###        CONFIGURACAO        ###
	$tabela = "contrato";
	$linhas_pagina = 25;
	$modulo = "Contrato";
	$tabela_id=102;
	## campos para pesquisa
	$anti = new AntiInjection();
	$nome = $anti->get('nome');
    $tipo_contrato = $anti->get('tipo_contrato');
	if(!empty($nome))
	{
		$criterio1 = "and descricao like '%$nome%'";

	}

    if(!empty($tipo_contrato))
    {
        if($tipo_contrato == 2)
        {
             $criterio1 .= "and vigencia = 1";
        }else
        {
            $criterio1 .= "and contrato.status = ".$tipo_contrato."";
        }

    }
	## fim dos campos para pesquisa

	$criterio = "inner join cliente on cliente.id = contrato.cliente_id where 1=1 ".$criterio1." and contrato.espaco_fisico_id=".$_SESSION["espaco_fisico_id"]."  order by cliente.nome_fantasia asc ";
	$campos = "contrato.id,cliente_id,servico_id, numero_contrato,data_inicio,data_final,valor_mensal,volor_total,contrato.created,contrato.status";
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
                                    <td align="center" valign="top"><? include(DOMAIN_PATH."includes/barra.php");?></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                     <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="get">
                                       <table width="800" border="0" cellspacing="0" cellpadding="0" class="filtro">
                                                        <tr>
                                                            <!-- personalize com os campos que deseja-->
                                                            <td class="tit" width="200" align="center" colspan="2">Nome:
                                                                 <input type="text" name="campo" maxlength="50" size="50"/>
                                                           </td>
                                                           <td class="tit" width="200" align="center" colspan="2" >Tipo:
                                                                <input  type="radio" value="1" name="tipo_contrato"/>Ativo
                                                                <input  type="radio" value="0" name="tipo_contrato"/>Cancelado
                                                                <input  type="radio" value="2" name="tipo_contrato"/>Vencido
                                                           </td>
                                                        <td  valign="bottom" align="center">
                                                            <input type="submit" name="Procurar" id="Procurar" value="Procurar" />
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
