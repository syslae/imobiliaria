								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Usuario_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("usuario","descricao",$usuario_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Espaco_fisico_id:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("espaco_fisico","descricao",$espaco_fisico_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Descricao:</td>
                                                <td class="text_padrao">
													 <?=$descricao?>
                                                </td>
                                            </tr> 
                                             <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data Validade:</td>
                                                <td class="text_padrao">
													 <?=$data_validade?>
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