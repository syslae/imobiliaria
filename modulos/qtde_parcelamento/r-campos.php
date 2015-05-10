<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Qtde de vezes</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_qtde_vezes)) $class_qtde_vezes = 'input_branco'; else $class_qtde_vezes = 'input_erro'; ?>
													<input name="qtde_vezes" type="text" class="<?=$class_qtde_vezes?>" id="qtde_vezes" value="<?=stripslashes($qtde_vezes)?>"  size="11" maxlength="11" onkeypress="Mascara(this,mascSoNumeros)" />
                                               </td>
                                            </tr> 
	                            		   <tr>
                                                <td height="36" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="status" value="1" <? if($status==1) echo "checked";?> />
                                                </td>
                                            </tr>