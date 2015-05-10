								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cliente:</td>
                                                <td class="text_padrao">
													 <? if($tipo == 'F')
                                                     {
                                                        $Campo = 'nome';
                                                     }
                                                     else if($tipo == 'J')
                                                     {
                                                        $Campo = 'nome_fantasia';
                                                     }
                                                     
                                                       echo retornaNome("cliente",$Campo,$cliente_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">N° Nota Fiscal:</td>
                                                <td class="text_padrao">
													 <?=$nf?>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">N° Empenho:</td>
                                                <td class="text_padrao">
													 <?=$numero_nota_empenho?>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td height="24" align="right" class="text_bold_preto">N° PD:</td>
                                                <td class="text_padrao">
													 <?=$n_pd;?>
                                                </td>
                                            </tr>  
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Mês / Ano Referência:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("meses","mes",$mes_emissao)."/".retornaNome("ano","ano",$ano_emissao)?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data pagamento:</td>
                                                <td class="text_padrao">
													 <?=$data_pagamento?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">Data nota:</td>
                                                <td class="text_padrao">
													 <?=$data_nota?>
                                                </td>
                                            </tr>  
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Serviço</td>
                                                <td class="text_padrao">
													 <?=retornaNome("servico","descricao",$servico_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Valor:</td>
                                                <td class="text_padrao">
													 R$ <?=$valor?>
                                                </td>
                                            </tr> 
	                                       