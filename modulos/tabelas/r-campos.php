<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">tabela_id</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tabela_id)) $class_tabela_id = 'input_branco'; else $class_tabela_id = 'input_erro'; ?>
													<input name="tabela_id" type="text" class="<?=$class_tabela_id?>" id="tabela_id" value="<?=stripslashes($tabela_id)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('tabela_id', 'tabela_idT', 10);" />
                                                    <input name="tabela_idT" type="text" disabled class="input_caracteres" id="tabela_idT" value="10" size="1" style="width:20px" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">menu_id</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_menu_id)) $class_menu_id = 'input_branco'; else $class_menu_id = 'input_erro'; ?>
													<input name="menu_id" type="text" class="<?=$class_menu_id?>" id="menu_id" value="<?=stripslashes($menu_id)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('menu_id', 'menu_idT', 10);" />
                                                    <input name="menu_idT" type="text" disabled class="input_caracteres" id="menu_idT" value="10" size="1" style="width:20px" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">nome</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome)) $class_nome = 'input_branco'; else $class_nome = 'input_erro'; ?>
													<input name="nome" type="text" class="<?=$class_nome?>" id="nome" value="<?=stripslashes($nome)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('nome', 'nomeT', 50);" />
                                                    <input name="nomeT" type="text" disabled class="input_caracteres" id="nomeT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">tipo</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tipo)) $class_tipo = 'input_branco'; else $class_tipo = 'input_erro'; ?>
													<input name="tipo" type="text" class="<?=$class_tipo?>" id="tipo" value="<?=stripslashes($tipo)?>"  size="1" maxlength="1" onKeyUp="ContaCaracteresCampo('tipo', 'tipoT', 1);" />
                                                    <input name="tipoT" type="text" disabled class="input_caracteres" id="tipoT" value="1" size="1" style="width:20px" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">pasta</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_pasta)) $class_pasta = 'input_branco'; else $class_pasta = 'input_erro'; ?>
													<input name="pasta" type="text" class="<?=$class_pasta?>" id="pasta" value="<?=stripslashes($pasta)?>"  size="100" maxlength="100" onKeyUp="ContaCaracteresCampo('pasta', 'pastaT', 100);" />
                                                    <input name="pastaT" type="text" disabled class="input_caracteres" id="pastaT" value="100" size="1" style="width:20px" />
                                                </td>
                                            </tr> 
	                            		   <tr>
                                                <td height="36" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="status" value="1" <? if($status==1) echo "checked";?> />
                                                </td>
                                            </tr>