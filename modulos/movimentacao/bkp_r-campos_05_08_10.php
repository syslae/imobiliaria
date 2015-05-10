<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Tipo pedido:</td>
                                                 <td class="text_padrao">
                                                 <input type="radio" value="1" name="tipo_pedido" <? if($tipo_pedido_id == 1){ echo "checked";};?> />Orçamento
                                                 <input type="radio" value="2" name="tipo_pedido" <? if($tipo_pedido_id == 2){ echo "checked";};?> />Venda
                                                </td>
                                            </tr>
	                                        <tr>
                                                <td height="36" align="right" class="text_bold_preto"></td>
                                                <td class="text_padrao">
                                                	<a href="<?=URL.'/modulos/pesquisa_cliente/'?>cadastrar.php?keepThis=true&TB_iframe=true&height=350&width=500" class="thickbox" >ADICIONAR CLIENTE</a>
                                                </td>
                                            </tr> 
                                             <tr>
                                                <td height="36" align="right" class="text_bold_preto"></td>
                                                <td class="text_padrao">
												<div id="filhos_clientes">
                                                	<?=retornaFilhosCliente($id)?>
												</div>
                                                <span id="clientes_i">
                                                <??>
                                                </span>
												<input type="hidden" id="qtd_filhos" value="<?=$qtd_filhos?>" name="qtdfilhos" />
												</td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto"></td>
                                                <td class="text_padrao">
                                                <a href="<?=URL.'/modulos/itens_pedido/'?>itens_busca.php?keepThis=true&TB_iframe=true&height=500&width=900" class="thickbox" >ADICIONAR ITENS</a>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto"></td>
                                                <td class="text_padrao">
												<div id="filhos">
                                                <?=retornaFilhosRequisicao($id)?>
												</div>
                                                <span id="produtos_i">
                                                <??>
                                                </span>
												<input type="hidden" id="qtd" value="<?=$qtd_filhos?>" name="qtdproduto" />
												</td>
                                            </tr>
                                            <tr>
                                                <td class="text_padrao" align="right" colspan="2">
                                                     <div id="ValorTotal">
                                                              
                                                     </div>
                                                     <input type="hidden" value="0" id="ValorTotalItem" /> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?=$ValorTotal;?></td>
                                            
                                            </tr> 
	                            		  