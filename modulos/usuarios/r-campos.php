
											<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id="id" value="<?=$id?>"  size="3" maxlength="11" />
                                                   
                                                </td>
                                            </tr>
                                            <? if(!empty($erroLogin))
											{	?>
                                            <tr>
                                                <td height="30" colspan="2" align="center" class="text_bold_vermelho">
													<?=$erroLogin?>
                                                </td>
                                            </tr>
                                            	<?
                                            }
											?>
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Login</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_login)) $class_login = 'input_branco'; else $class_login = 'input_erro'; ?>
													<input name="login" type="text" class="<?=$class_login?>" id="login" value="<?=stripslashes($login)?>"  size="30" maxlength="80" onKeyUp="ContaCaracteresCampo('login', 'loginT', 80);" />
                                                                                                  </td>
                                            </tr>
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome)) $class_nome = 'input_branco'; else $class_nome = 'input_erro'; ?>
													<input name="nome" type="text" class="<?=$class_nome?>" id="nome" value="<?=stripslashes($nome)?>"  size="60" maxlength="200" onKeyUp="ContaCaracteresCampo('nome', 'nomeT', 200);" />
                                            </tr>
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Email</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_email)) $class_email = 'input_branco'; else $class_email = 'input_erro'; ?>
													<input name="email" type="text" class="<?=$class_email?>" id="email" value="<?=stripslashes($email)?>"  size="60" maxlength="200" onKeyUp="ContaCaracteresCampo('email', 'emailT', 200);" />
                                            </tr>
										
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Celular</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_celular)) $class_celular = 'input_branco'; else $class_celular = 'input_erro'; ?>
													<input name="celular" type="text" class="<?=$class_celular?>" id="celular" value="<?=stripslashes($celular)?>"  size="15" maxlength="14" onKeyUp="ContaCaracteresCampo('celular', 'celularT', 50);"  onkeypress="mascara(this,telefone)" />
                                            </tr>
										    <tr>
                                                <td height="36" align="right" class="text_bold_preto">Grupo de usu&aacute;rio</td>
                                                <td class="text_padrao">
                                                    <?
													
													$dados = array('primary_key' => 'id', 
													'nome' => 'nome', 
													'tabela' => 'grupo_usuarios', 
													'condicao' => 'where status=1 order by nome asc', 
													'nome_input' => 'grupo_id', 
													'id' => 'sle', 
													'class' => 'select', 
													'value' => $grupo_id);	
													
													geraSelect($dados);
													
													?>
	                                            </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Empresa</td>
                                                <td class="text_padrao">
                                                    <?
                                                    
                                                    $dados = array('primary_key' => 'id', 
                                                    'nome' => 'descricao', 
                                                    'tabela' => 'espaco_fisico', 
                                                    'condicao' => 'where status=1 order by descricao asc', 
                                                    'nome_input' => 'empresa_id', 
                                                    'id' => 'sle', 
                                                    'class' => 'select', 
                                                    'value' => $empresa_id);  
                                                    
                                                    geraSelect($dados);
                                                    
                                                    ?>
                                                </td>
                                            </tr>
                                            		
                                           <? if(!empty($erroSenha))
											{ ?>    
                                            <tr>
                                                <td height="30" colspan="2" align="center" class="text_bold_vermelho">
												
													<?=$erroSenha?>
                                            	&nbsp;</td>
                                            </tr>
                                           <? }
												?>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Senha</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_senha)) $class_senha = 'input_branco'; else $class_senha = 'input_erro'; ?>
													<input name="senha" type="password" class="<?=$class_senha?>" id="senha"  size="25" maxlength="50" onKeyUp="ContaCaracteresCampo('senha', 'senhaT', 50);" />
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Confirme a Senha</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_csenha)) $class_csenha = 'input_branco'; else $class_csenha = 'input_erro'; ?>
													<input name="csenha" type="password" class="<?=$class_csenha?>" id="csenha"  size="25" maxlength="50" onKeyUp="ContaCaracteresCampo('csenha', 'csenhaT', 50);" />
                                            </tr>
											<tr>
                                                <td height="36" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="status" value="1" <? if($status==1) echo "checked";?> />                                                </td>
                                            </tr>
