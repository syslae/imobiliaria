								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Produto_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("produto","descricao",$produto_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Transferencia_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("transferencia","descricao",$transferencia_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Setor_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("setor","descricao",$setor_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Tipo_requisicao_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("tipo_requisicao","descricao",$tipo_requisicao_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Situacao_requisicao_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("situacao_requisicao","descricao",$situacao_requisicao_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Saida_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("saida","descricao",$saida_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Tombo_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("tombo","descricao",$tombo_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Unidade_medida_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("unidade_medida","descricao",$unidade_medida_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Prioridade_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("prioridade","descricao",$prioridade_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Requisicao_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("requisicao","descricao",$requisicao_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Entrada_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("entrada","descricao",$entrada_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Quantidade_autorizada:</td>
                                                <td class="text_padrao">
													 <?=$quantidade_autorizada?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Quantidade_final:</td>
                                                <td class="text_padrao">
													 <?=$quantidade_final?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Descricao_produto:</td>
                                                <td class="text_padrao">
													 <?=$descricao_produto?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Quantidade_requisitada:</td>
                                                <td class="text_padrao">
													 <?=$quantidade_requisitada?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Valor_total:</td>
                                                <td class="text_padrao">
													 <?=$valor_total?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Created:</td>
                                                <td class="text_padrao">
													 <?=$created?>
                                                </td>
                                            </tr> 
	                            		    <tr>
                                                <td height="24" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <? if($status==1) echo "Ativo"; else echo "N&atilde;o ativo";?>
                                                </td>
                                            </tr>