<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                          <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cliente</td>
                                                 <td class="text_padrao">
                                                    <?
													
													$dados = array('primary_key' => 'id', 
													'nome' => 'nome',
                                                    'nome2'=>'nome_fantasia', 
													'tabela' => 'cliente', 
													'condicao' => "where status=1 and espaco_fisico_id='".$_SESSION["espaco_fisico_id"]."' order by nome_fantasia asc", 
													'nome_input' => 'cliente_id', 
													'id' => 'sle', 
													'class' => 'select',
                                                    'value' => $cliente_id);	
													geraSelectNomeFantasia($dados);
													?>
	                                            </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Contrato</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_numero_contrato)) $class_numero_contrato = 'input_branco'; else $class_numero_contrato = 'input_erro'; ?>
													<input name="numero_contrato" type="text" class="<?=$class_numero_contrato?>" id="numero_contrato" value="<?=stripslashes($numero_contrato)?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('numero_contrato', 'numero_contratoT', 20);" />
                                                    <input name="numero_contratoT" type="text" disabled class="input_caracteres" id="numero_contratoT" value="20" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                           <tr>
                                                <td height="36" align="right" class="text_bold_preto">Serviço</td>
                                                <td class="text_padrao">
                                                      <?
												    $dados = array('primary_key' => 'id', 
													'nome' => 'descricao', 
													'tabela' => 'servico', 
													'condicao' => 'where espaco_fisico_id= "'.$_SESSION["espaco_fisico_id"].'" ORDER BY descricao', 
													'nome_input' => 'servico_id', 													
													'onchange' => '', 
													'value' => $servico_id);	
													geraSelect($dados);
												 ?>
                                                </td>
                                            </tr>  
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Data inicio</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_inicio)) $class_data_inicio = 'input_branco'; else $class_data_inicio = 'input_erro'; ?>
													<input name="data_inicio" type="text" class="<?=$class_data_inicio?>" id="data_inicio" value="<?=stripslashes($data_inicio)?>"  size="10" maxlength="10"  />
                                       
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Vigência até</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_final)) $class_data_final = 'input_branco'; else $class_data_final = 'input_erro'; ?>
													<input name="data_final" type="text" class="<?=$class_data_final?>" id="data_final" value="<?=stripslashes($data_final)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('data_final', 'data_finalT', 10);" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor Mensal R$</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_valor_mensal)) $class_valor_mensal = 'input_branco'; else $class_valor_mensal = 'input_erro'; ?>
													<input name="valor_mensal" type="text" class="<?=$class_valor_mensal?>" id="valor_mensal" value="<?=stripslashes($valor_mensal)?>"  size="12" maxlength="12"  onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
                                                    
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor Total R$</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_volor_total)) $class_volor_total = 'input_branco'; else $class_volor_total = 'input_erro'; ?>
													<input name="volor_total" type="text" class="<?=$class_volor_total?>" id="volor_total" value="<?=stripslashes($volor_total)?>"  size="12" maxlength="12" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
                                                    
                                                </td>
                                            </tr>
           	                               <tr>
                                                <td height="36" align="right" class="text_bold_preto">Situação: </td>
                                                <td class="text_padrao">
                                                    <input type="radio" name="status" value="1" <? if($status==1) echo "checked";?> />
                                                     Ativo
                                                    <input type="radio" name="status" value="0" <? if($status==0) echo "checked";?> />
                                                    Inativo
                                                </td>
                                             <tr>
                                                <td height="36" align="right" class="text_bold_preto">Contrato:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="1"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-1:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="2"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-2:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="3"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-3:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="4"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-4:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="5"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-5:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="6"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-6:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="7"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-7:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="8"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-8:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="9"/>
                                                </td>
                                            </tr>
                                                <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-9:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="10"/>
                                                </td>
                                            </tr>
                                                 <tr>
                                                <td height="36" align="right" class="text_bold_preto">Aditivo-10:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="11"/>
                                                </td>
                                            </tr>