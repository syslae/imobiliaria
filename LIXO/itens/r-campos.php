<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Produto</td>
                                                 <td class="text_padrao">
                                                 
                                                    <input name="produto" type="text" class="input_branco" id="produtos" value="<?=stripslashes($produto)?>"  size="40" maxlength="40" onblur="UnidadeMedida('unidade_medida_id','unidade_medida','descricao')"  />
                                                  
	                                            </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Unidade medida</td>
                                                 <td class="text_padrao"><span id="unidade_medida_id">
                                                     <?
													$dados = array('primary_key' => 'id', 
													'primary_key2' => 'medida_basica_id', 
													'nome' => 'descricao', 
													'nome2' => 'quantidade', 
													'tabela' => 'unidade_medida', 
													'tabela2' => 'medida_basica',
													'condicao' => 'where status=1 order by descricao asc', 
													'nome_input' => 'unidade_medida_id', 
													'id' => 'unidade_medida_id', 
													'class' => 'select', 
													'value' => $unidade_medida_id);	
													geraSelectSaida($dados);
													echo "</span>";
													?>
	                                            </td>
                                            </tr>  
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Quantidade</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_quantidade_final)) $class_quantidade_final = 'input_branco'; else $class_quantidade_final = 'input_erro'; ?>
													<input name="quantidade_final" type="text" class="<?=$class_quantidade_final?>" id="quantidade_final" value="<?=stripslashes($quantidade_final)?>"  size="4" maxlength="4"  />
                                                
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_valor_total)) $class_valor_total = 'input_branco'; else $class_valor_total = 'input_erro'; ?>
													<input name="valor_total" type="text" class="<?=$class_valor_total?>" id="valor_total" id="valor_total"size="15" maxlength="15" OnKeyPress="return(FormataReais(this,'.',',',event))"/>
                                                   
                                                </td>
                                            </tr> 
	                       		