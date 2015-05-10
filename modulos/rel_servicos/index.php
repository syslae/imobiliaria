<? session_start();
	
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
	//$DB->debug = true;
	
	###        CONFIGURACAO        ###
	$modulo = "Relátorio Serviços";
	$tabela_id=98;
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
		

	function carregaInput(valor)
	{
		var valor;
	
		if(valor==1)
		{
			$("#data").show();
			$("#nf").hide();
			$("#setor").hide();
			$("#tipoentrada").hide();
			$("#fornecedor").hide();
		}
		if(valor == 2)
		{
			$("#data").hide();
			$("#nf").show();
			$("#setor").hide();
			$("#tipoentrada").hide();
			$("#fornecedor").hide();
		}
		if(valor==3)
		{
			$("#data").hide();
			$("#nf").hide();
			$("#setor").show();
			$("#tipoentrada").hide();
			$("#fornecedor").hide();
		}
		if(valor==4)
		{
			$("#data").hide();
			$("#nf").hide();
			$("#setor").hide();
			$("#tipoentrada").show();
			$("#fornecedor").hide();
		}
		
		if(valor==5)
		{
			$("#data").hide();
			$("#nf").hide();
			$("#setor").hide();
			$("#tipoentrada").hide();
			$("#fornecedor").show();
		}
	}
	$().ready(function() {
    
        
        function formatItem(row) {
            return row[0];
        }
        function formatResult(row) {
            return row[0].replace(/(<.+?>)/gi, '');
        }
        $("#Setor").autocomplete('setor.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
		$("#NotaFiscal").autocomplete('notafiscal.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
		
		$("#TipoEntrada").autocomplete('tipoentrada.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
     	
		$("#Fornecedor").autocomplete('fornecedor.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
   		
		
    });
	
	
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
                                <tr>
                                            	<td colspan="2" align="center"><strong>Selecione o Tipo:</strong>
                                                    <input type="radio" name="tipoRelatorio" value="data"  onClick="carregaInput(1)"/> Data
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
                                                    <input name="data_inicio" type="text" class="input_branco" id="data_inicio" value="<?=$data_inicioPP?>" size="20" maxlength="30">										
                                                 </td>
                                                 <td align="right" class="text_bold_preto">Data Fim:</td>
                                                 <td>   
                                                    <input name="data_fim" type="text" class="input_branco" id="data_fim" value="<?=$data_fimPP?>" size="20" maxlength="30"> 	
												</td>
                                              <tr align="center">
													<td width="60" class="text_bold_preto" colspan="4">
												<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');"
target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
											 </tr>
                                        </table>
                                        <table width="830" border="0" cellspacing="0" cellpadding="0" id="nf" class="bordaPesquisa" style="margin:5px" >
                                        	<tr align="center">
												<td width="25%" height="70" class="text_bold_preto">Nota Fiscal
													<input name="NotaFiscal" type="text" class="input_branco" id="NotaFiscal"  size="20" maxlength="30">
                                                </td>
	                                        </tr>
                                            <tr align="center">
												<td width="60" class="text_bold_preto">
											<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');"
target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
												</td>
											</tr>
									  </table>
                                      <table width="830" border="0" cellspacing="0" id="setor" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                        	<tr align="center">
												<td width="25%" height="70" class="text_bold_preto">Setor
													<input name="Setor" type="text" class="input_branco" id="Setor" value="<?=$Setor?>" size="50" maxlength="50">  </td>
											</tr>
                                            <tr align="center">
												<td width="60" class="text_bold_preto">
													<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');" target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
                                                </td>
											</tr>
 									   </table>
                                        <table width="830" border="0" cellspacing="0" id="fornecedor" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                        	<tr align="center">
												<td width="25%" height="70" class="text_bold_preto">Fornecedor
												    <input name="Fornecedor" type="text" class="input_branco" id="Fornecedor" value="<?=$fornecedor?>" size="50" maxlength="50"></td>
											</tr>
                                            <tr align="center">
												<td width="60" class="text_bold_preto">
													<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');" target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" />
                                                </td>
											</tr>
 							   </table>
                                <table width="830" border="0" cellspacing="0" id="tipoentrada" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                        	<tr align="center">
												<td width="25%" height="70" class="text_bold_preto">Tipo Entrada
												<input type="text"  id="TipoEntrada" name="TipoEntrada" class="input_branco"/></td>
											</tr>
                                            <tr align="center">
	
												<td width="60" class="text_bold_preto">

												<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');"
target='janela1' type="submit" class="botao_branco" value="Gerar Relatório" /></td>

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
            </td>
        </tr>
</form> 
 <script>	
		$("#data").hide();
		$("#nf").hide();
		$("#setor").hide();
		$("#tipoentrada").hide();
		$("#fornecedor").hide();	
</script>                                
              
 
    </table>
   
  
   
    <?php
    if(isset($_SESSION["msg_index"]))
		unset($_SESSION["msg_index"]);
	?>
</body>
</html>
