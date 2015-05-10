                                          <tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                            <tr id="nome_fisica">
                                                <td height="36" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome)) $class_nome = 'input_branco'; else $class_nome = 'input_erro'; ?>
													<input name="nome" type="text" class="<?=$class_nome?>" id="nome" value="<?=stripslashes($nome)?>"  size="80" maxlength="80" />
                                                </td>
                                            </tr>
                                           
                                            <tr id="razao_social_juridica">
                                                <td height="36" align="right" class="text_bold_preto">Razão Social</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_razao_social)) $class_razao_social = 'input_branco'; else $class_razao_social = 'input_erro'; ?>
													<input name="razao_social" type="text" class="<?=$class_razao_social?>" id="razao_social" value="<?=stripslashes($razao_social)?>"  size="80" maxlength="80"  />
                                                </td>
                                            </tr>
                                             <tr id="nome_juridica">
                                                <td height="36" align="right" class="text_bold_preto">Nome Fantasia</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome_fantasia)) $class_nome_fantasia = 'input_branco'; else $class_nome_fantasia = 'input_erro'; ?>
													<input name="nome_fantasia" type="text" class="<?=$class_nome?>" id="nome_fantasia" value="<?=stripslashes($nome_fantasia)?>"  size="20" maxlength="20" />
                                                </td>
                                            </tr>
                                             <tr id="cnpj_juridica">
                                                <td height="36" align="right" class="text_bold_preto">CNPJ</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cnpj)) $class_cnpj = 'input_branco'; else $class_cnpj = 'input_erro'; ?>
													<input name="cnpj" type="text" class="<?=$class_cnpj?>" id="cnpj" value="<?=stripslashes($cnpj)?>" onblur="ValidarCNPJ(form.cnpj)" size="20" maxlength=20" />
                                            </tr>
                                              <tr id="inscricao_estadual">
                                                <td height="36" align="right" class="text_bold_preto">Inscrição Estadual</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_inscricao_estadual)) $class_inscricao_estadual = 'input_branco'; else $class_inscricao_estadual = 'input_erro'; ?>
													<input name="inscricao_estadual" type="text" class="<?=$class_inscricao_estadual?>" id="inscricao_estadual" value="<?=stripslashes($inscricao_estadual)?>"  size="16" maxlength=16" />
                                            </tr>
                                            <tr id="identidade_fisica">
                                                <td height="36" align="right" class="text_bold_preto">Identidade</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_identidade)) $class_identidade = 'input_branco'; else $class_identidade = 'input_erro'; ?>
													<input name="identidade" type="text" class="<?=$class_identidade?>" id="identidade" value="<?=stripslashes($identidade)?>"  size="16" maxlength="16"  />
                                                </td>
                                            </tr> 
	                                        <tr id="cpf_fisica">
                                                <td height="36" align="right" class="text_bold_preto">CPF</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cpf)) $class_cpf = 'input_branco'; else $class_cpf = 'input_erro'; ?>
													<input name="cpf" type="text" class="<?=$class_cpf?>" id="cpf" value="<?=stripslashes($cpf)?>" onblur="ValidarCPF(form.cpf)" size="16" maxlength="16"  />
                                                </td>
                                            </tr> 
                                             <tr id="data_nascimento">
                                                <td height="36" align="right" class="text_bold_preto">Data nascimento</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_data_nascimento)) $class_data_nascimento = 'input_branco'; else $class_data_nascimento = 'input_erro'; ?>
													<input name="data_nascimento" type="text" class="<?=$class_data_nascimento?>" id="data_nascimento_fisico" value="<?=stripslashes($data_nascimento)?>"  size="16" maxlength="16"  />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Logradouro</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_logradouro)) $class_logradouro = 'input_branco'; else $class_logradouro = 'input_erro'; ?>
													<input name="logradouro" type="text" class="<?=$class_logradouro?>" id="logradouro" value="<?=stripslashes($logradouro)?>"  size="80" maxlength="80"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Bairro</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_bairro)) $class_bairro = 'input_branco'; else $class_bairro = 'input_erro'; ?>
													<input name="bairro" type="text" class="<?=$class_bairro?>" id="bairro" value="<?=stripslashes($bairro)?>"  size="30" maxlength="30" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Numero</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_numero)) $class_numero = 'input_branco'; else $class_numero = 'input_erro'; ?>
													<input name="numero" type="text" class="<?=$class_numero?>" id="numero" value="<?=stripslashes($numero)?>"  size="6" maxlength="6" />
                                            
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cep</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cep)) $class_cep = 'input_branco'; else $class_cep = 'input_erro'; ?>
													<input name="cep" type="text" class="<?=$class_cep?>" id="cep" value="<?=stripslashes($cep)?>"  size="16" maxlength="16"  />
                                                  
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Complemento</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_complemento)) $class_complemento = 'input_branco'; else $class_complemento = 'input_erro'; ?>
													<input name="complemento" type="text" class="<?=$class_complemento?>" id="complemento" value="<?=stripslashes($complemento)?>"  size="100" maxlength=""  />
                                                  
                                                </td>
                                            </tr> 
                                            <tr>
                                            	<td height="36" align="right" class="text_bold_preto" >Estado</td>
                                            	<td class="text_padrao">
                                                 <?
												    $dados = array('primary_key' => 'id', 
													'nome' => 'nome', 
													'tabela' => 'estado', 
													'condicao' => 'ORDER BY nome', 
													'nome_input' => 'estado_id', 													
													'onchange' => 'Dados(this.value);', 
													'value' => $estado_id);	
													geraSelect($dados);
												 ?>
                                               
                                                </td>
                                              </tr>  
                                              <tr>
                                              	<td height="36" align="right" class="text_bold_preto">Cidade</td>
                                                <td>  
                                                 <?
    												 if(empty($estado_id)) $estado_id=0;
    												 
    												 $dados = array('primary_key' => 'id', 
    													'nome' => 'nome', 
    													'tabela' => 'cidade', 
    													'condicao' => 'where id_estado = '.$estado_id.' ORDER BY nome', 
    													'nome_input' => 'cidade_id',
    													'id_option'=> 'opcoes',
    													'class' => 'campos', 
    													'value' => $cidade_id);	
    													
    													geraSelect($dados);
												?>
                                                 </td>
                                    		</tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Telefone</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_telefone)) $class_telefone = 'input_branco'; else $class_telefone = 'input_erro'; ?>
													<input name="telefone" type="text" class="<?=$class_telefone?>" id="telefone" value="<?=stripslashes($telefone)?>"  size="16" maxlength="16"  />
                                                    
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Celular</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_celular)) $class_celular = 'input_branco'; else $class_celular = 'input_erro'; ?>
													<input name="celular" type="text" class="<?=$class_celular?>" id="celular" value="<?=stripslashes($celular)?>"  size="16" maxlength="16"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Email</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_email)) $class_email = 'input_branco'; else $class_email = 'input_erro'; ?>
													<input name="email" type="text" class="<?=$class_email?>" id="email" value="<?=stripslashes($email)?>"  size="80" maxlength="80" />
                                                 
                                                </td>
                                            </tr>
                                             <tr>
                                                <td height="36" align="right" class="text_bold_preto">Pessoa contato</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_pessoa_contato)) $class_pessoa_contato = 'input_branco'; else $class_pessoa_contato = 'input_erro'; ?>
													<input name="pessoa_contato" type="text" class="<?=$class_pessoa_contato?>" id="pessoa_contato" value="<?=stripslashes($pessoa_contato)?>"  size="20" maxlength="20" />
                                               </td>
                                            </tr>  
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Observação</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_observacao)) $class_observacao = 'input_branco'; else $class_observacao = 'input_erro'; ?>
													<input name="observacao" type="text" class="<?=$class_observacao?>" id="observacao" value="<?=stripslashes($observacao)?>"  size="80" maxlength="80"  />

                                                </td>
                                            </tr> 
	                           		