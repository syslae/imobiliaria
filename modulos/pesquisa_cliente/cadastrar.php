<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'itens';
	$modulo = "Itens";
	$tabela_id=20;
	if(isset($_POST['acao']) && $_POST['acao']=='cadastrar')
	{
		include(DOMAIN_PATH."core/model/itens.Model.php");
		include(DOMAIN_PATH."core/controller/itens.Controller.php");
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
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>javascript.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<link href="<?=URL.'/webroot/css/'?>jquery.autocomplete.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>jquery.autocomplete.js"></script>
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>

<script src="<?=URL.'/webroot/js/'?>jquery.alerts.js" type="text/javascript"></script>
<link href="<?=URL.'/webroot/css/'?>jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<script>

function sair()
{
	parent.sair();
}
function ChamaInseriCliente() 
{
	
	
		//Criar o array 
        var item= new Array();	//Montando array
	    var Cliente  = $('#clientes').val();//Pegando dados array
        DadosCliente = Cliente.split("-");//Explode array

        var NomeCliente =  DadosCliente[1];//Nome cliente
        var cliente_id  =  DadosCliente[0];//id cliente
        if(isNaN(cliente_id))//Verificar se os campos esta vazio
		{
			//alert('Selecione o nome correto, por favor!');
			jAlert('Selecione o nome correto, por favor!', 'Automação');
			$('#clientes').val("");
			return; 
		}
	   else 			
       {
	        item["nome_cliente"]   = NomeCliente;
			item["cliente_id"]     = cliente_id;
		    if(parent.verifica_cliente(item["cliente_id"]))
			{		
				parent.adicionarFilhoCliente(item);
				parent.add_cliente(item["cliente_id"]);
				//alert("Item adicionado com sucesso.");
				jAlert("Item adicionado com sucesso.", "Automação");
                $('#qtd_final').hide();
                $('#valores').hide();
                 sair();		
           		return; 
			}
		
		}	
			//Final		
}
$().ready(function() {
    
        
        function formatItem(row) {
            return row[0];
        }
        function formatResult(row) {
            return row[0].replace(/(<.+?>)/gi, '');
        }
       
   	    $("#clientes").autocomplete('clientes.php', {
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
                                    
                                    
                                    <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="post" enctype="multipart/form-data">				
                                         <table width="830" border="0" cellspacing="2" cellpadding="0" class="borda" style="margin:5px;width:450px;" >
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
                                            
                                            <?php include('r-campos.php')?>
                                            
                                            
                                            <tr> 
                                                <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                                <td height="50" align="center"  colspan="2" class="text_bold_preto" ><button type="button" class="botao_branco" onClick="ChamaInseriCliente()">Adicionar</button><button type="submit" class="botao_branco" onClick="sair()">Sair
                                                
                                                </button></td>
                                              
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
</html>
