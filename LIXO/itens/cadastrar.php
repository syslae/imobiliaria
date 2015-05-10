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
<script src="<?=URL.'/includes/'?>funcoes.js"></script>
<script>


function chamaInseri() 
{
		$.post('../../includes/carregaprodutoid.php',{ 
		nomeproduto: $('#produtos').val()
		
	},function(response)
		{
			// resposta
			if(response == "")
			{
				alert('Produto não cadastrado.');
			}
			else
			{	
				//Criar o array 
				var item=new Array();	//Resposta do id produto
				IdProduto = response;//Pegar a unidade os dados da unidade medida
				DadosUnidadeMedida = $('#unidade_medida_id').val();	//Explode os dados da unidade de medida
				DadosDoArrayUnidadeMedida = DadosUnidadeMedida.split(" ");	
				UnidadeMedidaId  = DadosDoArrayUnidadeMedida[0];//Pega o id
				NomeProdutoUnidadeMedida = DadosDoArrayUnidadeMedida[1];//Pega a descricao da unidade medida
				QuantidadeFinal  =  $('#quantidade_final').val();//Pegar a quantiadade de entrada
	          	NomeProduto  =  $('#produtos').val();//Pegar o nome produto
	   			ValorExibel  =  $('#valor_total').val();//Valor exibel na tela
				ValorTotal  =  ValorExibel;//Pegar o valor total
				ValorTotal = ValorTotal.replace(".", "");//explode os .
                ValorTotal = ValorTotal.replace(",", ".");//explode as ,
				ValorTotal = parseFloat(ValorTotal).toFixed(2);//Tirando a quantide de casa decimais
				ValorTotalItem = (QuantidadeFinal * ValorTotal);//Valor total do itens
				if(isNaN(QuantidadeFinal))//Verificar se os campos esta vazio
				{
					alert('Digite a quantidade correta, por favor!');
					$('#quantidade_final').val("");
					return; 
				}
				if(NomeProduto == "" || UnidadeMedidaId == 0 || QuantidadeFinal == "" || ValorTotal == "")
				{
					alert("Preencha todos os campos.");
				}//Se não
				else
				{
					item["nome_produto"] = NomeProduto;
					item["produto_id"] = IdProduto;
					//item["ValorExibel"] = ValorExibel;
					item["unidade_medida_id"] = UnidadeMedidaId;
					item["quantidade_final"] = QuantidadeFinal;
					item["valor_total"] = ValorTotal;
					item["NomeProdutoUnidadeMedida"] = NomeProdutoUnidadeMedida;
					item["ValorTotalItem"] = ValorTotalItem;		
					if(parent.verifica_produto(item["produto_id"]))
					{		
						parent.adicionarFilho(item);
						$('#produtos').val("");//recebe o valor do input 
						$('#quantidade_final').val("");
						if(valor_total!="a") $('#valor_total').val("");
						parent.add_produto(item["produto_id"]);
						$('#unidade_medida_id').val("");
						$('#mostra').hide();
						parent.Soma(item["ValorTotalItem"]);
						alert("Item adicionado com sucesso.");	
						return; 
					}
					else
					{
						alert("Esse produto já foi adicionado.");
						$('#produtos').val("");//recebe o valor do input 
						$('#quantidade_final').val("");	
						$('#unidade_medida_id').val("");
						$('#mostra').hide();
						$('#valor_total').val("");
					}
				}	
				//Final		
			}
		}
	)
}

function UnidadeMedida(id,tabela,descricao) 

	
	
		//carregaSelect(id,tabela,descricao);		
$.post('../../includes/carregaprodutoid.php',{ 
		nomeproduto: $('#produtos').val()
		
	},function(response)
		{
			// resposta
			if(response == "")
			{
				alert('Produto não cadastrado.');
			}
			
				//Final		
			
		
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
function chamaUnidadeMedida()
{
	parent.carregaUnidadeMedida();
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
