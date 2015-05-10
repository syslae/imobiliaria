<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
				<thead>
					<tr>
						<th width="57">Acoes</th> 
	                    <th>Produto_id</th> 
	                    <th>Transferencia_id</th> 
	                    <th>Setor_id</th> 
	                    <th>Tipo_requisicao_id</th> 
	                    <th>Situacao_requisicao_id</th> 
	                    <th>Saida_id</th> 
	                    <th>Tombo_id</th> 
	                    <th>Unidade_medida_id</th> 
	                    <th>Prioridade_id</th> 
	                    <th>Requisicao_id</th> 
	                    <th>Entrada_id</th> 
	                    <th>Quantidade_autorizada</th> 
	                    <th>Quantidade_final</th> 
	                    <th>Descricao_produto</th> 
	                    <th>Quantidade_requisitada</th> 
	                    <th>Valor_total</th> 
	                    <th>Created</th> 
	                    <th>Status</th> 
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
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'itens\');"  border="0">';
								}
								else
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'itens\');"  border="0">';
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
								if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/pencil.png" border="0" alt="Editar" title="Editar"/></a>&nbsp;&nbsp;';

								if ($_SESSION["permissao_temp"]==3) echo '<!--<a href="deletar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_deletar.gif" border="0" alt="Deletar" title="Deletar" onclick="return confirm(&#039;Voce deseja deletar #'.$id.'?&#039;);" /></a>-->';
							echo '</td>
					
					 
	                            <td class="text_padrao">'.retornaNome('produto', 'descricao', $rs->fields['produto_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('transferencia', 'descricao', $rs->fields['transferencia_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('setor', 'descricao', $rs->fields['setor_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('tipo_requisicao', 'descricao', $rs->fields['tipo_requisicao_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('situacao_requisicao', 'descricao', $rs->fields['situacao_requisicao_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('saida', 'descricao', $rs->fields['saida_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('tombo', 'descricao', $rs->fields['tombo_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('unidade_medida', 'descricao', $rs->fields['unidade_medida_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('prioridade', 'descricao', $rs->fields['prioridade_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('requisicao', 'descricao', $rs->fields['requisicao_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('entrada', 'descricao', $rs->fields['entrada_id']).'</td> 
	                            <td class="text_padrao">'.$rs->fields['quantidade_autorizada'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['quantidade_final'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['descricao_produto'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['quantidade_requisitada'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['valor_total'].'</td> 
	                            <td class="text_padrao">'.$rs->UserTimeStamp($rs->fields['created'],'d-m-Y').'</td> 
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

                <table width="830" border="0" cellspacing="0" cellpadding="2">

                    <tr>
                        <td align="center" class="text_padrao">&nbsp;</td>

                        <td width="70"><? botaoRemover()?></td>
                    </tr>
                </table>	
							   