<? session_start();
	
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");
  	require("../../includes/funcoes.php");

	// $DB->debug = true;
	verifica ("../../login.php");
	
	###        CONFIGURACAO        ###
	$tabela = " parcelas p inner join movimentacao m on m.id = p.movimentacao_id
        inner join cliente c on c.id = m.cliente_id
        inner join situacao_pagamento sp on sp.id = p.situacao_pagamento_id";

	$modulo = "Movimentação";
	$tabela_id=99;
	## campos para pesquisa
	$anti = new AntiInjection();
    $campo_sel = $anti->get('campo');
    $m_id = $anti->get('m_id');

    $options = $anti->get('options');
    $linhas_pagina = (empty($options)) ? 25 : $options;

	if(!empty($campo_sel))
	{
		$nome = $anti->get('nome');
		$operador = $anti->get('operador');

        list($campo_sel,$retorno_nome) = valida_pesquisa($campo_sel,$nome);
			
		if($operador=="qcon") $criterio1 .= "and ".$campo_sel." like '%".$retorno_nome."%'";
		if($operador=="qcom") $criterio1 .= "and ".$campo_sel." like '".$retorno_nome."%'";
		
		$queryString.= "&".$campo_sel."=".$nome;
	}

	## fim dos campos para pesquisa
	
	$criterio = " where 1=1 ".$criterio1."  and p.status = 1 order by p.created desc, p.data_vencimento desc, p.parcela desc";
	$campos = " p.id,p.nosso_numero,p.movimentacao_id,m.cliente_id,c.nome,p.ano,p.parcela,p.data_vencimento,p.valor,p.situacao_pagamento_id, sp.descricao, p.nosso_numero ";
    $campos_filtro = array('p.id' => 'id',
        'p.nosso_numero' => 'nossonumero',
        'p.movimentacao_id' => 'movimentação',
        'm.cliente_id' => 'id cliente',
        'c.nome' => 'nome cliente',
        'p.ano' => 'ano',
        'p.parcela' => 'parcela',
        'p.data_vencimento' => 'data vencimento',
        'p.valor' => 'valor',
        'sp.descricao' => 'situação');

	$parametros= $queryString;
	###        CONFIGURACAO        ###
	include(DOMAIN_PATH."includes/pagina-calculo.php");
    $situacao_pagamento_aberto = $DB->Execute("select id from situacao_pagamento where descricao like '%abert%'")->fields["id"];

    $qtde_parcelamento = $DB->Execute("select * from qtde_parcelamento where status = 1 order by qtde_vezes");

?>

<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>ajax.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<script>

function imprimir_bol() {
    var conjunto_nossos_numeros = "";
    var aChk = document.getElementsByName("c[]");
    itemlist = false;
    for (var i = 0; i < aChk.length; i++) {
        if (aChk[i].checked === true) {
            itemlist = true;
            if (conjunto_nossos_numeros === "")
                conjunto_nossos_numeros = 'bol[]=' + aChk[i].value;
            else
                conjunto_nossos_numeros += '&bol[]=' + aChk[i].value;
        }
    }

    if (itemlist === false) {
        alert('Selecione pelo menos uma parcela!');
        return false;
    }
    window.open('../../includes/boleto/pdf.php?' + conjunto_nossos_numeros, '_blank');
}

function atualizaStatus(posicao,novonivel,id,tabela) 
{
	if(document.getElementById) 
	{
		var divid = document.getElementById("div-"+posicao);
		var ajax = openAjax();
		ajax.open("GET", "../../status.inc.php?id="+id+"&novonivel="+novonivel+"&tabela="+tabela, true);
		ajax.onreadystatechange = function() 
		{
			if(ajax.readyState == 1)
			{
				divid.innerHTML = "<img name='img' src='../../webroot/img_sistema/indicator.gif' border='0'>";
			}
			if(ajax.readyState == 4) 
			{
				if(ajax.status == 200) 
				{
					if (novonivel==1)
					{
						divid.innerHTML = "<img id='img-"+posicao+"' name='img-"+posicao+"' src='../../webroot/img_sistema/bola-verde.gif' onclick='javascript:atualizaStatus("+posicao+",0,\""+id+"\");'  border='0'>";
					}
					else
					{
						divid.innerHTML = "<img id='img-"+posicao+"' name='img-"+posicao+"' src='../../webroot/img_sistema/bola-vermelha.gif' onclick='javascript:atualizaStatus("+posicao+",1,\""+id+"\");'  border='0'>";
					}
				} 
				else 
				{
					divid.innerHTML = "Erro: ";
					alert("erro");
				}
			}
		}
		ajax.send(null);
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
                                     <form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" id="form_pesquisa" method="get">
                                          <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td align="center" valign="top">
                                                 <? 
                                                 
                                                
                                                 include(DOMAIN_PATH."includes/filtro.php") ?>
                                                </td> 
                                            </tr>
                                    	</table>
                                    </form>
                                     <?
                                    if ($tr>0)
									{ ?>
                                    
                                    <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:0;">
                                        <tr>
                                            <td><? include(DOMAIN_PATH."includes/tabela-paginacao.php")?></td>
                                        </tr>
                                    </table>
                                   
                                    <?
									
                                    }
									if(!empty($_SESSION["msg_index"] ))
									{?>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                            	<div class="message success">
                                                    <p><?=$_SESSION["msg_index"] ?></p>
                                                </div>  
                                            </td>
                                        </tr>
                                    </table>
                                    <?
                                    }
									if ($tr>0)
									{
									
									?>
                                    
                                    <form action="remover.php"  name="form" method="post" style="margin-top:40px;margin-bottom:40px;margin-right:10px" >				
                                        <?php include("r-index.php");?>
                                    </form>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-right:0;">
                                        <tr>
                                            <td><? include(DOMAIN_PATH."includes/tabela-paginacao.php")?></td>
                                        </tr>
                                    </table>
                                    
                                    <?
                                    }
									else
									{
									?>
									<table width="830" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;margin-bottom:20px;">
                                        <tr>
                                            <td>
                                            	<div class="message tip">
                                                    <p>Não existem resultados.</p>
                                                </div>
                                             </td>
                                        </tr>
                                    </table>
                                    <?
                                    }
									?>  
                                    

                                    
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
				</table>
            </td>
        </tr>
    </table>
    <?php
    if(isset($_SESSION["msg_index"]))
		unset($_SESSION["msg_index"]);
	?>
</body>

<? if($m_id){?>
<script>
    if(confirm("Gostaria de visualizar os boletos gerados?")){
        window.open('../../includes/boleto/pdf.php?m_id=<? echo $m_id;?>', '_blank');
    }
</script>
<? } ?>


</html>
