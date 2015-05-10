<? session_start();

	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
	//$DB->debug = true;

	###        CONFIGURACAO        ###
	$modulo = "Relátorio de Baixa";
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
                                    <td align="center" valign="top">

                                        <form name="formrel" action="relatorios/gera_relatorio.php" method="post" enctype="multipart/form-data" target="janela1" >


                                            <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                                <tr>
                                                    <td width="37">
                                                        <img src="<?=URL.'/webroot/img_sistema/'?>quadro.jpg" id="esquerda"/>        </td>
                                                    <td width="719">

                                                        <h1><a href=""  style="font-size:16px"><? echo $modulo;?></a></h1>

                                                    </td>

                                                    <td width="74" align="left">
                                                    </td>
                                                </tr>
                                            </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>Selecione o Tipo:</strong>
                                        <input type="radio" name="tipoRelatorio" value="data"  onClick="carregaInput(1)" checked=""/> Data
                                        <!--  <input type="radio" name="tipoRelatorio" value="nota" onClick="carregaInput(2)"/> Nota Fiscal
                                          <input type="radio" name="tipoRelatorio" value="tipoentrada" onClick="carregaInput(4)"/> Tipo Entrada
                                          <input type="radio" name="tipoRelatorio" value="fornecedor" onClick="carregaInput(5)"/> Fornecedor-->
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <table width="830" border="0" cellspacing="0" id="data" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td align="right" class="text_bold_preto">Data Inicio:</td>
                                                <td  height="70" >
                                                    <input name="data_inicio" type="text" class="input_branco" id="data_inicio" value="<?=$data_inicioPP?>" size="20" maxlength="10" onkeypress="Mascara(this,mascData);">
                                                </td>
                                                <td align="right" class="text_bold_preto">Data Fim:</td>
                                                <td>
                                                    <input name="data_fim" type="text" class="input_branco" id="data_fim" value="<?=$data_fimPP?>" size="20" maxlength="10" onkeypress="Mascara(this,mascData);">
                                                </td>
                                            <tr align="center">
                                                <td width="60" class="text_bold_preto" colspan="4">
                                                    <input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');"
                                                           target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="100">&nbsp;</td>
                                </tr>
                            </table>

                        </td>
                    </tr>
				</table>
            </td>
        </tr>
</form>
 <script>
		$("#cliente").hide();
		$("#mes_referencia").hide();
</script>


    </table>



    <?php
    if(isset($_SESSION["msg_index"]))
		unset($_SESSION["msg_index"]);
	?>
</body>
</html>
