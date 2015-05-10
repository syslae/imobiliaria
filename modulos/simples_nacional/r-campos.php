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
													                           <input name="descricao" type="text" class="<?=$class_descricao?>" id="nome" value="<?=stripslashes($descricao)?>"  size="80" maxlength="80" />
                                                </td>
                                             </tr>

                                             <tr>
                                                <td height="36" align="right" class="text_bold_preto">Mês</td>
                                                <td class="text_padrao">
                                                <?
                                                $dados = array('primary_key' => 'id',
                                                'nome' => 'mes',
                                                'tabela' => 'meses',
                                                'condicao' => "order by id asc",
                                                'nome_input' => 'mes',
                                                'id' => 'sle',
                                                'class' => 'select',
                                                'value' => $mes);
                                                geraSelect($dados);?>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Ano</td>
                                                <td class="text_padrao">
                                                <?
                                                $dados = array('primary_key' => 'id',
                                                'nome' => 'ano',
                                                'tabela' => 'ano',
                                                'condicao' => "order by ano desc",
                                                'nome_input' => 'ano',
                                                'id' => 'sle',
                                                'class' => 'select',
                                                'value' => $ano);
                                                geraSelect($dados);?>
                                            </tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Valor R$</td>
                                                <td class="text_padrao">
                                                    <? if(empty($class_valor)) $class_valor = 'input_branco'; else $class_valor = 'input_erro'; ?>
                                                    <input name="valor" type="text" class="<?=$class_valor?>" id="valor" value="<?=stripslashes($valor)?>"  size="12" maxlength="12" onKeyPress="return(MascaraMoeda(this,'.',',',event))" />

                                                </td>
                                            </tr>
                                           <tr>

                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Simples Nacional:</td>
                                                <td class="text_padrao">
                                                 <input type="file" name="simples_nacional"/>
                                                </td>
                                            </tr>
