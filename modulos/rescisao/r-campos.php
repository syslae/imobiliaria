<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                           <tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_descricao)) $class_descricao = 'input_branco'; else $class_descricao = 'input_erro'; ?>
													                           <input name="descricao" type="text" class="<?=$class_descricao?>" id="nome" value="<?=stripslashes($descricao)?>"  size="80" maxlength="80" />
                                                </td>
                                             </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Data</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data)) $class_data= 'input_branco'; else $class_data = 'input_erro'; ?>
                                                    <input name="data" type="text" class="<?=$class_data?>" id="data" value="<?=stripslashes($data)?>"  size="10" maxlength="10"  />

                                                </td>
                                            </tr>


                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Rescisão:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="rescisao"/>
                                                </td>
                                            </tr>
