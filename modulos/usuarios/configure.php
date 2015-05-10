<? session_start();
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."classes/class_anti_injection.php");

	

	//$DB->debug = true;
	verifica ("../../login.php");
	
	###        CONFIGURACAO        ###
	$tabela = "usuarios";
	$linhas_pagina = 25;
	
	## campos para pesquisa
	$anti = new AntiInjection();
	
	$chavecrp = $anti->get('x_lpK03fb');
	list ($id,$login) = split ('Acl9s1Ks', $chavecrp);
	
	$id = (int)$id;

	if(!empty($id))
	{
		$criterio1 = "and id = $id";
	}
	else
	{
		$_SESSION["msg_index"] = 'Esse n&atilde;o &eacute; um usu&aacute;riov&aacute;lido!';
		header("Location: index.php");
	}
	## fim dos campos para pesquisa
	
	$criterio = " where 1=1 ".$criterio1."";
	
	$campos = "id, login, senha, nome, tipo";
	###        CONFIGURACAO        ###
	include("../includes/pagina-calculo.php");

	if (geraSenha($rs->fields['login'])<>$login)
	{
		$_SESSION["msg_index"] = 'Esse n&atilde;o &eacute; um usu&aacute;riov&aacute;lido!!';
		header("Location: index.php");
	}

	/**
	0 = 29f69707d4b3cc0e7ce374ba053b044ef0eb27b5
	1 = 9da3327c88ea840a0115851d5820b94c3e9b5052
	2 = 5c02a022fd5c154e6e6f57571b6af570d0478f08 
	3 = 463ba12af59f9ff64e7267ef35a8e0772440e61f 
	4 = c7eab78937d6719f15ee50dcf1d219bc2a3e1349 
	5 = 551b7aa5c7ad0d0502e7f20adc29be0c28d14794 
	6 = 06d060c6ec86b1822e28e47d507eaeb11122ecef 
	7 = 3ac12a0b4a3337df77301244c9f5103da4410a6f 
	8 = e6d4684f8d4d9e4fd73853b820d2d78e61d3474c 
	9 = 1feb471b56f7e768c5cbcecc3bfd638dbfada4a6 
	*/
	
	$linkbase = 'x_lpK03fb='.$chavecrp.'&xp32kjO4wRv=';
	$secaoPermissao = $anti->get('xp32kjO4wRv');
	if(!empty($secaoPermissao))
	{
		if($secaoPermissao == '65fbd526b67d9caec2a9997c55c749dbd04e109e')
		{
			$secao = 'empresas';
			$menu_id = "0a";
		}
		else if($secaoPermissao == 'c71bf315e3962429b2e54ac03ec0ef8071cfab28')
		{
			$menu_id = "0b";
			$secao = 'Administra&ccedil;&atilde;o';
		}
		else if($secaoPermissao == '250f688520b14472f475e7bc72d873b454f4f60e')
		{
			$menu_id = "0c";
			$secao = 'Remover permissoes';
			$sqlp="delete from usuariotabelas where usuario_id = $id ";
			$DB->Execute($sqlp);
			
			$sqlp="delete from usuariosecoes where usuario_id = $id ";
			$DB->Execute($sqlp);
			
			$_SESSION["msg_index"] = 'Permissoes desse usuario removidas com sucesso';
			header("Location: configure.php?".$linkbase);
			exit;
		}
		else if($secaoPermissao == '022d41d21e8105dd03b4886f44bb30349f2ac95e')
		{
			$menu_id = "0d";
			$secao = 'Atribuir Super usuario';
			
			$sqlp="update usuarios set tipo = 1 where id = $id";
			$DB->Execute($sqlp);
			
			$_SESSION["msg_index"] = 'Permissao de Super usuario atribuíba com sucesso';
			redireciona("configure.php?".$linkbase);
			exit;
			
		}
		else if($secaoPermissao == '42d4c5aaa856cd7feb1f6ea4280bb08e7fe898e6')
		{
			$menu_id = "0e";
			$secao = 'Remover Super usuario';
			
			$sqlp="update usuarios set tipo = 0 where id = $id";
			$DB->Execute($sqlp);
			
			$_SESSION["msg_index"] = 'Permissao de Super usuario REMOVIDA com sucesso';
			redireciona("configure.php?".$linkbase);
			exit;
		}
		/*else
		{
			$sqlp="select * from menus order by id asc";
			$linhap = $DB->Execute($sqlp);
	
			while(!$linhap->EOF)
			{
				$idCript = geraSenha($linhap->fields['id']);
				if($idCript==$secaoPermissao)
				{
					$menu_id = $linhap->fields['id'];
					$secao = $linhap->fields['nome'];
					break;
				}				
				$linhap->MoveNext();
			}
		}*/
		
		if(empty($menu_id))
		{
			$_SESSION["msg_index"] = 'Esse valor n&atilde;o &eacute; v&aacute;lido!!';
			header("Location: index.php");
			exit;
		}
	}
	
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
<script src="<?=URL.'/webroot/js/'?>ajax.js"></script>

<script>
function alterastatus(idp, id, idt, status, tabela)
{
	$.ajax(
			{
				type: "GET",
				url: "statuspermissao.php",
				data: "idp="+idp+"&id="+id+"&idt="+idt+"&status="+status+"&tabela="+tabela,
				success: 
					function(data)
					{
						$('#status'+idt).html(data);
					}
			}
		);
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
                        <td width="150" valign="top"><? include (DOMAIN_PATH.'menu-lateral.php') ?></td>
                        <td valign="top">
                            <table width="100%" border="0" cellspacing="6" cellpadding="0">
                                <tr>
                                    <td height="25">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><? include("barra.php")?></td>
                                </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                    <?
									if(!empty($_SESSION["msg_index"] ))
									{?>
                                    <table width="830" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="text_bold_vermelho" style="text-align:center; font-size:14px;" height="50" valign="middle"><?=$_SESSION["msg_index"] ?></td>
                                        </tr>
                                    </table>
                                    <?
                                    }
									?>
					<?php
			/*$sqlMenus="select * from menus order by nome asc";
				$rsMenus = $DB->Execute($sqlMenus);
				while(!$rsMenus->EOF)
				{
					$tdTitulo .= '<td align="center" class="text_bold_preto">'.$rsMenus->fields['nome'].'</td>'."\r\r\n";
					$tdConteudo .= '<td align="center" class="text_bold_preto"><a href="configure.php?'.$linkbase.geraSenha($rsMenus->fields['id']).'">Configurar</a></td>'."\r\r\n";
					$rsMenus->MoveNext();
				}*/
?>
               <table width="830" border="0" cellspacing="0" cellpadding="2" style="margin-top:50px;">
					<tr>
                    	<td width="730" align="center" class="text_bold_vermelho"><?=strtoupper($rs->fields['nome'])?></td>
				        <td width="92" align="center" class="text_bold_vermelho"><a href="javascript:history.back();">VOLTAR</a></td>
					</tr>
				</table>
                
                <table width="383" border="0" cellspacing="0" cellpadding="2" style="margin-top:20px;">
<tr>
                    	<td width="304" align="center" class="text_bold_preto">Atalhos</td>
                        <!--<td width="129" align="center" class="text_bold_preto">Empresas</td>-->
                  <?
                       /* if($rs->fields['tipo']==0)
						{*/
						?>
                        <td width="518" align="center" class="text_bold_preto">Administra&ccedil;&atilde;o</td>
                    <?=$tdTitulo?>
                        <?
                        //}
						?>
				    </tr>
					<tr>
					  <td align="center" class="text_bold_preto"><a href="configure.php?<?=$linkbase?>">Visualizar</a></td>
                     <!-- <td align="center" class="text_bold_preto"><a href="configure.php?<?=$linkbase.geraSenha('0a')?>">Configurar</a></td>-->
                      <?
                        /*if($rs->fields['tipo']==0)
						{*/
						?>
                    <td align="center" class="text_bold_preto"><a href="configure.php?<?=$linkbase.geraSenha('0b')?>">Configurar</a></td>
                      <?=$tdConteudo?>
                      <?
                      //  }
						?>
				    </tr>
				</table>
                
                
                <?
                if(empty($secaoPermissao))
				{
				?>
                <table width="830" border="0" cellspacing="0" cellpadding="2" style="margin-top:20px;">
					<tr>
                    	<td class="text_bold_vermelho" align="center">ATALHOS</td>
				    </tr>
					<? 	if($rs->fields['tipo']==0) { ?>
                    <!--<tr>
					  <td class="text_bold_preto" align="center"><a href="configure.php?<?=$linkbase.geraSenha('0c')?>">Remover todas as permiss&otilde;es desse usu&aacute;rio dessa Empresa</a></td>
				    </tr>-->
                    <? } ?>
					<tr>
					  <td class="text_bold_preto" align="center">
                      	<? 	if($rs->fields['tipo']==0) { ?>
                        		<a href="configure.php?<?=$linkbase.geraSenha('0d')?>">Atribuir  permiss&atilde;o de SUPER USU&Aacute;RIO</a> <? } 
							else {?>
                        		<a href="configure.php?<?=$linkbase.geraSenha('0e')?>">REMOVER  permiss&atilde;o de SUPER USU&Aacute;RIO</a>
                        <? 	} ?>
                        </td>
				    </tr>
					<tr>
					  <td class="text_bold_preto" align="center">&nbsp;</td>
				    </tr>
				</table>
				<?
                }
				else
				//if(!empty($secaoPermissao))
				{
				?>
				<table width="830" border="0" cellspacing="0" cellpadding="2" style="margin-top:20px;">
					<tr>
                    	<td class="text_bold_vermelho" align="center">Setando as permiss&otilde;es de <?=$secao?></td>
				    </tr>
					<tr>
					  <td class="text_bold_preto" align="center">
                      
                        <table width="444" border="0" cellspacing="4" cellpadding="2">
                            <tr class="text_titulo-roxo">
                                <td width="172" class="text_bold_preto">Tabelas</td>
                                <td class="text_titulo">&nbsp;</td>
                            </tr>
						  	<? 
                              // vou determinar onde sera a consulta
							  // se for diferente de 8 eu faco a pesquisa em secoes, se for = 8 faco a pesquisa em tabelas
							/*	if($menu_id == '0a')
								{
									$sql="select * from empresas order by nome asc";
									$tabelapermissoes = 'usuarioempresa';
									$tabelaPermissoesInt = 3;
									$campoPermissao = 'empresa_id';
								}
								else */
								if($menu_id == "0b")
								{
									//$campoCriterio = 'and id<>28 and  id<>29 and id<>1';
									$sql="select * from tabelas where status = 1 $campoCriterio order by tipo, nome asc";
									$tabelapermissoes = 'usuariotabelas';
									$tabelaPermissoesInt = 2;
									$campoPermissao = 'tabela_id';
									
								}
								
                              $linha = $DB->Execute($sql);
                              while (!$linha->EOF)
                              {
                                $nometabela=$linha->fields['nome'];	
                                $idt=$linha->fields[0];
                                
								if($tabelaPermissoesInt==3) 
	                                $sqlp="select * from $tabelapermissoes where $campoPermissao=$idt and usuario_id=$id";
								else 
									$sqlp="select * from $tabelapermissoes where $campoPermissao=$idt and usuario_id=$id ";
                                $linhap = $DB->Execute($sqlp);
                                $idp= (int)$linhap->fields['id'];
                                $permissao=$linhap->fields['permissao'];
                                
                                
                                $class01 = $class02 = $class03 = $class04 = '';
                                if (empty($permissao))
                                {
                                    $class01 = 'linkMenu';
                                }
                                else if ($permissao == 1)
                                    $class02 = 'linkMenu';
                                else if ($permissao == 2)
                                    $class03 = 'linkMenu';
                                else if ($permissao == 3)
                                    $class04 = 'linkMenu';
                                ?>
                              <tr>
                                <td class="text_padrao"><? echo $nometabela?> </td>
                                <td>
                                    <div id="status<?=$idt?>">
                                        <?
                                       	// se a $tabelaPermissoesInt = 3 mostro apenas duas opcoes. Tem acesso ou nao tem acessso a empresa
									    if($tabelaPermissoesInt==3)
										{
											?>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,0,<?=$tabelaPermissoesInt?>);" class="<?=$class01?>">Sem Acesso</a>
                                                </td>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,3,<?=$tabelaPermissoesInt?>);" class="<?=$class04?>">Com Acesso</a>
                                                </td>
                                            </tr>
                                        </table>
                                            <?
										}
										else
										{
										?>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,0,<?=$tabelaPermissoesInt?>);" class="<?=$class01?>">Sem Acesso</a>
                                                </td>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,1,<?=$tabelaPermissoesInt?>);" class="<?=$class02?>">Ler</a>
                                                </td>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,2,<?=$tabelaPermissoesInt?>);" class="<?=$class03?>">Ler e Escrever</a>
                                                </td>
                                                <td align="center" class="texto">
                                                    <a href="javascript:alterastatus(<?=$idp?>,<?=$id?>,<?=$idt?>,3,<?=$tabelaPermissoesInt?>);" class="<?=$class04?>">Total</a>
                                                </td>
                                            </tr>
                                        </table>
                                        <?
                                        }
										?>
                                    </div>
                                </td>
                                </tr>
                                <?		$linha->MoveNext();
                                    }
                                  
                                    ?>
                              </table>
                      
                      </td>
				    </tr>
					<tr>
					  <td class="text_bold_preto" align="center">&nbsp;</td>
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
