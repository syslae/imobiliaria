<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                            <tr id="nome_fisica">
                                                <td height="36" align="right" class="text_bold_preto">Descri��o</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_descricao)) $class_descricao = 'input_branco'; else $class_descricao = 'input_erro'; ?>
													<input name="descricao" type="text" class="<?=$class_descricao?>" id="nome" value="<?=stripslashes($descricao)?>"  size="80" maxlength="80" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cart�o CNPJ</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="cartao_cnpj"/>
                                                </td>
                                            </tr>
                                            
                                    
	                            		