<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
				<thead>
					<tr>
						<th width="57">A��es</th> 
	                    <th>Codigo</th> 
                        <th>Descri��o</th> 
                        <th>Logradouro</th> 
	                    <th>Telefone</th> 
	                    <th>Pessoa contato</th> 
                        <th>Email</th> 
                         <th width="68" style="text-align:center">Deletar</th>
					
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
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'cliente\');"  border="0">';
								}
								else
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'cliente\');"  border="0">';
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
					
							# Fundo da C�lula

							$x = $x + 1;   

							$div = $x % 2; 

							if ($div != 0) $bg = $GLOBALS["bg1"]; else $bg = $GLOBALS["bg2"];

							# fim Fundo da C�lula

							echo '

							<tr bgcolor="'.$bg.'">

								<td align="center">';

								#if (!empty($_SESSION["permissao_temp"])) echo '<a href="visualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_visualizar.gif" border="0" alt="Visualizar" title="Visualizar" /></a>&nbsp;&nbsp;';
								if (!empty($_SESSION["permissao_temp"])) echo '<a href="visualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/magnifier.png" border="0" alt="Visualizar" title="Visualizar" /></a>&nbsp;&nbsp;';

								#if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_editar.png" border="0" alt="Editar" title="Editar" width="23" /></a>&nbsp;&nbsp;';
								if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/pencil.png" border="0" alt="Editar" title="Editar" /></a>&nbsp;&nbsp;';
								
								if ($_SESSION["permissao_temp"]==3) echo '<!--<a href="deletar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_deletar.gif" border="0" alt="Deletar" title="Deletar" onclick="return confirm(&#039;Voce deseja deletar #'.$id.'?&#039;);" /></a>-->';
							echo '</td>
					
					            <td class="text_padrao">'.$rs->fields['id'].'</td> 
	                            <td class="text_padrao">'.TrazerNome($rs->fields['id']).'</td> 
                                <td class="text_padrao">'.$rs->fields['logradouro'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['telefone'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['pessoa_contato'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['email'].'</td> 
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

                <table width="830" border="0" cellspacing="0" cellpadding="2" style="margin-left:10px;">
					
                    <tr>
                        <td align="center" class="text_padrao">&nbsp;</td>

                        <td width="70" align="right"><? botaoRemover()?></td>
                    </tr>
                </table>	
							   