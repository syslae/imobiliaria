<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
				<thead>
					<tr>
                        <th >Id</th>
						<th >NossoNumero</th>
                        <th width="57"><span title="Movimentação">Mov.</span></th>
  						<th>Cliente</th>
	                    <th>Ano</th>
                        <th>Parcela</th>
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th>Situação</th>
                        <th>Boleto(s) <input type="checkbox" onclick="marcar_todos('checkbox',this.checked);"></th>
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
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'pedido\');"  border="0">';
								}
								else
								{
									$status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'pedido\');"  border="0">';
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
                                <td align="center">'.$rs->fields['id'].'&nbsp;</td>
								<td align="center">'.$rs->fields['nosso_numero'].'&nbsp;</td>
								<td align="center">'.$rs->fields['movimentacao_id'].'</td>
                                <td class="text_padrao">'.$rs->fields['cliente_id'].' - '.$rs->fields['nome'].'</td>
								<td class="text_padrao">'.$rs->fields['ano'].'</td>
	                            <td class="text_padrao">'.$rs->fields['parcela'].'</td>
                                <td class="text_padrao">'.$rs->UserTimeStamp($rs->fields['data_vencimento'],'d/m/Y').'</td>
                                <td class="text_padrao">R$ '.moeda($rs->fields['valor']).'</td>
	                            <td align="text_padrao">'.$rs->fields['descricao'].'&nbsp;</td>
	                            <td align="center">';
                                   if($rs->fields['situacao_pagamento_id'] == $situacao_pagamento_aberto && !empty($rs->fields['nosso_numero'])) botaoCheckbox($rs->fields['id']);
                                   else echo "<span class='text_bold_vermelho' title='Só pode imprimir boletos em aberto'>NPI</span>";
                            echo '&nbsp;</td>

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

                        <td width="70"><input type="button" name="imprimir" value="Imprimir" class="botao_branco" onclick="imprimir_bol()"/></td>
                    </tr>
                </table>
							   