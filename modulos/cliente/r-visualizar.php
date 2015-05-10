								<!--<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>-->
                                             <?
	                                        if($tipo == 'F')
                                            {?>
                                            
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">Nome:</td>
                                                <td class="text_padrao">
													 <?=$nome?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Identidade:</td>
                                                <td class="text_padrao">
													 <?=$identidade?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cpf:</td>
                                                <td class="text_padrao">
													 <?=$cpf?>
                                                </td>
                                            </tr> 
	                                      <? }
                                           else
                                           { ?>
                                              <tr>
                                                <td height="24" align="right" class="text_bold_preto">Razão Social:</td>
                                                <td class="text_padrao">
													 <?=$razao_social?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Nome Fantasia:</td>
                                                <td class="text_padrao">
													 <?=$nome_fantasia?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cnpj:</td>
                                                <td class="text_padrao">
													 <?=$cnpj?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">IE:</td>
                                                <td class="text_padrao">
													 <?=$inscricao_estadual?>
                                                </td>
                                            </tr> 
                                          <?}?>  
                                            
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">Logradouro:</td>
                                                <td class="text_padrao">
													 <?=$logradouro?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Bairro:</td>
                                                <td class="text_padrao">
													 <?=$bairro?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Numero:</td>
                                                <td class="text_padrao">
													 <?=$numero?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cep:</td>
                                                <td class="text_padrao">
													 <?=$cep?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Telefone:</td>
                                                <td class="text_padrao">
													 <?=$telefone?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Celular:</td>
                                                <td class="text_padrao">
													 <?=$celular?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Estado:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("estado","nome",$estado_id);?>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td height="24" align="right" class="text_bold_preto">Cidade:</td>
                                                <td class="text_padrao">
													 <?=retornaNome("cidade","nome",$cidade_id);?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Email:</td>
                                                <td class="text_padrao">
													 <?=$email?>
                                                </td>
                                            </tr> 
	                                        <tr>
                                                <td height="24" align="right" class="text_bold_preto">Observação:</td>
                                                <td class="text_padrao">
													 <?=$observacao?>
                                                </td>
                                            </tr> 
	                            		  