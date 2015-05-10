<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Razão social</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_razao_social)) $class_razao_social = 'input_branco'; else $class_razao_social = 'input_erro'; ?>
													<input name="razao_social" type="text" class="<?=$class_razao_social?>" id="razao_social" value="<?=stripslashes($razao_social)?>"  size="80" maxlength="80"  />
                                       </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome fantasia</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome_fantasia)) $class_nome_fantasia = 'input_branco'; else $class_nome_fantasia = 'input_erro'; ?>
													<input name="nome_fantasia" type="text" class="<?=$class_nome_fantasia?>" id="nome_fantasia" value="<?=stripslashes($nome_fantasia)?>"  size="80" maxlength="80" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">CNPJ</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cnpj)) $class_cnpj = 'input_branco'; else $class_cnpj = 'input_erro'; ?>
													<input name="cnpj" type="text" class="<?=$class_cnpj?>" id="cnpj" value="<?=stripslashes($cnpj)?>"  size="20" maxlength="20"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">IE</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_ie)) $class_ie = 'input_branco'; else $class_ie = 'input_erro'; ?>
													<input name="ie" type="text" class="<?=$class_ie?>" id="ie" value="<?=stripslashes($ie)?>"  size="16" maxlength="16"  />
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
													<input name="numero" type="text" class="<?=$class_numero?>" id="numero" value="<?=stripslashes($numero)?>"  size="12" maxlength="12" />
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
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Celular</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_celular)) $class_celular = 'input_branco'; else $class_celular = 'input_erro'; ?>
													<input name="celular" type="text" class="<?=$class_celular?>" id="celular" value="<?=stripslashes($celular)?>"  size="16" maxlength="16"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Fax</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_fax)) $class_fax = 'input_branco'; else $class_fax = 'input_erro'; ?>
													<input name="fax" type="text" class="<?=$class_fax?>" id="fax" value="<?=stripslashes($fax)?>"  size="16" maxlength="16" />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Email</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_email)) $class_email = 'input_branco'; else $class_email = 'input_erro'; ?>
													<input name="email" type="text" class="<?=$class_email?>" id="email" value="<?=stripslashes($email)?>"  size="80" maxlength="80"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Site</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_site)) $class_site = 'input_branco'; else $class_site = 'input_erro'; ?>
													<input name="site" type="text" class="<?=$class_site?>" id="site" value="<?=stripslashes($site)?>"  size="80" maxlength="80"  />
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Pessoa contato</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_pessoa_contato)) $class_pessoa_contato = 'input_branco'; else $class_pessoa_contato = 'input_erro'; ?>
													<input name="pessoa_contato" type="text" class="<?=$class_pessoa_contato?>" id="pessoa_contato" value="<?=stripslashes($pessoa_contato)?>"  size="80" maxlength="80" />
                                               </td>
                                            </tr> 
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Atuação</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_atuacao)) $class_atuacao = 'input_branco'; else $class_atuacao = 'input_erro'; ?>
													<input name="atuacao" type="text" class="<?=$class_atuacao?>" id="atuacao" value="<?=stripslashes($atuacao)?>"  size="50" maxlength="50"  />
                                                </td>
                                            </tr>