								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Empresa_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("empresa","descricao",$empresa_id?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Numero_contrato:</td>
                                                <td class="text_padrao">
													 <?=$numero_contrato?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data_inicio:</td>
                                                <td class="text_padrao">
													 <?=$data_inicio?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data_final:</td>
                                                <td class="text_padrao">
													 <?=$data_final?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Vigencia:</td>
                                                <td class="text_padrao">
													 <?=$vigencia?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Valor_mensal:</td>
                                                <td class="text_padrao">
													 <?=$valor_mensal?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Volor_total:</td>
                                                <td class="text_padrao">
													 <?=$volor_total?>
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