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
													'condicao' => "where status=1 and espaco_fisico_id='".$_SESSION["espaco_fisico_id"]."' order by nome asc", 
													'nome_input' => 'cliente_id', 
													'id' => 'sle', 
													'class' => 'select',
                                                    'value' => $cliente_id);	
													geraSelectNomeFantasia($dados);
													?>
	                                            </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Servico</td>
                                                 <td class="text_padrao">
                                                    <?
													
													$dados = array('primary_key' => 'id', 
													'nome' => 'descricao', 
													'tabela' => 'servico', 
													'condicao' => 'where status=1 order by descricao asc', 
													'nome_input' => 'servico_id', 
													'id' => 'sle', 
													'class' => 'select', 
													'value' => $servico_id);	
													
													geraSelect($dados);
													
													?>
	                                            </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Situacao pagamento</td>
                                                 <td class="text_padrao">
                                                    <?
													
													$dados = array('primary_key' => 'id', 
													'nome' => 'descricao', 
													'tabela' => 'situacao_pagamento', 
													'condicao' => 'where status=1 order by descricao asc', 
													'nome_input' => 'situacao_pagamento_id', 
													'id' => 'sle', 
													'class' => 'select', 
													'value' => $situacao_pagamento_id);	
													
													geraSelect($dados);
													
													?>
	                                            </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Numero nota empenho</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_numero_nota_empenho)) $class_numero_nota_empenho = 'input_branco'; else $class_numero_nota_empenho = 'input_erro'; ?>
													<input name="numero_nota_empenho" type="text" class="<?=$class_numero_nota_empenho?>" id="numero_nota_empenho" value="<?=stripslashes($numero_nota_empenho)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('numero_nota_empenho', 'numero_nota_empenhoT', 50);" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Nf</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nf)) $class_nf = 'input_branco'; else $class_nf = 'input_erro'; ?>
													<input name="nf" type="text" class="<?=$class_nf?>" id="nf" value="<?=stripslashes($nf)?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('nf', 'nfT', 20);" />
                                                </td>
                                            </tr> 
	                                   
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Data pagamento</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_pagamento)) $class_data_pagamento = 'input_branco'; else $class_data_pagamento = 'input_erro'; ?>
													<input name="data_pagamento" type="text" class="<?=$class_data_pagamento?>" id="data_pagamento" value="<?=stripslashes($data_pagamento)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('data_pagamento', 'data_pagamentoT', 10);" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Mês / Ano Referência</td>
                                                <td class="text_padrao">
                                                    
                                                     <?
													
													$dados = array('primary_key' => 'id', 
													'nome' => 'mes',
                                                  	'tabela' => 'meses', 
													'condicao' => "order by id asc", 
													'nome_input' => 'mes_emissao', 
													'id' => 'sle', 
													'class' => 'select',
                                                    'value' => $mes_emissao);	
													geraSelect($dados);
													$dados = array('primary_key' => 'id', 
													'nome' => 'ano',
                                                  	'tabela' => 'ano', 
													'condicao' => "order by ano desc", 
													'nome_input' => 'ano_emissao', 
													'id' => 'sle', 
													'class' => 'select',
                                                    'value' => $ano_emissao);	
													geraSelect($dados);
											
                                                    ?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">N pd</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_n_pd)) $class_n_pd = 'input_branco'; else $class_n_pd = 'input_erro'; ?>
													<input name="n_pd" type="text" class="<?=$class_n_pd?>" id="n_pd" value="<?=stripslashes($n_pd)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('n_pd', 'n_pdT', 50);" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_valor)) $class_valor = 'input_branco'; else $class_valor = 'input_erro'; ?>
													<input name="valor" type="text" class="<?=$class_valor?>" id="valor" value="<?=stripslashes($valor)?>"  size="15" maxlength="12"  onKeyPress="return(MascaraMoeda(this,'.',',',event))" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Data nota</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_nota)) $class_data_nota = 'input_branco'; else $class_data_nota = 'input_erro'; ?>
													<input name="data_nota" type="text" class="<?=$class_data_nota?>" id="data_nota" value="<?=stripslashes($data_nota)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('data_nota', 'data_notaT', 10);" />
                                                </td>
                                            </tr> 