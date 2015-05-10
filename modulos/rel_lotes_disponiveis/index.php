<? session_start();

	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
	//$DB->debug = true;

	###        CONFIGURACAO        ###
	$modulo = "Relátorio de Lotes Disponíveis";
	$tabela_id=96;
	## fim dos campos para pesquisa
	 verificaAcesso($tabela_id);
?>

<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<link type="text/css" href="<?=URL.'/webroot/css/'?>ui.all.css" rel="stylesheet" />
<link href="<?=URL.'/webroot/css/'?>jquery.autocomplete.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=URL.'/webroot/css/'?>datePicker.css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>ajax.js"></script>
<script src="<?=URL.'/webroot/js/'?>date.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.autocomplete.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.datePicker.js"></script>


<script>

		$(function()
		{

			  $('#data_inicio').datePicker({startDate:'01/01/1900'});
			  $('#data_fim').datePicker({startDate:'01/01/1900'});

		   });


	function carregaInputCliente(valor)
	{
		var valor;

		if(valor==1)
		{
	        $("#cliente").show();
    	}
		if(valor == 2)
		{
	        $("#cliente").hide();
            $("#cliente_id").val('');
 		}
	}

	function carregaInputMesReferencia(valor)
	{
		var valor;

		if(valor==1)
		{
	        $("#mes_referencia").show();
    	}
		if(valor == 2)
		{
	        $("#mes_referencia").hide();
            $("#mes_id").val('');
            $("#ano_id").val('');

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
                                    <td align="center" valign="top">

                                           <form name="formrel" action="relatorios/gera_relatorio.php" method="post" enctype="multipart/form-data" target="janela1" >


                                         <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td width="37">
                                                  <img src="<?=URL.'/webroot/img_sistema/'?>quadro.jpg" id="esquerda"/>        </td>
                                                <td width="719">

                                                  <h1><a href=""  style="font-size:16px"><?=$modulo?></a></h1>

                                                </td>

                                                 <td width="74" align="left">
                                                </td>
                                           </tr>
                                        </table>
                                    </td>
                                </tr>
                                             <!-- <tr>
                                                 <td colspan="3" align="center"><strong>Selecionar cliente:</strong><input  type="radio" name="filtro_cliente" value="1" onclick="carregaInputCliente(1)"/>Sim  <input  type="radio" name="filtro_cliente" value="2" onclick="carregaInputCliente(2)"/>Não</td>
                                             </tr> -->
                                <tr>
                                    <td align="center" valign="top">
                                         <table width="830" border="0" cellspacing="0" id="cliente" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td colspan="4" align="center" height="50"> Produto:
                                                  <?
                                                    $dados = array('primary_key' => 'id',
                          'nome' => 'descricao',
                          'nome2'=>'nome_fantasia',
                          'tabela' => 'produto',
                          'condicao' => "where status=1 and produto_principal_id is null and espaco_fisico_id='".$_SESSION["espaco_fisico_id"]."' order by descricao asc",
                          'nome_input' => 'produto_id',
                          'id' => 'produto_id',
                          'class' => 'select',
                                                    'value' => $produto_id);
                          geraSelectProdutos($dados);
                           ?>

                                                </td>
                                              
                                             </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                     <td width="60" class="text_bold_preto" colspan="2" align="center">
									    <input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');" target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
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
</form>



    </table>



    <?php
    if(isset($_SESSION["msg_index"]))
		unset($_SESSION["msg_index"]);
	?>
</body>
</html>
