<? session_start();
	
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
	//$DB->debug = true;
	
	###        CONFIGURACAO        ###
	$modulo = "Rel�torio Contrato";
	$tabela_id=122;
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
		function carregaInputServico(valor)
	{
		var valor;
	
		if(valor==1)
		{
	        $("#servico").show();
    	}
		if(valor == 2)
		{
	        $("#servico").hide();
            $("#servico").val('');
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
                                             <tr>
                                                 <td colspan="3" align="center"><strong>Filtro cliente:</strong><input  type="radio" name="filtro_cliente" value="1" onclick="carregaInputCliente(1)"/>Sim  <input  type="radio" name="filtro_cliente" value="2" onclick="carregaInputCliente(2)"/>N�o   <!--   <strong>Filtro m�s/ano :</strong><input  type="radio" name="filtro_mes" value="1" onclick="carregaInputMesReferencia(1)"/>Sim  <input  type="radio" name="filtro_mes" value="2" onclick="carregaInputMesReferencia(2)"/>N�o--!> <strong>Servi�o:</strong><input  type="radio" name="filtro_servico" value="1" onclick="carregaInputServico(1)"/>Sim  <input  type="radio" name="filtro_servico" value="2" onclick="carregaInputServico(2)"/>N�o</td>
                                             </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                         <table width="830" border="0" cellspacing="0" id="cliente" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td colspan="4" align="center" height="50"> Cliente:
                                                  <?
													$dados = array('primary_key' => 'id', 
													'nome' => 'nome',
                                                    'nome2'=>'nome_fantasia', 
													'tabela' => 'cliente', 
													'condicao' => "where status=1 and espaco_fisico_id='".$_SESSION["espaco_fisico_id"]."' order by nome_fantasia asc", 
													'nome_input' => 'cliente_id', 
													'id' => 'cliente_id', 
													'class' => 'select',
                                                    'value' => $cliente_id);	
													geraSelectNomeFantasia($dados);
											     ?>
                                                    
                                                </td>
                                                <td colspan="4" align="center" height="50"> Numero Contrato:
                                                   <input  type="text" value="" name="NumeroContrato" size="20" maxlength="20"/>      
                                                </td>
                                             </tr>
                                        </table>
                                        <table width="830" border="0" cellspacing="0" cellpadding="0" id="mes_referencia" class="bordaPesquisa" style="margin:5px" >
                                             <td colspan="3" align="center" height="50">M�s /Ano  
                                              <?
													$dados = array('primary_key' => 'id', 
													'nome' => 'mes',
                                                  	'tabela' => 'meses', 
													'condicao' => "order by id asc", 
													'nome_input' => 'mes_emissao', 
													'id' => 'mes_id', 
													'class' => 'select',
                                                    'value' => $mes_emissao);	
													geraSelect($dados);
													$dados = array('primary_key' => 'id', 
													'nome' => 'ano',
                                                  	'tabela' => 'ano', 
													'condicao' => "order by ano desc", 
													'nome_input' => 'ano_emissao', 
													'id' => 'ano_id', 
													'class' => 'select',
                                                    'value' => $ano_emissao);	
													geraSelect($dados);
											
                                                    ?>
                                                </td>
                                             </tr>
                					  </table>
                                      <table width="830" border="0" cellspacing="0" cellpadding="0" id="servico" class="bordaPesquisa" style="margin:5px" >
                                             <td colspan="3" align="center" height="50">Servi�o
                                              <?
												    $dados = array('primary_key' => 'id', 
													'nome' => 'descricao', 
													'tabela' => 'servico', 
													'condicao' => 'where espaco_fisico_id= "'.$_SESSION["espaco_fisico_id"].'" ORDER BY descricao', 
													'nome_input' => 'servico_id', 
                                                    'id' => 'servico_id', 													
													'onchange' => '', 
													'value' => $servico_id);	
													geraSelect($dados);
										          ?>
                                                </td>
                                             </tr>
                					  </table>
                                      <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                                 <tr>
                                                <td colspan="4" align="center" height="50">  <input  type="radio" name="tipo" value="todos"/>Todos <input  type="radio" name="tipo" value="ativo"/>Ativo  <input  type="radio" name="tipo" value="vencido"/>Vencido  <input  type="radio" name="tipo" value="inativo"/>Inativo</td>
                                             </tr>
                                             <tr align="center">
												<td width="60" class="text_bold_preto">
													<input onClick="window.open('','janela1','toolbar=no, location=no,directories=no, status=no, menubar=no, width=800, height=700, top=250, left=310 resizeable=yes');" target='janela1' type="submit" class="botao_branco" value="Gerar Relat�rio" />
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
            </td>
        </tr>
</form> 
 <script>	
		$("#cliente").hide();
		$("#mes_referencia").hide();
        $("#servico").hide();
</script>                                
              
 
    </table>
   
  
   
    <?php
    if(isset($_SESSION["msg_index"]))
		unset($_SESSION["msg_index"]);
	?>
</body>
</html>
