<? session_start();
	
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");

	// $DB->debug = true;
	verifica ("../login.php");
	
	###        CONFIGURACAO        ###
	$linhas_pagina = 12;
	$tabela = "produto";
	## campos para pesquisa
		$anti = new AntiInjection();
    $campo_sel = $anti->get('campo');
    $produto_principal_id = $anti->get('produto_principal_id');
	if(!empty($campo_sel))
	{
		$nome = $anti->get('nome');
     	$operador = $anti->get('operador');
			
		if($operador=="qcon") $criterio1 .= "and ".$campo_sel." like '%".$nome."%'";
		if($operador=="qcom") $criterio1 .= "and ".$campo_sel." like '".$nome."%'";
  		if($operador=="maiorq") $criterio1 .= "and ".$campo_sel." >  '".$nome."'";
		if($operador=="menorq") $criterio1 .= "and ".$campo_sel." < '".$nome."'";
		
		$queryString.= "&".$campo_sel."=".$nome;
	}
	## fim dos campos para pesquisa
	
	$criterio = " where 1=1 ".$criterio1." and produto_principal_id = '$produto_principal_id' order by descricao";
	$campos = " id,codigo,descricao,valor,espaco_fisico_id,created,status";
	$parametros= $queryString;
	###        CONFIGURACAO        ###
	include(DOMAIN_PATH."includes/pagina-calculo.php");

?>

<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>ajax.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<script src="<?=URL.'/webroot/js/'?>jquery.alerts.js" type="text/javascript"></script>
<link href="<?=URL.'/webroot/css/'?>jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<script>
function sair()
{
	
	parent.sair_tick();
	
}
function chama_inserir_assis(id)
{
    var quantidade = 1;
    var estoque    = $('#estoque_'+id).val();
    var descricao_reduzida = $('#descricao_'+id).val();
   	var valor =       $('#valor_'+id).val();
    DadosValor        =  valor;//Pegar o valor total
	DadosValor        =  DadosValor.replace(".", "");//explode os .
    DadosValor        =  DadosValor.replace(",", ".");//explode as ,
    var valor_total = (parseFloat(DadosValor)*quantidade);   
   
    //alert(valor_total);
    
    if(isNaN(quantidade))//Verificar se os campos esta vazio
	{
		//alert('Digite a quantidade correta, por favor!');
		jAlert('Digite a quantidade correta, por favor!', 'Automação Expocenter');
	    $('#quantidade_'+id).val("");
		return; 
	}
    else if(quantidade == "")//Verificar se os campos esta vazio
	{
		//alert('Quantidade em branco, digite uma por favor!');
		jAlert('Quantidade em branco, digite uma por favor!', 'Automação Expocenter');
		$('#quantidade_'+id).val("");
		return; 
	}
    else if(parseInt(quantidade) >  parseInt(estoque))//Verificar se os campos esta vazio
	{
        //alert('Quantidade maior a do que esta no estoque, digite outra por favor!');
		jAlert('Quantidade maior a do que esta no estoque, digite outra por favor!', 'Automação Expocenter');
		$('#quantidade_'+id).val("");
		return; 
	}
    
    else
    {
       var dados=new Array();
	   dados["produto_id"] = id;
	   dados["nome_produto"] = descricao_reduzida;
       dados["quantidade"]  = quantidade;
       dados["valor_unitario"]  = valor;
       dados["valor_total"]  = valor_total;
       if(parent.verifica_produto(id))
	   {
         parent.add_produto(dados["produto_id"]);
         parent.adicionarFilho(dados);
         //alert("Item adicionado com sucesso.");
		 jAlert("Item adicionado com sucesso.", 'Automação Expocenter');
         $('#quantidade_'+id).val("");
         parent.Soma(dados["valor_total"]);
         return;              
       }
       else
       {
        	//alert("Esse produto já foi adicionado.");
			jAlert("Esse produto já foi adicionado.", 'Automação Expocenter');
		     $('#quantidade_'+id).val("");
	    
       }
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
                                    <td align="center" valign="top">
										<table width="550" border="0" cellspacing="0" cellpadding="0" class="filtro">
                                        <tr>
                                           <td width="37">
                                                  <img src="<?=URL.'/webroot/img_sistema/'?>seta_redonda.png" id="esquerda"/>        </td>
                                                <td width="719">
                                                   
                                                  <h1 style="font-size:20px;margin-top:10px">Produtos</h1>
                                                    
                                                </td>
                                                
                                                 <td width="74" align="left">
                                                 <input type="button" class="botao_branco" onClick="sair()" value="Sair">
                                                </td>
                                        </tr>                                        
                                        </table>
                                    </td>
                                </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                      
									  <?
										$ar=$rs->GetRowAssoc(0);//aqui eu pego os campos 
										?>
										<form action=""  name="form" method="get">				
										 <table width="550" border="0" cellspacing="0" cellpadding="0" class="filtro">
											<td width="6">
												 <table width="550" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
                                            <tr>
                                                <td align="center" valign="top">
                                                 <?

   $ar = $rs->GetRowAssoc(1);//aqui eu pego os campos 
?>
<form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="get">	
	<style>
		/*ESTILO PARA COLUNAS E COMPONENTES DA TABELA DE FILTRO - BY NATAN EM 23.06.2010*/
		table .tit{font:bold 12px arial;}
        table td .camp{border:1px solid #336699;}
        table td .opera{border:1px solid #336699; font:bold 12px arial;}
		table td .desc{border:1px solid #336699; font:bold 12px arial;}
        table td .bot{margin-left:105px; font:bold 12px arial; cursor:pointer;}	
    </style>	
    <table width="800" border="0" cellspacing="0" cellpadding="0" class="filtro">
        <tr>
            <!-- personalize com os campos que deseja-->
            <td class="tit" width="200" >Campo<br />
                  <select name="campo" id="campo" class="camp">
                     <? foreach($ar as $campo=>$value) :?> 
                           <? if($campo!="id" and $campo!="created" and $campo!="status") : ?> 
                            <option value="<?=$campo?>" 
                                <? if(trim($campo)==trim($campo_sel)) 
                                    echo"selected";?>><?=ucwords($campo)
                                ?>
                            </option> 
                            <? endif; ?>
                     <? endforeach; ?>
                  </select>
            </td>
            <td class="tit" width="200" >Operador<br />
                <select name="operador" id="campo" class="opera">					
                    <option value="qcon" <? if($operador=="qcon") echo"selected";?>>Que Contenha</option> 
                    <option value="qcom" <? if($operador=="qcom") echo"selected";?>>Que Comece</option>
					<option value="maiorq" <? if($operador=="maiorq") echo"selected";?>>Maior que</option>  
					<option value="menorq" <? if($operador=="menorq") echo"selected";?>>Menor que</option>                       
                </select>
            </td>                  
            <td class="tit" width="120" >Descrição<br />
                <input name="nome" type="text" id="nome" value="<?=$nome?>" size="30" maxlength="30" class="desc">
            </td>              
            <td class="tit" valign="bottom">
                <input type="hidden" name="produto_principal_id" value="<? echo $produto_principal_id;?>"/>
                <input type="submit" name="Procurar" id="Procurar" value="Procurar" class="bot">
            </td>
        </tr>
    </table>
</form>
                                                </td> 
                                            </tr>    
                                    	           </table>
											  </td>
											</tr>
										</table>
										</form>
                                     <?
                                    if ($tr>0)
									{ ?>
                                    
                                    <?
							        }
									if(!empty($_SESSION["msg_index"] ))
									{?>
                                    <table width="550" border="0" cellspacing="0" cellpadding="0" >
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
                                   			
                                      <table width="830" id="tablesorter-demo" cellspacing="1" cellpadding="0" class="tablesorter" border="0">
                        			<thead>
                        				<tr>
                        					<th width="57">Adici.</th>
                                            <th width="30">Id.</th>
                                            <th width="30">Código</th>
                                            <th width="190">Descrição</th> 
                                            <th width="20">Valor</th>
                                           
                        				</tr>
                        			</thead>
				<?
				if ($tr>0)
				{
					if (!$rs) 
					{

						print $DB->ErrorMsg(); //mostra mensagem de erro

					} // fim do IF
					else
					{
						$posicao=1;

						while (!$rs->EOF)
						{

							$id = $rs->fields['id'];
							# Fundo da Célula

							$x = $x + 1;   

							$div = $x % 2; 

							if ($div != 0) $bg = $GLOBALS["bg1"]; else $bg = $GLOBALS["bg2"];

							# fim Fundo da Célula

							echo '

							<tr bgcolor="'.$bg.'">
								<td align="center">';
							   if($rs->fields["status"] == 1) echo '<a href="javascript:;" onclick=\'chama_inserir_assis('.$id.')\'><img src="../../webroot/img_sistema/novo.gif" border="0" alt="Adcionar" title="Adcionar" /></a>&nbsp;&nbsp;';
							   else echo "<span class='text_bold_vermelho'>Não disponível</span>";
                            echo '</td>
								<td class="text_padrao">'.$rs->fields["id"].'<input  type="hidden" name="" id="estoque_'.$id.'" value="'.$rs->fields["descricao"].'" /></td>
					            <td class="text_padrao">'.$rs->fields["codigo"].'</td>
					            <td class="text_padrao">'.$rs->fields["descricao"].'<input  type="hidden" name="" id="descricao_'.$id.'" value="'.$rs->fields["codigo"].' '.$rs->fields["descricao"].'" /></td>
                                <td class="text_padrao" align="center">R$ '.moeda($rs->fields["valor"]).'<input  type="hidden" name="" id="valor_'.$id.'" value="'.moeda($rs->fields["valor"]).'"/></td> 
	                 	        
                          </tr>

							';
                            $posicao++;

							$rs->MoveNext();

						}

					}

				}

				else
				{
					echo '<center class="text_vermelho"><b>N&atilde;o existem resultados</b></center><br>';
				}	
				?>
				</table>

                                  
                                    <?
                                    }
									else
									{
									?>
									<table width="550" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;margin-bottom:20px;">
                                        <tr>
                                            <td>
                                            	<div class="message tip">
                                                    <p>N&atilde;o existem resultados.</p>
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
</html>
