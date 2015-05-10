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


function chamaInseri() 
{
	var	nomeproduto = $('#produtos').val();
	var codigo =  $('#codigos').val();
    var NomeArquivo;
    var parametro;
    if(codigo == "")
    {
      NomeArquivo = "carregaprodutoid";
      parametro   = "produtos";
      $('#codigos').val();
    } 
    else
    {
      NomeArquivo = "carrega_produto_codigo";
      parametro   = "codigos";   
      $('#produtos').val();
    }             
    
    	$.post('../../includes/'+NomeArquivo+'.php',{ 
		nomeproduto: $('#'+parametro).val()
		
	},function(response)
		{
			// resposta
			if(response == "")
			{
				//alert('Produto não cadastrado.');
				jAlert('Produto não cadastrado.', 'Automação Comercial');
			}
			else
			{	//Criar o array 
                var item=new Array();	//Resposta do id produto
				var DadosIdProduto;
                ArrayIdProduto   = response;//Pegar a unidade os dados da unidade medida
		        DadosIdProduto = ArrayIdProduto.split("-");
                IdProduto   =  DadosIdProduto[0];
                NomeProduto =  DadosIdProduto[1];//Pegar o nome produto
	   	        Quantidade  =     $('#quantidade').val();	//quantidade 
                valor_unitario =  $('#valor_unitario').val();
                disponivel =      $('#disponivel').val();
                valor_total =     $('#valor_total').val();
                if(isNaN(Quantidade))//Verificar se os campos esta vazio
				{
					//alert('Digite a quantidade correta, por favor!');
					jAlert('Digite a quantidade correta, por favor!', 'Automação Comercial');
					$('#quantidade').val("");
					return; 
				}
			    if(Quantidade == "")
				{
					//alert("Preencha todos os campos.");
					jAlert("Preencha todos os campos.", "Autoomação Comercial");
                    return; 
				}
                 if(parseInt(Quantidade) > parseInt(disponivel))
				{
			        //alert("Quantidade maior do que o disponivel.");
					jAlert("Quantidade maior do que o disponivel.", "Automação Comercial");
                   	$('#quantidade').val("");
                    $('#valor_total').hide();	
		     	}//Se 
			    else 			
                {
					item["nome_produto"]   = NomeProduto;
					item["produto_id"]     = IdProduto;
				    item["quantidade"]     = Quantidade;
                    item["valor_unitario"] = valor_unitario;
                    item["valor_total"]    = valor_total;
                	
                    if(parent.verifica_produto(item["produto_id"]))
					{		
						parent.adicionarFilho(item);
						$('#produtos').val("");//recebe o valor do input 
						$('#quantidade').val("");
						$('#codigos').val("");
		                parent.add_produto(item["produto_id"]);
						//alert("Item adicionado com sucesso.");
						jAlert("Item adicionado com sucesso.", "Automação Comercial");
                        parent.Soma(item["valor_total"]);
                        $('#qtd_final').hide();
                        $('#valores').hide();
                    	return; 
					}
					else
					{
						//alert("Esse produto já foi adicionado.");
						jAlert("Esse produto já foi adicionado.", "Automação Comercial");
						$('#produtos').val("");//recebe o valor do input 
						$('#quantidade').val("");
                        $('#codigos').val("");
	                    $('#qtd_final').hide();	
					}
				}	
				//Final		
			}
		}
	)
}

function carrega_quantidade()
{
	quantidade = $("#quantidade").val(), 
    produto_id = $("#produto_id").val(),
    
    $.ajax({
	        	
           method: "get",url: "../../includes/carrega.php?produto_id="+produto_id+"&quantidade="+quantidade,
			dataType: "html",
			beforeSend:  function(){
				$("#mostra_dados").show("fast");
				$("#mostra_dados").html("");
				},
			success: function(html){ 
						$("#mostra_dados").append(html);
						$("#mostra_dados").show();
						$('#valores').show();
						
		 }
	 }); //close $.ajax(
		
}
function carrega(id)
{
    $.ajax({
	        	
           method: "get",url: "../../includes/carrega_quantidade.php?id="+id+"&nome_input="+id,
			dataType: "html",
			beforeSend:  function(){
				$("#mostra").show("fast");
				$("#mostra").html("");
				},
			success: function(html){ 
						$("#mostra").append(html);
						$("#mostra").show();
						$('#qtd_final').show();
						
		 }
	 }); //close $.ajax(
		
}
function abrediv() 
{
		$.post('../../includes/carregaprodutoid.php',
    { 
		nomeproduto: $('#produtos').val()
        
    },
    function(response)
		{
			// resposta
			if(response == "")
			{
		        //alert('Produto não cadastrado.');
				jAlert('Produto não cadastrado.', 'Automação Expocenter');
			}
			else
			{	
			    produto_id = response;
			    DadosIdProduto = produto_id.split("-");
                IdProduto   =  DadosIdProduto[0];
                NomeProduto =  DadosIdProduto[1];//Pegar o nome produto
                carrega(IdProduto);
			}
			
		}

    )
 
 }  
 function AbredivCodigo() 
{
		$.post('../../includes/carrega_produto_codigo.php',
    { 
		nomeproduto: $('#codigos').val()
        
    },
    function(response)
		{
			// resposta
			if(response == "")
			{
		        //alert('Codigo não cadastrado.');
				jAlert('Codigo não cadastrado.', 'Automação Expocenter');
			}
			else
			{	
			    produto_id = response;
	            carrega(produto_id);
			}
			
		}

    )
 
 }   
function sair()
{
	parent.sair();
}
function chamaProduto()
{
	parent.carregaProduto();
}

$().ready(function() {
    
        
        function formatItem(row) {
            return row[0];
        }
        function formatResult(row) {
            return row[0].replace(/(<.+?>)/gi, '');
        }
       
   	    $("#produtos").autocomplete('produtos.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
    });

 $().ready(function() {
    
        
        function formatItem(row) {
            return row[0];
        }
        function formatResult(row) {
            return row[0].replace(/(<.+?>)/gi, '');
        }
       
   	    $("#codigos").autocomplete('codigo.php', {
            width: 300,
            multiple: true,
            matchContains: true,
            formatItem: formatItem,
            formatResult: formatResult,
			maxItemsToShow:10
        });
    });

 function ChamarTipo(value)
 {
    var value;
    if(value == 1)
    {
       $('#produto').hide();
       $('#codigo').show();
       $('#produtos').val('');
       $('#produtos').val();
       $('#qtd_final').hide();
       $('#valores').hide();
    }
    else
    {
       $('#produto').show();
       $('#codigo').hide();
       $('#codigos').val();
       $('#qtd_final').hide();
       $('#valores').hide();
       $('#codigos').val('');
    
    }
}

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
                                                <td height="50" align="center"  colspan="2" class="text_bold_preto" ><button type="button" class="botao_branco" onClick="chamaInseri()">Adicionar</button><button type="submit" class="botao_branco" onClick="sair()">Sair
                                                
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
