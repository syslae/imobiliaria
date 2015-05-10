<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                            	<td height="40"></td>
                                            </tr>
	                                        <tr height="36">
                                                <!--<td height="36" align="right" class="text_bold_preto"></td>-->
                                                <td class="text_padrao" id="add_clientes" align="center">
                                                	<a href="<?=URL.'/modulos/pesquisa_cliente/'?>cadastrar.php?keepThis=true&TB_iframe=true&height=350&width=500" class="thickbox" >ADICIONAR CLIENTE</a>
                                                </td>
                                            </tr> 
                                             <tr>
                                                <!--<td height="36" align="right" class="text_bold_preto"></td>-->
                                                <td class="text_padrao" id="add_clientes">
												<div id="filhos_clientes">
                                                	<?=retornaFilhosCliente($cliente_id)?>
												</div>
                                                <span id="clientes_i">
                                                </span>
												<input type="hidden" id="qtd_filhos" value="<?=$qtd_clientes_filhos?>" name="qtdfilhos" />
												</td>
                                            </tr>
                                            <tr>
                                                <td height="36" class="text_bold_preto" align="center" >Procurar estoque do produto

                                                    <?
                                                    $dados = array('primary_key' => 'id',
                                                        'class' => 'select ',
                                                        'nome' => 'descricao',
                                                        'tabela' => 'produto',
                                                        'condicao' => ' where status = 1 and produto_principal_id is null ORDER BY descricao',
                                                        'nome_input' => 'produto_principal_id',
                                                        'id' => 'produto_principal_id',
                                                        'value' => $produto_principal_id);
                                                    geraSelect($dados);
                                                    ?>

                                                </td>
                                            </tr>

                                            <tr height="36">
                                                <!--<td height="36" align="right" class="text_bold_preto"></td>-->
                                                <td class="text_padrao" id="add_itens" align="center">
                                                	<a href="javascript:;" onclick="abrir_busca();" class="" >ADICIONAR PRODUTOS</a>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <!--<td height="36" align="right" class="text_bold_preto"></td>-->
                                                <td class="text_padrao" id="add_itens">
                                                    <div id="filhos">
                                                        <?=retornaFilhosProduto($produto_id)?>
                                                    </div>
                                                    <span id="produtos_i">
                                                    <??>
                                                    </span>
													<input type="hidden" id="qtd" value="<?=$qtd_filhos?>" name="qtdproduto" />
												</td>
                                            </tr>



                                            <tr>
                                                <td class="text_padrao" align="center" colspan="2" id="total_pedido">
                                                    <br />
                                                    <div id="ValorTotal">
       
                                                    </div>&nbsp;
                                                    <input type="hidden" value="0" id="ValorTotalItem" name="ValorTotalItem" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?=$ValorTotal;?></td>
                                            </tr>
                                            <tr>
                                                <td class="text_padrao" id="parcelas" align="center">
                                                 <label for="dia_vencimento">Selecione o dia do vencimento:
                                                    <input type="text" name="dia_vencimento" id="dia_vencimento">
                                                    <label>Parcelas:</label>
                                                    <select name="options" id="options">
                                                        <option value="0" selected>&nbsp;</option>

                                                        <?foreach($qtde_parcelamento as $qtde){?>

                                                            <option value="<? echo $qtde['qtde_vezes'];?>" <?if($qtde['qtde_vezes'] == $options) echo "selected";?>><? echo $qtde['qtde_vezes'];?></option>

                                                        <? }?>

                                                    </select>
                                                    <br/><br/>
                                                    <div id="total"><?=retornaFilhosParcelas($vencimento,$valor_parcela)?></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="36" class="text_bold_preto" align="center" >Gerar boleto com o banco
                                                    <? if(empty($class_banco_id)) $class_banco_id = 'input_branco'; else $class_banco_id = 'input_erro'; ?>

                                                    <?
                                                    $dados = array('primary_key' => 'id',
                                                        'class' => $class_banco_id,
                                                        'nome' => 'banco',
                                                        'tabela' => 'bancos',
                                                        'condicao' => ' where status = 1 ORDER BY banco',
                                                        'nome_input' => 'banco_id',
                                                        'value' => $banco_id);
                                                    geraSelect($dados);
                                                    ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <!--<td id="extenso">extenso</td>-->
                                            </tr>

                                            <input type="hidden" id="data_atual" value="<? echo date('d/m/Y');?>" />
