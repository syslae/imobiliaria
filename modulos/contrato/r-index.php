<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
				<thead>
					<tr>
						<th width="57">Acoes</th> 
	                    <th width="100" >Cliente</th> 
                        <th width="200">Serviço</th> 
	                    <th>Contrato</th> 
	                    <th>Vigência</th> 
	                    <th>Valor Mensal</th> 
	                    <th>Valor Total</th> 
                        <th>Visualizar</th>
	                    <th width="68">Del</th>
					
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
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'contrato\');"  border="0">';
								}
								else
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'contrato\');"  border="0">';
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

					
								if ($_SESSION["permissao_temp"]>1) echo '<a href="atualizar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_editar.png" border="0" alt="Editar" title="Editar" width="23" /></a>&nbsp;&nbsp;';

								if ($_SESSION["permissao_temp"]==3) echo '<!--<a href="deletar.php?id='.$id.'"><img src="../../webroot/img_sistema/icon_deletar.gif" border="0" alt="Deletar" title="Deletar" onclick="return confirm(&#039;Voce deseja deletar #'.$id.'?&#039;);" /></a>-->';
							echo '</td>
					
					 
	                            <td class="text_padrao">'.TrazerNome($rs->fields['cliente_id']).'</td> 
	                            <td class="text_padrao">'.retornaNome('servico','descricao',$rs->fields['servico_id']).'</td> 
	                            <td class="text_padrao">'.$rs->fields['numero_contrato'].'</td> 
	                            <td class="text_padrao">'.$rs->UserTimeStamp($rs->fields['data_final'],'d-m-Y').'</td> 
	                            <td class="text_padrao">'.$rs->fields['valor_mensal'].'</td> 
	                            <td class="text_padrao">'.$rs->fields['volor_total'].'</td> 
                                 <td class="text_padrao"><a href="../../modulos/contrato/upload.php?id='.$rs->fields['id'].'&height=30&width=550&keepThis=true&TB_iframe=true" title="Contrato" class="thickbox"" target="_blank"><img src="../../webroot/img_sistema/anexo.png" border="0"></a>     
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
							   