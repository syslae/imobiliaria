								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Motivo:</td>
                                                <td class="text_padrao">
													 <?=$motivo?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Usuário:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("usuarios","nome",$usuario_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cód. Parcela:</td>
                                                <td class="text_padrao">
													 <?=$nosso_numero?>
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