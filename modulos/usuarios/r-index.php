
                <table width="757" id="box-table-a"  border="0" cellspacing="0" cellpadding="2">
                <thead>
                    <tr>
                        <th  align="left" width="87">Acoes</th>
                        <!--<th class="text_bold_preto" align="left">Id</th>-->
                        <th width="85" align="left" >Nome</th>
                        <th width="76" align="left" >Login</th>
                        <th  align="left">Grupo de usu&aacute;rio</th>
                        <th width="95" align="left" >Celular</th>
                        <!--<th class="text_bold_preto" align="left">Foto</th>-->
                        <th width="122" align="left" >Ultimo acesso</th>
                        <th width="100" style="text-align:center" >Acessos</th>
                        <th width="70" style="text-align:center">Status</th>
                        <th width="auto" style="text-align:center">Deletar</th>
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
							// campos permitidos ou nao para atualizar
							if (($_SESSION["permissao_temp"]>1))
							{
								$campo1 = '<a href = "atualizar.php?id='.$rs->fields['id'].'" title="'.$rs->fields['nome'].'" alt="'.$rs->fields['nome'].'">'.$rs->fields['nome'].'</a>';
																
								if (!empty($rs->fields['status']))
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'usuarios\');"  border="0">';
								}
								else
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'usuarios\');"  border="0">';
								}
								
								
							}
							else
							{
								$campo1 = '<a href = "javascript:;" title="'.$rs->fields['nome'].'">'.$rs->fields['nome'].'</a>';
								
								if ($rs->fields['status']==0) 
									$status='<img src="../../webroot/img_sistema/bola-vermelha.gif">';	
								else
									$status='<img src="../../webroot/img_sistema/bola-verde.gif">';
							}
							
							if (empty($rs->fields['foto']))
								$miniatura='- - - -';
							else
								$miniatura='<a href="'.URL.'/webroot/img/'.$tabela.'/'.$rs->fields['foto'].'" rel="lightbox"><img src="'.URL.'/webroot/img/'.$tabela.'/'.$rs->fields['foto'].'" height=50 border=0></a>';
							

							# Fundo da Célula
							$x = $x + 1;   
							$div = $x % 2; 
							if ($div != 0) $bg = $GLOBALS["bg1"]; else $bg = $GLOBALS["bg2"];
							# fim Fundo da Célula
							
							echo '
							<tr bgcolor="'.$bg.'">
								<td align="center">';
								#if (!empty($_SESSION["permissao_temp"])) echo '<a href="visualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_visualizar.gif" border="0" alt="Visualizar" title="Visualizar" /></a>&nbsp;&nbsp;';
								if (!empty($_SESSION["permissao_temp"])) echo '<a href="visualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/magnifier.png" border="0" alt="Visualizar" title="Visualizar" /></a>&nbsp;&nbsp;';
								
								#if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_editar.png" border="0" alt="Editar" title="Editar" width="23" /></a>&nbsp;&nbsp;';
								if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/pencil.png" border="0" alt="Editar" title="Editar" /></a>&nbsp;&nbsp;';
								
								if ($_SESSION["permissao_temp"]==3) echo '<!--<a href="deletar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_deletar.gif" border="0" alt="Deletar" title="Deletar" onclick="return confirm(&#039;Voce deseja deletar #'.$id.'?&#039;);" /></a>-->';
								echo '</td>
								<!--<td class="text_padrao">'.$rs->fields['id'].'</td>-->
								<td class="text_padrao">'.$rs->fields['nome'].'</td>
								<td class="text_padrao">'.$rs->fields['login'].'</td>
								<td class="text_padrao">'.retornaNome("grupo_usuarios","nome",$rs->fields['grupo_id']).'</td>
								<td class="text_padrao">'.$rs->fields['celular'].'</td>
								<!--<td class="text_padrao">'.$miniatura.'</td>-->
								<td class="text_padrao">';
													
									if(!empty($rs->fields['ultimoacesso']) and $rs->fields['ultimoacesso']<>"    -  -     :  :  " and $rs->fields['ultimoacesso']<>NULL)
									{
										echo $rs->UserTimeStamp($rs->fields['ultimoacesso'],'d-m-Y H:i:s');
									}
									
									echo '
								</td>
								<td class="text_padrao" align="center">'.$rs->fields['acessos'].'</td>
								<td align="center"><div id="div-'.$posicao.'">'.$status.'</div></td>
								<td align="center">'; botaoCheckbox($rs->fields['id']);echo '&nbsp;</td>
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

<table width="756" border="0" cellspacing="0" cellpadding="2" style="margin-left:10px;">
<tr>
                        <td width="728" align="center" class="text_padrao">&nbsp;</td>
                        <td width="41"><? botaoRemover()?></td>
  </tr>
                </table>	