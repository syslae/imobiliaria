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
                                                <td height="36" align="right" class="text_bold_preto">Data Início</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_inicio)) $class_data_inicio= 'input_branco'; else $class_data_inicio = 'input_erro'; ?>
                                                    <input name="data_inicio" type="text" class="<?=$class_data_inicio?>" id="data_inicio" value="<?=stripslashes($data_inicio)?>"  size="10" maxlength="10"  />

                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Data Fim</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_fim)) $class_data_fim= 'input_branco'; else $class_data_fim = 'input_erro'; ?>
                                                    <input name="data_fim" type="text" class="<?=$class_data_fim?>" id="data_fim" value="<?=stripslashes($data_fim)?>"  size="10" maxlength="10"  />

                                                </td>
                                            </tr>


                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Férias:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="ferias"/>
                                                </td>
                                            </tr>
