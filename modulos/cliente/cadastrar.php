<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
  
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'cliente';
	$modulo = "Cliente";
	$tabela_id=81;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/cliente.Model.php");
		include(DOMAIN_PATH."core/controller/cliente.Controller.php");
	}
	
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
		
    function ValidarCPF(Objcpf){
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" ); 
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;

        for(i=0;i<9;i++){
                soma1+=eval(cpf.charAt(i)*(vlr-1));
                soma2+=eval(cpf.charAt(i)*vlr);
                vlr--;
        }       
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);

        var digitoGerado=(soma1*10)+soma2;
        if(digitoGerado!=digitoDigitado){        
                alert('CPF Invalido!');
                document.getElementById("cpf").focus();
                document.getElementById("cpf").value='';
            }
    }

    function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= new Number;
        var dig2= new Number;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" ); 
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

        for(i = 0; i<valida.length; i++){
                dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
                dig2 += cnpj.charAt(i)*valida[i];       
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

        if(((dig1*10)+dig2) != digito){  
                alert('CNPJ Invalido!');
             document.getElementById("cnpj").focus();
             document.getElementById("cnpj").value='';
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
                                    
                                    
                                    <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="post" enctype="multipart/form-data">				
                                         <table width="830" border="0" cellspacing="2" cellpadding="0" class="borda" style="margin:5px" >
                                            <tr><td colspan="2" class="text_bold_azul">&nbsp;</td></tr>
                                            <? if (!empty($erro)) {?>
                                            <tr align="center"> 
                                                <td colspan="2" width="330" >
													<div class="message error">
														<p> <strong> Desculpe, &eacute; necess&aacute;rio preencher corretamente os campos em destaque.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
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
                                            <?php include('r-campos.php')?>
                                            
                                            
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
