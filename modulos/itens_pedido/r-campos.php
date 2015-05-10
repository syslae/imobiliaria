<tr>
                                                <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
                                                <td class="text_padrao">
                                                    <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="36" align="right" class="text_bold_preto">Pesquisa:</td>
                                                 <td class="text_padrao">
                                                 <input type="radio" value="" name="tipo" onclick="ChamarTipo(1)" />Codigo
                                                 <input type="radio" value="" name="tipo" onclick="ChamarTipo(2)"/>Descrição
                                                </td>
                                            </tr>
                                            <tr id="produto">
                                                <td height="36" align="right" class="text_bold_preto">Produto</td>
                                                 <td class="text_padrao">
                                                    <input name="produto" type="text" class="input_branco" id="produtos" value="<?=stripslashes($produto)?>"  size="40" maxlength="40" onblur="abrediv()" />  
                                                </td>
                                            </tr>
                                            <tr id="codigo">
                                                <td height="36" align="right" class="text_bold_preto">Codigo</td>
                                                 <td class="text_padrao">
                                                    <input name="codigo" type="text" class="input_branco" id="codigos"  size="40" maxlength="40"  onblur="AbredivCodigo()"/>  
                                                </td>
                                            </tr>
                                             <tr id="qtd_final">
                                                <td  align="center">Quantidade
                                              	    
                                                </td>
                                                <td>
                                                <span id="mostra">	
                                                 </span>
                                                </td>
                                            </tr>
                                            <tr id="valores">
                                                <td  align="center" colspan="2">
                                             	 <span id="mostra_dados">	
                                                 </span>
                                                </td>
                                            </tr>
                                            <script>
											 	$('#qtd_final').hide();
                                                $('#valores').hide();
                                                $('#produto').hide();
                                                $('#codigo').hide();
                                           	</script>
	                                      