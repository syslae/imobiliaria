
											<!--<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id="id" value="<?=$id?>"  size="3" maxlength="11" />
                                                    <? /*echo $empresas = retornaCheckboxempresas($id, $empresa_id,2);*/?>
                                                </td>
                                            </tr>-->
                                           <input name="id" type="hidden" class="<?=$class_id?>" id="id" value="<?=$id?>"  size="3" maxlength="11" />
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome)) $class_nome = 'input_branco'; else $class_nome = 'input_erro'; ?>
													<input name="nome" type="text" class="<?=$class_nome?>" id="nome" value="<?=stripslashes($nome)?>"  size="60" maxlength="200" onKeyUp="ContaCaracteresCampo('nome', 'nomeT', 200);" />
                                                    <input name="nomeT" type="text" disabled class="input_caracteres" id="nomeT" value="200" size="1" style="width:20px" />                                                </td>
                                            </tr>
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Descrição</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_descricao)) $class_descricao = 'input_branco'; else $class_descricao = 'input_erro'; ?>
													<input name="descricao" type="text" class="<?=$class_descricao?>" id="descricao" value="<?=stripslashes($descricao)?>"  size="60" maxlength="200" onKeyUp="ContaCaracteresCampo('descricao', 'descricaoT', 200);" />
                                                    <input name="descricaoT" type="text" disabled class="input_caracteres" id="descricaoT" value="200" size="1" style="width:20px" />                                                </td>
                                            </tr>
											
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Administrador</td>
                                                <td class="text_padrao">
                                                    <?=checkbox('tipo', $tipo)?>
	                                            </td>
                                            </tr>
                                            	
                                         
                                            
                                       
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="status" value="1" <? if($status==1) echo "checked";?> />                                                </td>
                                            </tr>
