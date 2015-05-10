<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>

	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Banco</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_banco)) $class_banco = 'input_branco'; else $class_banco = 'input_erro'; ?>
													<input name="banco" type="text" class="<?=$class_banco?>" id="banco" value="<?=stripslashes($banco)?>"  size="100" maxlength="100" onKeyUp="ContaCaracteresCampo('banco', 'bancoT', 100);" />
                                                    <input name="bancoT" type="text" disabled class="input_caracteres" id="bancoT" value="200" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Layout</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_sigla)) $class_sigla = 'input_branco'; else $class_sigla = 'input_erro'; ?>

                                                    <select name="sigla" id="sigla" class="<? echo $class_sigla;?>" onchange="exibirLayout(this.value);">
                                                        <option value="SE" <?php if (trim($sigla) == "SE") echo "selected"; ?>> Selecione um Layout </option>
                                                        <option value="IT" <?php if (trim($sigla) == "IT") echo "selected"; ?>> ITAÚ </option>
                                                        <option value="BI" <?php if (trim($sigla) == "BI") echo "selected"; ?>>BIC BANCO</option>
                                                        <option value="BS" <?php if (trim($sigla) == "BS") echo "selected"; ?>>SANTANDER</option>
                                                        <option value="HS" <?php if (trim($sigla) == "HS") echo "selected"; ?>>HSBC</option>
                                                        <option value="BB" <?php if (trim($sigla) == 'BB') echo "selected" ?>>BANCO DO BRASIL</option>
                                                        <option value="CS" <?php if (trim($sigla) == 'CS') echo "selected" ?>>CAIXA ECONÔMICA COBRANÇA SEM REGISTRO</option>
                                                        <option value="CR" <?php if (trim($sigla) == 'CR') echo "selected" ?>>CAIXA ECONÔMICA COBRANÇA RÁPIDA</option>
                                                        <option value="SR" <?php if (trim($sigla) == 'SR') echo "selected" ?>>CAIXA ECONÔMICA SIGCB</option>
                                                        <option value="BR" <?php if (trim($sigla) == 'RU') echo "selected" ?>>BANCO BRADESCO</option>
                                                        <option value="BN" <?php if (trim($sigla) == 'BN') echo "selected" ?>>BANCO DO NORDESTE</option>
                                                        <option value="PC" <?php if (trim($sigla) == 'PC') echo "selected" ?>>PAG CONTAS</option>
                                                        <option value="PC" <?php if (trim($sigla) == 'CA') echo "selected" ?>>CARNÊ</option>
                                                    </select>
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Juros</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_juros)) $class_juros = 'input_branco'; else $class_juros = 'input_erro'; ?>
													<input name="juros" type="text" class="<?=$class_juros?>" id="juros" value="<?=stripslashes($juros)?>"  size="12" maxlength="12" onKeyUp="ContaCaracteresCampo('juros', 'jurosT', 12);" onkeypress="Mascara(this, mascValor)" />
                                                    <input name="jurosT" type="text" disabled class="input_caracteres" id="jurosT" value="12" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Prazo dos juros</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_prazo_juros)) $class_prazo_juros = 'input_branco'; else $class_prazo_juros = 'input_erro'; ?>
                                                    <input name="prazo_juros" type="text" class="<?=$class_prazo_juros?>" id="prazo_juros" value="<?=stripslashes($prazo_juros)?>"  size="11" maxlength="11" onKeyUp="ContaCaracteresCampo('prazo_juros', 'prazo_jurosT', 11);" onkeypress="Mascara(this, soNumeros)"/>
                                                    <input name="prazo_jurosT" type="text" disabled class="input_caracteres" id="prazo_jurosT" value="11" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Multa</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_multa)) $class_multa = 'input_branco'; else $class_multa = 'input_erro'; ?>
													<input name="multa" type="text" class="<?=$class_multa?>" id="multa" value="<?=stripslashes($multa)?>"  size="12" maxlength="12" onKeyUp="ContaCaracteresCampo('multa', 'multaT', 12);" onkeypress="Mascara(this, mascValor)"/>
                                                    <input name="multaT" type="text" disabled class="input_caracteres" id="multaT" value="12" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Prazo da multa</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_prazo_multa)) $class_prazo_multa = 'input_branco'; else $class_prazo_multa = 'input_erro'; ?>
													<input name="prazo_multa" type="text" class="<?=$class_prazo_multa?>" id="prazo_multa" value="<?=stripslashes($prazo_multa)?>"  size="11" maxlength="11" onKeyUp="ContaCaracteresCampo('prazo_multa', 'prazo_multaT', 11);" onkeypress="Mascara(this, soNumeros)" />
                                                    <input name="prazo_multaT" type="text" disabled class="input_caracteres" id="prazo_multaT" value="11" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Desconto</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_desconto)) $class_desconto = 'input_branco'; else $class_desconto = 'input_erro'; ?>
													<input name="desconto" type="text" class="<?=$class_desconto?>" id="desconto" value="<?=stripslashes($desconto)?>"  size="12" maxlength="12" onKeyUp="ContaCaracteresCampo('desconto', 'descontoT', 12);" onkeypress="Mascara(this, mascValor)"/>
                                                    <input name="descontoT" type="text" disabled class="input_caracteres" id="descontoT" value="12" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Prazo do desconto</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_prazo_desconto)) $class_prazo_desconto = 'input_branco'; else $class_prazo_desconto = 'input_erro'; ?>
													<input name="prazo_desconto" type="text" class="<?=$class_prazo_desconto?>" id="prazo_desconto" value="<?=stripslashes($prazo_desconto)?>"  size="11" maxlength="11" onKeyUp="ContaCaracteresCampo('prazo_desconto', 'prazo_descontoT', 11);" onkeypress="Mascara(this, soNumeros)" />
                                                    <input name="prazo_descontoT" type="text" disabled class="input_caracteres" id="prazo_descontoT" value="11" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome da instituição</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome_instituicao)) $class_nome_instituicao = 'input_branco'; else $class_nome_instituicao = 'input_erro'; ?>
                                                    <input name="nome_instituicao" type="text" class="<?=$class_nome_instituicao?>" id="nome_instituicao" value="<?=stripslashes($nome_instituicao)?>"  size="100" maxlength="100" onKeyUp="ContaCaracteresCampo('nome_instituicao', 'nome_instituicaoT', 100);" />
                                                    <input name="nome_instituicaoT" type="text" disabled class="input_caracteres" id="nome_instituicaoT" value="150" size="1" style="width:20px" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Nome no boleto</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_nome_boleto)) $class_nome_boleto = 'input_branco'; else $class_nome_boleto = 'input_erro'; ?>
                                                    <input name="nome_boleto" type="text" class="<?=$class_nome_boleto?>" id="nome_boleto" value="<?=stripslashes($nome_boleto)?>"  size="15" maxlength="15" onKeyUp="ContaCaracteresCampo('nome_boleto', 'nome_boletoT', 15);" />
                                                    <input name="nome_boletoT" type="text" disabled class="input_caracteres" id="nome_boletoT" value="15" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Endereço</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_endereco)) $class_endereco = 'input_branco'; else $class_endereco = 'input_erro'; ?>
                                                    <input name="endereco" type="text" class="<?=$class_endereco?>" id="endereco" value="<?=stripslashes($endereco)?>"  size="100" maxlength="100" onKeyUp="ContaCaracteresCampo('endereco', 'enderecoT', 100);" />
                                                    <input name="enderecoT" type="text" disabled class="input_caracteres" id="enderecoT" value="250" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Bairro</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_bairro)) $class_bairro = 'input_branco'; else $class_bairro = 'input_erro'; ?>
                                                    <input name="bairro" type="text" class="<?=$class_bairro?>" id="bairro" value="<?=stripslashes($bairro)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('bairro', 'bairroT', 50);" />
                                                    <input name="bairroT" type="text" disabled class="input_caracteres" id="bairroT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto" >Estado</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_estado_id)) $class_estado_id = 'input_branco'; else $class_estado_id = 'input_erro'; ?>

                                                    <?
                                                    $dados = array('primary_key' => 'id',
                                                        'class' => $class_estado_id,
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
                                                    <? if(empty($class_cidade_id)) $class_cidade_id = 'input_branco'; else $class_cidade_id = 'input_erro'; ?>

                                                    <?
                                                    if(empty($estado_id)) $estado_id=0;

                                                    $dados = array('primary_key' => 'id',
                                                        'nome' => 'nome',
                                                        'tabela' => 'cidade',
                                                        'condicao' => 'where id_estado = '.$estado_id.' ORDER BY nome',
                                                        'nome_input' => 'cidade_id',
                                                        'id_option'=> 'opcoes',
                                                        'class' => $class_cidade_id,
                                                        'value' => $cidade_id);

                                                    geraSelect($dados);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cep</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cep)) $class_cep = 'input_branco'; else $class_cep = 'input_erro'; ?>
                                                    <input name="cep" type="text" class="<?=$class_cep?>" id="cep" value="<?=stripslashes($cep)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('cep', 'cepT', 18);" onkeypress="Mascara(this,mascCep)"/>
                                                    <input name="cepT" type="text" disabled class="input_caracteres" id="cepT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>


	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Protesto/devolução</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_protesto_devolucao)) $class_protesto_devolucao = 'input_branco'; else $class_protesto_devolucao = 'input_erro'; ?>

                                                    <select name="protesto_devolucao" class="<? echo $class_protesto_devolucao?> ">
                                                        <option value="N"> Não Protesta os boletos</option>
                                                        <option value="S" <? if ($protesto_devolucao == "S") echo "selected"; ?>>Protesta os boletos</option>
                                                    </select>
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Prazo protesto/devolução</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_prazo_protesto_devolucao)) $class_prazo_protesto_devolucao = 'input_branco'; else $class_prazo_protesto_devolucao = 'input_erro'; ?>
													<input name="prazo_protesto_devolucao" type="text" class="<?=$class_prazo_protesto_devolucao?>" id="prazo_protesto_devolucao" value="<?=stripslashes($prazo_protesto_devolucao)?>"  size="11" maxlength="11" onKeyUp="ContaCaracteresCampo('prazo_protesto_devolucao', 'prazo_protesto_devolucaoT', 11);" onkeypress="Mascara(this, soNumeros)" />
                                                    <input name="prazo_protesto_devolucaoT" type="text" disabled class="input_caracteres" id="prazo_protesto_devolucaoT" value="11" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cnpj</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cnpj)) $class_cnpj = 'input_branco'; else $class_cnpj = 'input_erro'; ?>
													<input name="cnpj" type="text" class="<?=$class_cnpj?>" id="cnpj" value="<?=stripslashes($cnpj)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('cnpj', 'cnpjT', 18);" onkeypress="Mascara(this,mascCnpj)" />
                                                    <input name="cnpjT" type="text" disabled class="input_caracteres" id="cnpjT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Num. convênio</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_num_convenio)) $class_num_convenio = 'input_branco'; else $class_num_convenio = 'input_erro'; ?>
													<input name="num_convenio" type="text" class="<?=$class_num_convenio?>" id="num_convenio" value="<?=stripslashes($num_convenio)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('num_convenio', 'num_convenioT', 50);" />
                                                    <input name="num_convenioT" type="text" disabled class="input_caracteres" id="num_convenioT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Carteira</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_carteira)) $class_carteira = 'input_branco'; else $class_carteira = 'input_erro'; ?>
													<input name="carteira" type="text" class="<?=$class_carteira?>" id="carteira" value="<?=stripslashes($carteira)?>"  size="30" maxlength="30" onKeyUp="ContaCaracteresCampo('carteira', 'carteiraT', 30);" />
                                                    <input name="carteiraT" type="text" disabled class="input_caracteres" id="carteiraT" value="30" size="1" style="width:20px" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Tipo carteira</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tipo_carteira)) $class_tipo_carteira = 'input_branco'; else $class_tipo_carteira = 'input_erro'; ?>
                                                    <input name="tipo_carteira" type="text" class="<?=$class_tipo_carteira?>" id="tipo_carteira" value="<?=stripslashes($tipo_carteira)?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('tipo_carteira', 'tipo_carteiraT', 20);" />
                                                    <input name="tipo_carteiraT" type="text" disabled class="input_caracteres" id="tipo_carteiraT" value="20" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Agência</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_agencia)) $class_agencia = 'input_branco'; else $class_agencia = 'input_erro'; ?>
													<input name="agencia" type="text" class="<?=$class_agencia?>" id="agencia" value="<?=stripslashes($agencia)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('agencia', 'agenciaT', 18);" />
                                                    <input name="agenciaT" type="text" disabled class="input_caracteres" id="agenciaT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Dígito agência</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_digito_agencia)) $class_digito_agencia = 'input_branco'; else $class_digito_agencia = 'input_erro'; ?>
                                                    <input name="digito_agencia" type="text" class="<?=$class_digito_agencia?>" id="digito_agencia" value="<?=stripslashes($digito_agencia)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('digito_agencia', 'digito_agenciaT', 18);" />
                                                    <input name="digito_agenciaT" type="text" disabled class="input_caracteres" id="digito_agenciaT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Agência/Cód. Cedente</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_agencia_cod_cedente)) $class_agencia_cod_cedente = 'input_branco'; else $class_agencia_cod_cedente = 'input_erro'; ?>
                                                    <input name="agencia_cod_cedente" type="text" class="<?=$class_agencia_cod_cedente?>" id="agencia_cod_cedente" value="<?=stripslashes($agencia_cod_cedente)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('agencia_cod_cedente', 'agencia_cod_cedenteT', 50);" />
                                                    <input name="agencia_cod_cedenteT" type="text" disabled class="input_caracteres" id="agencia_cod_cedenteT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Conta</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_conta)) $class_conta = 'input_branco'; else $class_conta = 'input_erro'; ?>
													<input name="conta" type="text" class="<?=$class_conta?>" id="conta" value="<?=stripslashes($conta)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('conta', 'contaT', 18);" />
                                                    <input name="contaT" type="text" disabled class="input_caracteres" id="contaT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>

	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Dígito conta</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_digito_conta)) $class_digito_conta = 'input_branco'; else $class_digito_conta = 'input_erro'; ?>
													<input name="digito_conta" type="text" class="<?=$class_digito_conta?>" id="digito_conta" value="<?=stripslashes($digito_conta)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('digito_conta', 'digito_contaT', 18);" />
                                                    <input name="digito_contaT" type="text" disabled class="input_caracteres" id="digito_contaT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Tipo conta</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tipo_conta)) $class_tipo_conta = 'input_branco'; else $class_tipo_conta = 'input_erro'; ?>
                                                    <input name="tipo_conta" type="text" class="<?=$class_tipo_conta?>" id="tipo_conta" value="<?=stripslashes($tipo_conta)?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('tipo_conta', 'tipo_contaT', 20);" />
                                                    <input name="tipo_contaT" type="text" disabled class="input_caracteres" id="tipo_contaT" value="20" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Dígito Agência Conta</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_digito_agencia_conta)) $class_digito_agencia_conta = 'input_branco'; else $class_digito_agencia_conta = 'input_erro'; ?>
													<input name="digito_agencia_conta" type="text" class="<?=$class_digito_agencia_conta?>" id="digito_agencia_conta" value="<?=stripslashes($digito_agencia_conta)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('digito_agencia_conta', 'digito_agencia_contaT', 18);" />
                                                    <input name="digito_agencia_contaT" type="text" disabled class="input_caracteres" id="digito_agencia_contaT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Tipo inscrição</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tipo_incricao)) $class_tipo_incricao = 'input_branco'; else $class_tipo_incricao = 'input_erro'; ?>
													<input name="tipo_incricao" type="text" class="<?=$class_tipo_incricao?>" id="tipo_incricao" value="<?=stripslashes($tipo_incricao)?>"  size="18" maxlength="18" onKeyUp="ContaCaracteresCampo('tipo_incricao', 'tipo_incricaoT', 18);" />
                                                    <input name="tipo_incricaoT" type="text" disabled class="input_caracteres" id="tipo_incricaoT" value="18" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Num. inscrição</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_num_inscricao)) $class_num_inscricao = 'input_branco'; else $class_num_inscricao = 'input_erro'; ?>
													<input name="num_inscricao" type="text" class="<?=$class_num_inscricao?>" id="num_inscricao" value="<?=stripslashes($num_inscricao)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('num_inscricao', 'num_inscricaoT', 50);" />
                                                    <input name="num_inscricaoT" type="text" disabled class="input_caracteres" id="num_inscricaoT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Contrato</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_contrato)) $class_contrato = 'input_branco'; else $class_contrato = 'input_erro'; ?>
													<input name="contrato" type="text" class="<?=$class_contrato?>" id="contrato" value="<?=stripslashes($contrato)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('contrato', 'contratoT', 50);" />
                                                    <input name="contratoT" type="text" disabled class="input_caracteres" id="contratoT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Código reduzido</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_codigo_reduzido)) $class_codigo_reduzido = 'input_branco'; else $class_codigo_reduzido = 'input_erro'; ?>
													<input name="codigo_reduzido" type="text" class="<?=$class_codigo_reduzido?>" id="codigo_reduzido" value="<?=stripslashes($codigo_reduzido)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('codigo_reduzido', 'codigo_reduzidoT', 50);" />
                                                    <input name="codigo_reduzidoT" type="text" disabled class="input_caracteres" id="codigo_reduzidoT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>

	                                        <!--<tr>
                                                <td height="36" align="right" class="text_bold_preto">Id_caixa</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_id_caixa)) $class_id_caixa = 'input_branco'; else $class_id_caixa = 'input_erro'; ?>
													<input name="id_caixa" type="text" class="<?=$class_id_caixa?>" id="id_caixa" value="<?=stripslashes($id_caixa)?>"  size="11" maxlength="11" onKeyUp="ContaCaracteresCampo('id_caixa', 'id_caixaT', 11);" />
                                                    <input name="id_caixaT" type="text" disabled class="input_caracteres" id="id_caixaT" value="11" size="1" style="width:20px" />
                                                </td>
                                            </tr>-->
	                                        <!--<tr>
                                                <td height="36" align="right" class="text_bold_preto">Banco cobrador</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_banco_cobrador)) $class_banco_cobrador = 'input_branco'; else $class_banco_cobrador = 'input_erro'; ?>
													<input name="banco_cobrador" type="text" class="<?=$class_banco_cobrador?>" id="banco_cobrador" value="<?=stripslashes($banco_cobrador)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('banco_cobrador', 'banco_cobradorT', 50);" />
                                                    <input name="banco_cobradorT" type="text" disabled class="input_caracteres" id="banco_cobradorT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Carteira_remessa</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_carteira_remessa)) $class_carteira_remessa = 'input_branco'; else $class_carteira_remessa = 'input_erro'; ?>
													<input name="carteira_remessa" type="text" class="<?=$class_carteira_remessa?>" id="carteira_remessa" value="<?=stripslashes($carteira_remessa)?>"  size="5" maxlength="5" onKeyUp="ContaCaracteresCampo('carteira_remessa', 'carteira_remessaT', 5);" />
                                                    <input name="carteira_remessaT" type="text" disabled class="input_caracteres" id="carteira_remessaT" value="5" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Agencia_cobradora</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_agencia_cobradora)) $class_agencia_cobradora = 'input_branco'; else $class_agencia_cobradora = 'input_erro'; ?>
													<input name="agencia_cobradora" type="text" class="<?=$class_agencia_cobradora?>" id="agencia_cobradora" value="<?=stripslashes($agencia_cobradora)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('agencia_cobradora', 'agencia_cobradoraT', 50);" />
                                                    <input name="agencia_cobradoraT" type="text" disabled class="input_caracteres" id="agencia_cobradoraT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>-->

	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Matrícula banco</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_matricula_banco)) $class_matricula_banco = 'input_branco'; else $class_matricula_banco = 'input_erro'; ?>
													<input name="matricula_banco" type="text" class="<?=$class_matricula_banco?>" id="matricula_banco" value="<?=stripslashes($matricula_banco)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('matricula_banco', 'matricula_bancoT', 10);" />
                                                    <input name="matricula_bancoT" type="text" disabled class="input_caracteres" id="matricula_bancoT" value="10" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Radical</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_radical)) $class_radical = 'input_branco'; else $class_radical = 'input_erro'; ?>
													<input name="radical" type="text" class="<?=$class_radical?>" id="radical" value="<?=stripslashes($radical)?>"  size="10" maxlength="10" onKeyUp="ContaCaracteresCampo('radical', 'radicalT', 10);" />
                                                    <input name="radicalT" type="text" disabled class="input_caracteres" id="radicalT" value="10" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <!--<tr>
                                                <td height="36" align="right" class="text_bold_preto">Tamanho linha na remessa</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tamanho_linha_remessa)) $class_tamanho_linha_remessa = 'input_branco'; else $class_tamanho_linha_remessa = 'input_erro'; ?>
													<select name="tamanho_linha_remessa" class="<? echo $class_tamanho_linha_remessa; ?>">
                                                        <option value="240"> 240</option>
                                                        <option value="400" <?php if ($class_tamanho_linha_remessa == 400) echo "selected"; ?>>400</option>
                                                    </select>
                                                </td>
                                            </tr>-->

	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Código do Cliente</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cod_cliente)) $class_cod_cliente = 'input_branco'; else $class_cod_cliente = 'input_erro'; ?>
													<input name="cod_cliente" type="text" class="<?=$class_cod_cliente?>" id="cod_cliente" value="<?=stripslashes($cod_cliente)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('cod_cliente', 'cod_clienteT', 50);" />
                                                    <input name="cod_clienteT" type="text" disabled class="input_caracteres" id="cod_clienteT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                       <!-- <tr>
                                                <td height="36" align="right" class="text_bold_preto">Cta_deb</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_cta_deb)) $class_cta_deb = 'input_branco'; else $class_cta_deb = 'input_erro'; ?>
													<input name="cta_deb" type="text" class="<?=$class_cta_deb?>" id="cta_deb" value="<?=stripslashes($cta_deb)?>"  size="50" maxlength="50" onKeyUp="ContaCaracteresCampo('cta_deb', 'cta_debT', 50);" />
                                                    <input name="cta_debT" type="text" disabled class="input_caracteres" id="cta_debT" value="50" size="1" style="width:20px" />
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto">Digito_cta_deb</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_digito_cta_deb)) $class_digito_cta_deb = 'input_branco'; else $class_digito_cta_deb = 'input_erro'; ?>
													<input name="digito_cta_deb" type="text" class="<?=$class_digito_cta_deb?>" id="digito_cta_deb" value="<?=stripslashes($digito_cta_deb)?>"  size="2" maxlength="2" onKeyUp="ContaCaracteresCampo('digito_cta_deb', 'digito_cta_debT', 2);" />
                                                    <input name="digito_cta_debT" type="text" disabled class="input_caracteres" id="digito_cta_debT" value="2" size="1" style="width:20px" />
                                                </td>
                                            </tr>-->

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Tamanho da Linha Retorno</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_tamanho_linha)) $class_tamanho_linha = 'input_branco'; else $class_tamanho_linha = 'input_erro'; ?>

                                                    <select name="tamanho_linha" class="<?echo $class_tamanho_linha;?>">
                                                        <option value="240"> 240</option>
                                                        <option value="400" <?php if ($tamanho_linha == 400) echo "selected"; ?>>400</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Exibir Parcela no Boleto</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="exibir_parcela" value="S" <? if (ltrim(rtrim($exibir_parcela)) == 'S') echo "checked"; ?> />

                                                </td>
                                            </tr>


                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <input type="checkbox" name="status" value="1" <? if($status==1) echo "checked";?> />
                                                </td>
                                            </tr>