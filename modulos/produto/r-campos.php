<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Descrição</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_descricao)) $class_descricao = 'input_branco'; else $class_descricao = 'input_erro'; ?>
													<input name="descricao" type="text" class="<?=$class_descricao?>" id="descricao" value="<?=stripslashes($descricao)?>"  size="80" maxlength="80" onKeyUp="ContaCaracteresCampo('descricao', 'descricaoT', 80);" />
                                                    <input name="descricaoT" type="text" disabled class="input_caracteres" id="descricaoT" value="80" size="1" style="width:20px" />
                                                </td>
                                            </tr>

                                            <!--<tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor R$</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_valor)) $class_valor = 'input_branco'; else $class_valor = 'input_erro'; ?>
                                                    <input name="valor" type="text" class="<?=$class_valor?>" id="valor" value="<?=stripslashes($valor)?>"  size="12" maxlength="12"  onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
                                                    
                                                </td>
                                            </tr>-->
                                                <tr>
                                                    <td height="40"></td>
                                                </tr>
                                                <tr height="36">
                                                    <td height="36" align="right" class="text_bold_preto"></td>
                                                    <td class="text_padrao" id="add_estoques">
                                                        <a href="javascript:;" onclick="adicionarFilhoEstoque();" class="" >ADICIONAR ESTOQUE</a>
                                                    </td>
                                                </tr>
<tr>
                                                <!--<td height="36" align="right" class="text_bold_preto"></td>-->
                                                <td class="text_padrao" id="add_filhos_estoque" colspan="2">
                                                    <div id="filhos_estoque">
                                                        <?=retornaFilhosEstoque($estoque_id,$codigo,$estoque,$valor_estoque,$status_estoque);?>
                                                    </div>
                                                    <input type="hidden" id="qtd_filhos_estoque" value="<? echo (int) $qtd_filhos_estoques?>" name="qtd_filhos_estoque" />
                                                </td>
                                            </tr>
	                                    