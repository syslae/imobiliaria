<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
  
	
	// verifica ("../../login.php");
	// ###        CONFIGURACAO        ###
	$tabela = 'cliente';
	$modulo = "Cliente";
	$tabela_id=81;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/cliente.Model.php");
		include(DOMAIN_PATH."core/controller/cliente.Controller.php");
	}
     // $DB->debug = true;
	
	$acaoPagina = 'cadastrar';
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=URL.'/webroot/css/'?>datePicker.css">
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>javascript.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.maskedinput.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.datePicker.js"></script>
<script src="<?=URL.'/webroot/js/'?>date.js"></script>

<script type="text/javascript" charset="utf-8">
	jQuery(function($){
		  $(document).ready(function()
          {
				  $('#telefone').mask("(99)9999-9999"); 
				  $('#celular').mask("(99)9999-9999"); 
                  $('#cpf').mask("999.999.999-99");
                  $('#cnpj').mask("99.999.999/9999-99");
          });
	});
    
 
		
function carregaInput(valor)
{
	var valor;
	if(valor==0)
	{
		$("#nome_fisica").show();
		$("#identidade_fisica").show();
        $("#cpf_fisica").show();
        $("#data_nascimento").show();
        $("#razao_social_juridica").hide();
        $("#nome_juridica").hide();
        $("#inscricao_estadual").hide();
        $("#cnpj_juridica").hide();
        $("#razao_social").val('');
        $("#nome_fantasia").val('');
        $("#cnpj").val('');
       
 	    
	}
	else
	{
		$("#nome_juridica").show();
        $("#inscricao_estadual").show();
		$("#razao_social_juridica").show();
        $("#cnpj_juridica").show();
        $("#nome_fisica").hide();
     	$("#identidade_fisica").hide();
        $("#data_nascimento").hide();
        $("#cpf_fisica").hide();
        $("#nome").val('');
     	$("#identidade").val('');
        $("#cpf").val('');
   	}
}

$(function()
		{
		
	          $('#data_nascimento_fisico').datePicker({startDate:'01/01/1900'});
			 
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
                                    <td align="center" valign="top"><? include(DOMAIN_PATH."includes/barra.php")?></td>
                                </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                    
                                    
                                    <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="post" enctype="multipart/form-data">				
                                         <table width="830" border="0" cellspacing="2" cellpadding="0" class="borda" style="margin:5px" >
                                            <tr><td colspan="2" class="text_bold_azul">&nbsp;</td></tr>
                                            
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto"><div id="msgUpload" style="text-align:center"><?=$msgUpload?></div></td>
                                                <td width="78%" class="text_padrao">&nbsp;</td>
                                            </tr>
                                             <tr>
                                                <td height="36" align="center" class="text_bold_preto" colspan="2">
                                                    <input  type="radio" name="opcao"  onclick="carregaInput(0)" />Pessoa fisica
                                                    <input  type="radio" name="opcao"  onclick="carregaInput(1)"/>Pessoa juridica
                                               </td> 
                                            </tr>
                                            
                                            <!-- <tr id="cpf_fisica">
                                                <td height="36" align="right" class="text_bold_preto">CPF</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cpf)) $class_cpf = 'input_branco'; else $class_cpf = 'input_erro'; ?>
                                                    <input name="cpf" type="text" class="<?=$class_cpf?>" id="cpf" value="<?=stripslashes($cpf)?>"  size="16" maxlength="16"  />
                                                    <button type="submit" class="botao_branco">Importar</button>
                                                </td>
                                            </tr> 

                                           

                                            <tr id="cnpj_juridica">
                                                <td height="36" align="right" class="text_bold_preto">CNPJ</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cnpj)) $class_cnpj = 'input_branco'; else $class_cnpj = 'input_erro'; ?>
                                                    <input name="cnpj" type="text" class="<?=$class_cnpj?>" id="cnpj" value="<?=stripslashes($cnpj)?>"  size="20" maxlength="20" />
                                                    <button type="submit" class="botao_branco">Importar</button>
                                                </td>
                                            </tr> -->

                                            <?
                                            if(!empty($_POST))
                                            {


                                                $cpf_query = trim($_POST['cpf']);
                                                $cpf_query = substr($cpf_query,0,16);
                                                $cpf_query= addslashes($cpf_query); 
                                                $cnpj = $_POST['cnpj'];

                                                // print_r($_POST);

                                                // echo $cpf;

                                                if($cpf_query == '')
                                                {
                                                    $complement  .= "where cnpj = '".$cnpj."'";
                                                }else
                                                {
                                                    $complement  .= "where cpf = '".$cpf_query."'";
                                                }



                                               $sql = "select * from cliente ".$complement." ";
                                                $rs = $DB->Execute($sql);
                                                $tr = $rs->RecordCount();
                                                if ($tr>0)
                                                {
                                                    $tipo = $rs->fields['tipo'];
                                                    $nome = $rs->fields['nome'];
                                                    $razao_social = $rs->fields['razao_social'];
                                                    $complemento = $rs->fields['complemento'];
                                                    $nome_fantasia = $rs->fields['nome_fantasia'];
                                                    $identidade = $rs->fields['identidade'];
                                                    $inscricao_estadual = $rs->fields['inscricao_estadual'];
                                                    $logradouro = $rs->fields['logradouro'];
                                                    $bairro = $rs->fields['bairro'];
                                                    $numero = $rs->fields['numero'];
                                                    $cep = $rs->fields['cep'];
                                                    $telefone = $rs->fields['telefone'];
                                                    $celular = $rs->fields['complemento'];
                                                    $estado_id = $rs->fields['estado_id'];
                                                    $cpf = trim($rs->fields['cpf']);
                                                    $cpf = substr($cpf,0,16);
                                                    $cpf = addslashes($cpf); 
                                                    $cnpj = $rs->fields['cnpj'];
                                                    $cidade_id = $rs->fields['cidade_id'];
                                                    $email = $rs->fields['email'];
                                                    $data_nascimento = $rs->fields['data_nascimento'];
                                                    $pessoa_contato = $rs->fields['pessoa_contato'];
                                                    $observacao = $rs->fields['observacao'];

                                                }

                                            }?>

                                                <tr id="cpf_fisica">
                                                <td height="36" align="right" class="text_bold_preto">CPF</td>
                                                <td class="text_padrao">
                                                    
                                                    <input name="cpf" type="text" class="<?=$class_cpf?>" id="cpf" value="<?=stripslashes($cpf)?>"  size="16" maxlength="16"  />
                                                    <button type="submit" class="botao_branco">Importar</button>
                                                     <input name="dados" type="hidden" id="dados" value="<?php echo serialize($dados)?>" />
                                                </td>
                                            </tr> 

                                            

                                            <tr id="cnpj_juridica">
                                                <td height="36" align="right" class="text_bold_preto">CNPJ</td>
                                                <td class="text_padrao">
                                                    
                                                    <input name="cnpj" type="text" class="<?=$class_cnpj?>" id="cnpj" value="<?=stripslashes($cnpj)?>"  size="20" maxlength="20" />
                                                    <button type="submit" class="botao_branco">Importar</button>
                                                    <input name="dados" type="hidden" id="dados" value="<?php echo serialize($dados)?>" />
                                                </td>
                                            </tr>


                                            </form>

                                            <form action="<? echo $GLOBALS["paginaAtual"]?>" name="form" method="post" enctype="multipart/form-data">            
        

                                                <?php include('r-camposImportar.php');?>

                                        
                                            
                                            <tr> 
                                                <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                            </tr>
                                            <tr >
                                                <td height="50" align="right" class="text_bold_preto" ><button type="submit" class="botao_branco">Salvar</button></td>
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
	
    <script>
        $("#nome_fisica").hide();
        $("#nome_juridica").hide();
       	$("#identidade_fisica").hide();
        $("#cpf_fisica").hide();
        $("#razao_social_juridica").hide();
        $("#data_nascimento").hide();
        $("#cnpj_juridica").hide();
        $("#inscricao_estadual").hide();
       
        
    </script>
</html>
