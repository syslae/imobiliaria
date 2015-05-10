							                <tr>
                                                <td height="24" align="right" class="text_bold_preto">Usuário:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("usuarios","nome",$usuario_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data pedido:</td>
                                                <td class="text_padrao">
													 <?=$data_pedido?>
                                                </td>
                                            </tr> <tr>
											<td colspan="2">
                                            <fieldset style="width:780px;margin:0 auto;padding:10px">
                                            <legend class="bordaPesquisa">Itens do pedido</legend>
											<table border="0" width="100%">												
											<? foreach($itens as $dados) :?>
												<tr>
	                                                <td height="24" align="right" class="text_bold_preto" width="20%">Produto:</td>
	                                                <td class="text_padrao">
														 <?=$dados["nome_produto"]?>
	                                                </td>
	                                            </tr> 
		                                        <tr>
	                                                <td height="24" align="right" class="text_bold_preto">Quantidade:</td>
	                                                <td class="text_padrao">
														 <?=$dados["quantidade"];?>
                                                    </td>
	                                            </tr> 
                                                 <tr>
	                                                <td height="24" align="right" class="text_bold_preto">Valor unitario:</td>
	                                                <td class="text_padrao">
														  <?="R$ ".moeda(retornaNome("produto","valor",$dados['produto_id']));?>
	                                                </td>
	                                            </tr> 
		                                        <tr>
	                                                <td height="24" align="right" class="text_bold_preto">Valor total:</td>
	                                                <td class="text_padrao">
														 <?="R$ ".moeda($dados["valor_total"])?>
	                                                </td>
	                                            </tr>
	                                            <tr>
                                                	<td height="24" align="right" class="text_bold_preto"></td>
                                            	</tr>
                                                
	                                    	<? endforeach; ?>
                                             	<tr>
                                                    <td height="24" align="right" class="text_bold_preto" colspan="2">Valor total do pedido:
                                                     <?="R$ ".moeda(ValorTotaPedido($id));?>
                                                     </td>                                        	
                                                </tr>  
										    </table>
                                                
                                             </fieldset>
											 
                                             		</td>
											 </tr>
	                                 