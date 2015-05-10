<? session_start();

	require("../config/define.php");

	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	$espaco_fisico_id = $_GET["espaco_fisico_id"];
	if(!empty($espaco_fisico_id))
	{
		$_SESSION["espaco_fisico_id"] = $espaco_fisico_id;
		$salvo=1;
	}
	
	###        CONFIGURACAO        ###
	
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<script>

<? if($salvo):?>
	parent.sair_tick();
<? endif; ?>

</script>

</head>
<body>
    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
            <td valign="top">
            	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                        
                        <td valign="top">
                            <table width="100%" border="0" cellspacing="6" cellpadding="0">
                               
                                <tr> 
                                    <td align="center">
                                    
                                     <fieldset>
                                     <legend class="bordaPesquisa"><b>Empresa:</b></legend>
                                         <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                            <tr>
                                                <td class="text_padrao">
													<?
															$dados = array('primary_key' => 'id', 
															'nome' => 'descricao', 
															'tabela' => 'espaco_fisico', 
															'condicao' => 'WHERE status=1 AND id IN 
					(SELECT espaco_fisico_id FROM usuarios_predios WHERE usuarios_id='.$_SESSION["idusuario_g"] .') order by descricao asc', 
															'nome_input' => 'espaco_fisico_id', 
															'id' => 'espaco_fisico_id', 
															'class' => 'espaco_fisico_id', 
															'onchange'=>'',
															'value' => $espaco_fisico_id);	
															
															
															$sql = "select ".$dados['primary_key'].",".$dados['nome']." from ".$dados['tabela']." ".$dados['condicao']." ";
															$rs = $DB->Execute($sql);
																
															$texto = '
															<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" 
															onChange=\'document.location="?espaco_fisico_id="+this.value+"&esta_na_raiz='.$estaNaRaiz.'"\'>
															<option value="0"> Escolha uma op&ccedil;&atilde;o</option>
															';
													
															while (!$rs->EOF)
															{
															
																$texto .= '<option value="'.$rs->fields[$dados['primary_key']].'" '; 
																
																if($dados["value"] == $rs->fields[$dados['primary_key']])
																		$texto.= 'selected';
													
																$texto.='>'.retirar_acentos_caracteres_especiais($rs->fields[$dados['nome']]).'</option>'."\r\n";
														
																$rs->MoveNext();
													
															}
													
															
															$texto.='</select>';
															
															echo $texto;
																												
															?>			
                                               </td>
                                            </tr> 
                                        </table>
                                   </fieldset>
                                    
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
