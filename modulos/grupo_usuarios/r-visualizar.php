
											
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
													 <?=$nome?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Descrição</td>
                                                <td class="text_padrao">
													 <?=$descricao?>
                                                </td>
                                            </tr>
											
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <? if($status==1) echo "Ativo"; else echo "N&atilde;o ativo";?>
                                                </td>
                                            </tr>